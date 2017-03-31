<?php

namespace Wearenext\CMS\Controllers;

use DirectoryIterator;
use Carbon\Carbon;
use ErrorException;
use Illuminate\Http\Request;
use Wearenext\CMS\Models\Document;
use Wearenext\CMS\Models\FundPage;

class DocsController extends BaseController
{
    public function index()
    {
        $docs = $this->getDocs();
        $docPage = true;
        $uploadField = 'doc_upload';
        $uploadToken = $this->resetNewCustomerToken($uploadField)['key'];
        // gonna need a pivot column for product name
        $docs = Document::all();
        $pageProducts = FundPage::all();

        return view('cms::doc.view', compact('docs', 'docPage', 'uploadField', 'uploadToken', 'pageProducts'));
    }

    public function view($id)
    {
        $docs = $this->getDocs();

        if (!isset($docs[$id])) {
            abort(404);
        }

        return redirect(config('cms.docs.resource') . "/{$docs[$id]['filename']}");
    }

    public function delete($id, $hash)
    {
        $docs = $this->getDocs();

        if (!isset($docs[$id])) {
            abort(404);
        }
        
        if ($docs[$id]['hash'] != $hash) {
            abort(404);
        }
        
        $filename = config('cms.docs.store') . "/{$docs[$id]['filename']}";
        
        if (file_exists($filename)) {
            unlink($filename);
        }
        
        return back()->withErrors(['success' => ["File {$docs[$id]['name']} deleted"]]);
    }

    public function postUpload(Request $request)
    {
        $token = $this->getNewCustomerToken($request->get('uid'), $request->get('token'));
        if (is_null($token)) {
            return response('Error uploading file please reload and try again', 500);
        }

        $totalSize = $request->get('resumableTotalSize', 15000001);

        if ($totalSize > 15000000) {
            return response('File size exceeds maximum', 500);
        }

        $filename = $request->get('resumableFilename');
        $exp = explode('.', $filename);

        if (count($exp) < 2) {
            return response('Filename is not correct', 500);
        }

        $disallowed = ['js', 'html', 'php5', 'php', 'exe',];
        $extension = array_get($exp, count($exp) - 1);

        if (in_array(strtolower($extension), $disallowed)) {
            return response('File type not permitted, disallowed types: ' . implode(', ', $disallowed), 500);
        }
        
        if (file_exists(config('cms.docs.store') . "/{$filename}") && $request->get('overwrite', 0) != 1) {
            return response('Overwrite?', 500);
        }

        $total = 0;
        $parts = $token->get('parts', collect());

        if (!empty($_FILES)) {
            foreach ($_FILES as $file) {
                // check the error status
                if ($file['error'] != 0) {
                    continue;
                }
                $parts->put($request->get('resumableChunkNumber') . "", file_get_contents($file['tmp_name']));
            }
        }

        foreach ($parts as $p) {
            $total += strlen($p);
        }

        $token->put('parts', $parts);
        $token->put('ext', $extension);
        $token->put('size', $totalSize);
        $token->put('filename', $filename);

        if ($total >= $totalSize) {
            $token->put('success', true);
            $this->saveFile($token);
            
            back()->withErrors(['success' => ['File uploaded']]);
            
            return response('Ok');
        }

        return response('Ok');
    }

    public function getUpload(Request $request)
    {
        $token = $this->getNewCustomerToken($request->get('uid'), $request->get('token'));
        if (is_null($token)) {
            abort(500, 'Error uploading file please reload and try again');
        }

        if (!$token->get('parts', collect())->has($request->get('resumableChunkNumber'))) {
            abort(404, 'Not Found');
        }
        return response('Ok');
    }

    protected function getDocs()
    {
        if (is_null(config('cms.docs.store'))) {
            abort(500);
        }

        $docs = [];
        $dt = new DirectoryIterator(config('cms.docs.store'));
        $documents = Document::all();

        foreach ($dt as $d) {
            if ($d->isFile()) {
                $docs[] = [
                    'id' => count($docs),
                    'name' => $d->getFilename(),
                    'hash' => md5($d->getFilename()),
                    'filename' => $d->getFilename(),
                    'path' => $d->getPathname(),
                    'modified' => Carbon::createFromTimestamp($d->getMTime()),
                ];

                if (!Document::where('file_name', $d->getFilename())->first()){
                    Document::create([
                        'file_name' => $d->getFilename(),
                        'file_path' => $d->getPathname(),
                        'file_size' => round($d->getSize() / 1000, 0 , PHP_ROUND_HALF_UP)
                    ]);
                }
            }

        }
        return $docs;
    }

    protected function resetNewCustomerToken($uid)
    {
        $key = '';
        for ($i = 0; $i < 13; $i++) {
            $key .= rand(0, 9);
        }
        $parts = collect();
        $token = collect(compact('key', 'parts'));
        session()->put('file_upload_' . $uid, $token);
        return $token;
    }

    protected function getNewCustomerToken($uid, $key)
    {
        if (!session()->has('file_upload_' . $uid)) {
            throw new ErrorException("file_upload_{$uid} not set");
        }

        if (session()->get('file_upload_' . $uid)->get('key') !== $key) {
            return;
        }

        return session()->get('file_upload_' . $uid);
    }
    
    protected function saveFile($token)
    {
        $parts = $token->get('parts', collect());
        $filename = $token->get('filename');
        $filename = config('cms.docs.store') . "/{$filename}";
        
        if (file_exists($filename)) {
            unlink($filename);
        }
        
        $fh = fopen($filename, 'w+');
        
        $i = 1;
        while ($parts->has("{$i}")) {
            fwrite($fh, $parts->get("{$i}"));
            $i++;
        }
        
        fclose($fh);
    }

    protected function addDocumentToPage()
    {
        $docs = request()->get('documents');

        foreach ($docs as $key => $value) {
            //detach the specific document from pages
            $pages = FundPage::where('document_id', $key)->get();

            foreach ($pages as $page) {
                $page->document_id = null;
                $page->save;
            }
            
            $fundPage = FundPage::find($value);
            $fundPage->document_id = $key;
            $fundPage->save();
        }

        // foreach ($pages as $key => $value) {
        //     //remove documents first

        //     $fundPage = FundPage::find($key);
        //     $fundPage->document_id = $value;
        //     $fundPage->save();
        // }

        return redirect()->route('cms.doc.index');
    }
}
