<?php

namespace Wearenext\CMS\Models;

class Page extends BaseModel
{
    protected $fillable = [
        'name',
        'meta_title',
        'meta_description',
        'template',
        'page_type_id',
        'starting_block_id',
        'features',
        'published',
        'published_at',
    ];
    
    protected $casts = [
        'features' => 'array',
        'published' => 'boolean',
    ];
    
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(PageType::class, 'page_type_id', 'id');
    }
    
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
    
    public function block()
    {
        return $this->belongsTo(Block::class, 'starting_block_id', 'id');
    }
    
    public function pageHero()
    {
        return $this->hasOne(Features\Hero::class);
    }
    
    public function pageProduct()
    {
        return $this->hasOne(Features\Product::class);
    }
    
    public function urls()
    {
        return $this->hasMany(Url::class);
    }
    
    public function resolveSummary()
    {
        foreach ($this->getBlockGenerator() as $block) {
            if ($block->block_type == Block::TYPE_TEXT) {
                return str_limit(strip_tags($block->content));
            }
        }
        return 'No synopsis available';
    }

    public function getBlockGenerator()
    {
        $nextBlock = $this->starting_block_id;

        $blocks = $this->blocks->keyBy('id');

        while ($block = $blocks->get($nextBlock)) {
            $nextBlock = $block->next_block_id;
            yield $block;
        }
    }
    
    public function previewUrl()
    {
        $url = $this->urls()->first();
        if (!is_null($url)) {
            return url($url->url);
        }
    }
    
    public function publishUrl()
    {
        $type = $this->type;
        return route('cms.page.publish', [ 'cmsType' => $type->slug, 'cmsPage' => $this ]);
    }
    
    public function unpublishUrl()
    {
        $type = $this->type;
        return route('cms.page.unpublish', [ 'cmsType' => $type->slug, 'cmsPage' => $this ]);
    }

    public function editUrl()
    {
        $type = $this->type;
        return route('cms.page.edit', [ 'cmsType' => $type->slug, 'cmsPage' => $this ]);
    }
    
    public function setPublishAttribute($value)
    {
        if ($value == 1) {
            $this->attributes['published_at'] = Carbon::now();
        }
        $this->attributes['publish'] = $value;
    }

    public function blockUrl()
    {
        $type = $this->type;
        return route('cms.block.index', [ 'cmsType' => $type->slug, 'cmsPage' => $this ]);
    }
    
    public function relatedPages()
    {
        return $this->hasMany(PageRelation::class);
    }
}
