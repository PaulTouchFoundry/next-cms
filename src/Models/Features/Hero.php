<?php

namespace Wearenext\CMS\Models\Features;

use Wearenext\DFS\Models\BaseModel;
use Wearenext\DFS\Models\Media;
use Wearenext\DFS\Models\Page;

class Hero extends BaseModel
{
    protected $table = 'page_hero';

    protected $fillable = [
        'page_id',
        'hero_title',
        'hero_buttons',
        'hero_media_id',
    ];
    
    protected $casts = [
        'hero_buttons' => 'array',
    ];
    
    protected $touches = [
        'page',
    ];
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'hero_media_id');
    }
}
