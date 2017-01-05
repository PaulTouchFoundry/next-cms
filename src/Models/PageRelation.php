<?php

namespace Wearenext\CMS\Models;

class PageRelation extends BaseModel
{
    protected $fillable = [
        'relation_name',
        'relation_id',
        'page_id',
        'related_page_id',
        'related_pagetype_id',
    ];
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    
    public function relatedPage()
    {
        return $this->belongsTo(Page::class, 'related_page_id');
    }
    
    public function relatedPageType()
    {
        return $this->belongsTo(PageType::class, 'related_pagetype_id');
    }
}
