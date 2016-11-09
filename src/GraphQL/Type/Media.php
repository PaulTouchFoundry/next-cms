<?php

namespace Wearenext\CMS\GraphQL\Type;

use Wearenext\CMS\GraphQL\Types;

/**
 * Description of Media
 *
 * @author rory
 */
class Media extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'Media',
            'fields' => [
                //
                
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
