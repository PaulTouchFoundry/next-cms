<?php

namespace Wearenext\CMS\Models;

class Document extends BaseModel
{
    protected $table = 'document';

    protected $fillable = [
        'product_name',
        'file_path',
        'file_name',
        'file_size'
    ];
}
