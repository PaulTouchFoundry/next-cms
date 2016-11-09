<?php

namespace Wearenext\CMS\Models;

class Callout extends BaseModel
{
    protected $fillable = [
        'page_id',
        'block_id',
        'large_heading',
        'small_heading',
        'text',
        'list',
        'quote',
        'button',
        'url',
    ];
    
    protected $casts = [
        'list' => 'array',
    ];
    
    public function page()
    {
        $this->belongsTo(Page::class);
    }
}
