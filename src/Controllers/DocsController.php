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
        $document = Document::find($id);

        if (!$document) {
            abort(404);
        }

        $filename = config('cms.docs.store') . "/{$document->file_name}";

        if (file_exists($filename)) {
            $document->delete();
            $fundPages = FundPage::where('document_id', $document->id)->get();
            foreach ($fundPages as $fundPage) {
                $fundPage->document_id = null;
                $fundPage->save();
            }
            unlink($filename);
        }

        return back()->withErrors(['success' => ["File {$document->file_name} deleted"]]);
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

            $path = config('cms.docs.store');
            $path = substr($path, strpos($path, '/assets') +1);
            $path = rtrim($path);

            //if file is overwritten then update the record in the db
            if (request()->get('overwrite') === '1') {
                $document = Document::where('file_name', $filename)->first();
                $document->file_name = $filename;
                $document->file_path = $path.'/'.$filename;
                $document->file_size = round($totalSize / 1000, 0 , PHP_ROUND_HALF_UP);
                $document->save();
            } else {
                $document = Document::create([
                    'file_name' => $filename,
                    'file_path' => $path.'/'.$filename,
                    'file_size' => round($totalSize / 1000, 0 , PHP_ROUND_HALF_UP)
                ]);
            }

            if ($request->get('productId')) {
                $fundPage = FundPage::find($request->get('productId'));
                $fundPage->document_id = $document->id;
                $fundPage->save();
            }

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
                $path = $d->getPathname();
                $path = substr($path, strpos($path, '/assets') +1);

                $document = Document::where('file_name', $d->getFilename())->first();

                if (!$document) {
                    $document = Document::create([
                        'file_name' => $d->getFilename(),
                        'file_path' => $path,
                        'file_size' => round($d->getSize() / 1000, 0 , PHP_ROUND_HALF_UP)
                    ]);
                }

                $docs[] = [
                    'id' => $document->id,
                    'name' => $document->file_name,
                    'hash' => md5($document->file_name),
                    'filename' => $document->file_name,
                    'path' => '/' . $path,
                    'modified' => Carbon::createFromTimestamp($d->getMTime()),
                ];
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
        $documentId = request()->get('document_id');
        $pages = request()->get('fund_pages');

        if (!$pages) {
            $fundPages = FundPage::where('document_id', $documentId)->get();

            foreach ($fundPages as $page) {
                $page->document_id = null;
                $page->save();
            }

            return redirect()->route('cms.doc.index');
        }
        foreach ($pages as $page => $document) {
            //detach the specific document from pages
            $detach = FundPage::where('document_id', $document)->get();
            foreach ($detach as $p) {
                $p->document_id = null;
                $p->save();
            }
        }

        foreach ($pages as $page => $document) {
            //remove documents first
            $fundPage = FundPage::find($page);
            $fundPage->document_id = (integer)$document;
            $fundPage->save();
        }

        return redirect()->route('cms.doc.index');
    }

    public function linkDocs()
    {
        $pageProducts = FundPage::all();
        $docLinkPage = true;
        $uploadField = 'doc_upload';
        foreach ($pageProducts as $product) {
            $product->token = $this->resetNewCustomerToken($product->id)['key'];
            if ($product->document) {
                $product->document->hash = md5($product->document->file_name);
            }
        }
        return view('cms::doc.link-documents', compact('pageProducts', 'docLinkPage', 'uploadField'));
    }
}
