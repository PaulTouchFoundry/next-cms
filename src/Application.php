<?php
namespace Wearenext\CMS;

use Wearenext\CMS\Support\RenderableContent;
use Wearenext\CMS\Models\Url;
use Wearenext\CMS\Models\Page;
use Wearenext\CMS\Contracts\Application as AppInterface;
use ErrorException;

class Application implements AppInterface
{
    protected $currentContent = null;
    
    public function resolveSlug($slug)
    {
        $url = Url::where('url', "{$slug}")
            ->with('page.blocks')
            ->firstOrFail();
        $this->currentContent = $url->page;
    }
    
    public function renderContent(RenderableContent $content)
    {
        $this->currentContent = $content;
    }
    
    public function currentContent()
    {
        if (!is_null($this->currentPage)) {
            throw new ErrorException('Current page is null');
        }
        return $this->currentContent;
    }

    public function resolvePreview($id)
    {
        $this->currentContent = Page::with('blocks')->findOrFail($id);
    }
}
