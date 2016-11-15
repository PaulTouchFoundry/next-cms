<?php

namespace Wearenext\CMS\Support\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Wearenext\CMS\Support\Html\FormBuilder
 */
class FormFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cmsform';
    }
}
