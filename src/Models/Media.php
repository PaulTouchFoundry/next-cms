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

    public function getThumb()
    {
        return "https://res.cloudinary.com/du9dtwhdr/". str_replace(
            'image/upload',
            'image/upload/t_media_lib_thumb',
            $this->url
        );
    }

    public function getURL()
    {
        return "https://res.cloudinary.com/du9dtwhdr/{$this->url}";
    }
}
