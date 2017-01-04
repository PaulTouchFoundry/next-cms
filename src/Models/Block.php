<?php

namespace Wearenext\CMS\Models;

class Block extends BaseModel
{
    const TYPE_ICON = 'icon_list';
    const TYPE_MEDIA = 'media';
    const TYPE_TEXT = 'text';
    const TYPE_EMBED = 'embed';
    const TYPE_FEATURED = 'featured';

    protected $fillable = [
        'title',
        'headline',
        'content',
        'next_block_id',
        'block_type',
        'icon_list',
        'quicklink',
    ];
    
    protected $casts = [
        'icon_list' => 'array',
        'quicklink' => 'boolean',
    ];
    
    public function block()
    {
        return $this->belongsTo(self::class, 'next_block_id', 'id');
    }

    public function previousBlock()
    {
        return $this->hasOne(self::class, 'next_block_id');
    }
    
    public function callouts()
    {
        return $this->hasMany(Callout::class);
    }

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function startingPage()
    {
        return $this->hasOne(Page::class, 'starting_block_id');
    }

    public function media()
    {
        return $this->belongsToMany(Media::class);
    }
    
    public function setIconListAttribute($value)
    {
        if (!is_array($value)) {
            $this->attributes['icon_list'] = $value;
            return ;
        }
        $newValue = [];
        foreach ($value as $icon) {
            if (empty(array_get($icon, 'text')) ||
                    empty(array_get($icon, 'class'))) {
                continue;
            }
            $newValue[] = $icon;
        }
        $this->attributes['icon_list'] = json_encode($newValue);
    }

    public function delete()
    {
        $block = $this->block;
        $page = $this->startingPage;
        if (!is_null($page)) {
            $page->starting_block_id = data_get($block, 'id');
            $page->save();
        }
        $prevBlock = $this->previousBlock;
        if (!is_null($prevBlock)) {
            $prevBlock->next_block_id = data_get($block, 'id');
            $prevBlock->save();
        }

        //$this->callouts()->delete();
        return parent::delete();
    }
}
