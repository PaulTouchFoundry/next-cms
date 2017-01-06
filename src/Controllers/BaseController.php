<?php

namespace Wearenext\CMS\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class BaseController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function __construct()
    {
        if (!is_null(config('cms.auth.middleware'))) {
            $this->middleware(config('cms.auth.middleware'), ['except' => ['portal', 'login'],]);
        }
    }
}
