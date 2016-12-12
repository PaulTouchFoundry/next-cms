<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Cloudinary\Uploader;
use Wearenext\CMS\Models\Media;
use Exception;

class MediaController extends BaseController
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'tag' => 'required|in:hero,block',
            'media_file' => 'image',
        ]);

        $media = Media::findOrNew($request->get('media_id'));

        try {
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $media->tag = $request->get('tag');
                $media->url = $this->getUploadURL($file);

                $media->save();
            }
            $errors = [
                'success' => [
                    'Media Updated Successfully',
                ],
            ];
        } catch (Exception $ex) {
            $errors = [
                'error' => [
                    "Error: " .$ex->getMessage(),
                ],
            ];
        }

        return back()
            ->withErrors($errors);
    }

    public function edit($tag)
    {
        return view('cms::media.edit')
            ->with('tag', $tag);
    }

    protected function getUploadURL(UploadedFile $upload)
    {
        $data = Uploader::upload($upload->getPathname());

        if (array_has($data, 'url')) {
            $url = 'http://res.cloudinary.com/du9dtwhdr/';
            return str_replace($url, '', array_get($data, 'url', ''));
        }
    }
}
