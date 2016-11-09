<?php

namespace Wearenext\CMS\GraphQL\Type;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\ResolveInfo;

abstract class BaseType extends ObjectType
{
    public function __construct(array $config = [])
    {
        parent::__construct($this->getDefinition());
    }
    
    protected abstract function getDefinition();
    
    /**
     * Magic function that does all the work
     * @return \Closure
     */
    protected function resolveFunc()
    {
        return function($value, $args, $context, ResolveInfo $info) {
            if (method_exists($this, $info->fieldName)) {
                return $this->{$info->fieldName}($value, $args, $context, $info);
            } else {
                return $value->{$info->fieldName};
            }
        };
    }
}
