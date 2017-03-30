<?php

namespace Wearenext\CMS\Models;

class FundDocument extends BaseModel
{
    protected $table = 'fund_document';

    protected $fillable = [
        'route',
        'page_name',
        'product_name',
        'file_path',
        'file_name',
        'file_size'
    ];
}
