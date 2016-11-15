<?php

namespace Wearenext\CMS\Support\Facades;

/**
 * @see \Wearenext\CMS\Application
 */
class CMS extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'cms.application';
    }
}
