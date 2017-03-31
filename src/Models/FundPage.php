<?php

namespace Wearenext\CMS\Models;

class FundPage extends BaseModel
{
    protected $table = 'fund_page';

    protected $fillable = [
        'route',
        'page_name'
    ];
}
