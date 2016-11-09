<?php

namespace Wearenext\CMS\GraphQL\Type;

/**
 * Description of PageType
 *
 * @author rory
 */
class PageType extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'PageType',
            'fields' => [
                //
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
