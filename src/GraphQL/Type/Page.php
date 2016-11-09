<?php

namespace Wearenext\CMS\GraphQL\Type;

use Wearenext\CMS\GraphQL\Types;

/**
 * Description of Page
 *
 * @author rory
 */
class Page extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'Page',
            'fields' => [
                'blocks' => [
                    'type' => Types::listOf(Types::block()),
                    'description' => 'List of orderd blocks',
                    'args' => [
                        'limit' => [
                            'type' => Types::int(),
                            'description' => 'Limit the number of blocks',
                        ],
                        'start' => [
                            'type' => Types::int(),
                            'description' => 'The starting block number',
                        ],
                    ]
                ],
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
