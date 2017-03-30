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

    public function fundPages()
    {
        return $this->belongsToMany(FundPage::class, 'fund_page_document', 'document_id', 'fund_page_id')
                    ->withPivot('product_name');
    }
}
