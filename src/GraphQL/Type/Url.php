<?php

namespace Wearenext\CMS\GraphQL\Type;

use Wearenext\CMS\GraphQL\Types;

/**
 * Description of URL
 *
 * @author rory
 */
class Url extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'Url',
            'fields' => [
                'slug' => [
                    'type' => Types::string(),
                ],
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
