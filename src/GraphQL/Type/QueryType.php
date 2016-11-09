<?php

namespace Wearenext\CMS\GraphQL\Type;

use Wearenext\CMS\GraphQL\Types;

class QueryType extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'Query',
            'fields' => [
                'block' => [
                    'type' => Types::block(),
                    'description' => 'Blocks are ordered sections of content',
                    'args' => [
                        'id' => [
                            'type' => Types::nonNull(Types::id()),
                            'description' => 'Block associated with this id'
                        ],
                    ]
                ],
                'callout' => [
                    'type' => Types::callout(),
                    'description' => 'Callout',
                    'args' => [
                        'id' => [
                            'type' => Types::nonNull(Types::id()),
                            'description' => 'Id of callout',
                        ],
                    ]
                ],
                'media' => [
                    'type' => Types::media(),
                    'description' => 'Media',
                    'args' => [
                        'id' => [
                            'type' => Types::nonNull(Types::id()),
                            'description' => 'Id of media'
                        ],
                    ]
                ],
                'page' => [
//                    'type' => Types::listOf(Types::story()),
                    'type' => Types::page(),
                    'description' => 'A Page.',
                    'args' => [
                        'type' => [
                            'type' => Types::string(),
                            'description' => 'Page type string'
                        ],
                        'id' => [
                            'type' => Types::int(),
                            'description' => 'Id of page',
                        ],
                        'url' => [
                            'type' => Types::string(),
                            'description' => 'Url of page',
                        ],
                    ]
                ],
                'pagetype' => [
                    'type' => Types::pageType(),
                    'description' => 'A Page type.',
                    'args' => [
                        'type' => [
                            'type' => Types::string(),
                            'description' => 'Page type string'
                        ],
                        'id' => [
                            'type' => Types::int(),
                            'description' => 'Id of page type',
                        ],
                        'url' => [
                            'type' => Types::string(),
                            'description' => 'Url of page type',
                        ],
                    ]
                ],
                'url' => [
                    'type' => Types::url(),
                    'description' => 'A Page url.',
                    'args' => [
                        'id' => [
                            'type' => Types::int(),
                            'description' => 'Id of url',
                        ],
                        'slug' => [
                            'type' => Types::string(),
                            'description' => 'Url slug',
                        ],
                    ]
                ],
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
