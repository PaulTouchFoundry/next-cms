<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Cloudinary\Uploader;
use Wearenext\CMS\Models\Media;
use Wearenext\CMS\Models\Page;
use Wearenext\CMS\Models\PageType;
use Wearenext\CMS\Models\Block;
use Exception;

class MediaController extends BaseController
{
    public function update(Request $request)
    {
        $this->validate($request, [
            'tag' => 'required|in:hero,block,primary,secondary',
            'media_file' => 'image',
        ]);

        $media = Media::findOrNew($request->get('media_id'));

        try {
            if ($request->hasFile('media_file')) {
                $file = $request->file('media_file');
                $media->tag = $request->get('tag');
                $media->url = $this->getUploadURL($file);
                $media->filename = str_limit($file->getClientOriginalName());

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
            ->with('backUrl', $this->generateBackUrl())
            ->with('tag', $tag);
    }
    
    protected function generateBackUrl()
    {
        switch (request('from')) {
            case 'page':
                if (request()->has('page_id')) {
                    $page = Page::findOrFail(request()->get('page_id'));
                    return $page->editUrl();
                }
                if (request()->has('pagetype_id')) {
                    $type = PageType::findOrFail(request()->get('pagetype_id'));
                    return route('cms.page.create', [ 'cmsType' => $type->slug ]);
                }
                break;
            case 'block':
                if (request()->has('block_id')) {
                    $block = Block::findOrFail(request()->get('block_id'));
                    return route('cms.block.edit_block', ['cmsBlock' => $block,]);
                }
                if (request()->has('page_id')) {
                    $page = Page::findOrFail(request()->has('page_id'));
                    return route('cms.block.create_media_image_block', [ 'cmsType' => $page->type->slug, 'cmsPage' => $page->id, ]);
                }
                break;
            case 'featured_block':
                if (request()->has('page_id')) {
                    $page = Page::findOrFail(request()->has('page_id'));
                    return route('cms.block.create_featured_block', [ 'cmsType' => $page->type->slug, 'cmsPage' => $page->id, ]);
                }
                break;
        }
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
