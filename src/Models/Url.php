<?php

namespace Wearenext\CMS\Models;

class Url extends BaseModel
{
    protected $fillable = [
        'page_id',
        'url',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
