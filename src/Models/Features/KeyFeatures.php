<?php

namespace Wearenext\CMS\Models\Features;

use Wearenext\CMS\Models\BaseModel;
use Wearenext\CMS\Models\Page;

class KeyFeatures extends BaseModel
{
    protected $table = 'page_key_features';

    protected $fillable = [
        'page_id',
        'key_features',
    ];
    
    protected $casts = [
        'key_features' => 'array',
    ];
    
    protected $touches = [
        'page',
    ];
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
    
    protected function setKeyFeaturesAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['key_features'] = json_encode(array_filter($value, function ($v) {
                return !empty(trim($v));
            }));
        } else {
            $this->attributes['key_features'] = $value;
        }
    }
}
