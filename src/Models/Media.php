<?php

namespace Wearenext\CMS\Models;

class Media extends BaseModel
{
    protected $fillable = [
        'tag',
        'url',
        'filename',
    ];

    public function blocks()
    {
        return $this->belongsToMany(Block::class);
    }

    public function page()
    {
        return $this->hasMany(Features\Hero::class, 'hero_image_id');
    }

    public function getThumb($forceCloud = false)
    {
        $resource = config('cms.cloudinary.resource_thumb');
        if (!$forceCloud && !is_null($resource)) {
            return "{$resource}/".basename($this->url);
        }
        
        return "https://res.cloudinary.com/du9dtwhdr/". str_replace(
            'image/upload',
            'image/upload/t_media_lib_thumb',
            $this->url
        );
    }

    public function getURL($forceCloud = false)
    {
        $resource = config('cms.cloudinary.resource');
        if (!$forceCloud && !is_null($resource)) {
            return "{$resource}/".basename($this->url);
        }
        
        return "https://res.cloudinary.com/du9dtwhdr/{$this->url}";
    }
}
