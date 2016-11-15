<?php

namespace Wearenext\CMS\Contracts;

interface Application
{
    /**
     * @param string $slug
     */
    public function resolveSlug($slug);
    
    /**
     * @param int $id
     */
    public function resolvePreview($id);
    
    /**
     * @param \Wearenext\CMS\Contracts\RenderableContent $content
     */
    public function renderContent(RenderableContent $content);
    
    /**
     * @return \Wearenext\CMS\Contracts\RenderableContent
     */
    public function currentContent();
}
