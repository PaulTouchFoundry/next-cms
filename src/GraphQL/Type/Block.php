<?php

namespace Wearenext\CMS\GraphQL\Type;

use Wearenext\CMS\GraphQL\Types;

class Block extends BaseType
{
    protected function getDefinition()
    {
        return [
            'name' => 'Block',
            'fields' => [
                //
            ],
            'resolveField' => $this->resolveFunc(),
        ];
    }
}
