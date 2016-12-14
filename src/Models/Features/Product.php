<?php

namespace Wearenext\CMS\Models\Features;

use Wearenext\CMS\Models\BaseModel;
use Wearenext\CMS\Models\Page;

class Product extends BaseModel
{
    protected $table = 'page_products';

    protected $fillable = [
        'page_id',
        'premium',
        'cover',
        'disclaimer',
        'description',
    ];
    
    protected $touches = [
        'page',
    ];
    
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
