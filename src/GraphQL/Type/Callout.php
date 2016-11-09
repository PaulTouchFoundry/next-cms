<?php

namespace Wearenext\CMS\GraphQL\Type;

use Wearenext\CMS\GraphQL\Types;

/**
 * Description of Callout
 *
 * @author rory
 */
class Callout extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'Callout',
            'fields' => [
                //
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
