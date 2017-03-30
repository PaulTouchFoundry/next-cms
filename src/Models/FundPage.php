<?php

namespace Wearenext\CMS\Models;

class FundPage extends BaseModel
{
    protected $table = 'fund_page';

    protected $fillable = [
        'route',
        'page_name'
    ];

    public function documents()
    {
        return $this->belongsToMany(FundPage::class, 'fund_page_document', 'fund_page_id', 'document_id');
    }
}
