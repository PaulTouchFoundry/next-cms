<?php

namespace Wearenext\CMS\Models;

class PageType extends BaseModel
{
    protected $fillable = [
        'label',
        'slug',
        'template',
        'block_quota',
        'callout',
        'features',
        'fields',
        'blocks',
        'relations',
    ];
    
    protected $casts = [
        'callout' => 'boolean',
        'features' => 'array',
        'fields' => 'array',
        'blocks' => 'array',
        'relations' => 'array',
    ];
    
    protected $attributes = [
        'features' => '[]',
        'fields' => '[]',
        'blocks' => '[]',
        'relations' => '[]',
    ];
    
    public function pages()
    {
        return $this->hasMany(Page::class);
    }
    
    public function setFeaturesAttribute($values)
    {
        $this->attributes['features'] = json_encode($this->setArrayAttribute($values));
    }
    
    public function setFieldsAttribute($values)
    {
        $this->attributes['fields'] = json_encode(array_values($this->setArrayAttribute($values)));
    }
    
    public function setBlocksAttribute($values)
    {
        $this->attributes['blocks'] = json_encode($this->setArrayAttribute($values));
    }
    
    public function setRelationsAttribute($values)
    {
        $this->attributes['relations'] = json_encode($this->setArrayAttribute($values));
    }
    
    public function scopeSlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }
    
    public function pageUrl()
    {
        return route('cms.page.view', [ 'cmsType' => $this->slug ]);
    }
    
    public function editUrl()
    {
        return route('cms.pagetype.edit', [ 'cmsPageType' => $this->id ]);
    }
    
    public function viewUrl()
    {
        return route('cms.pagetype.view');
    }
    
    public function field($name)
    {
        $trans = array_first($this->fields, function ($key, $ob) use ($name) {
            return ($name == $ob['field']);
        });
        if (!is_null($trans)) {
            return $trans['value'];
        }
        return trans("cms::page.fields.{$name}");
    }

    public function hasFeature($feature)
    {
        return array_has($this->features, $feature);
    }
}
