<?php

namespace Wearenext\CMS\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use SoftDeletes;
    
    protected function setArrayAttribute($values)
    {
        $array = [];
        
        if (is_array($values)) {
            foreach ($values as $key => $value) {
                if (is_array($value)) {
                    foreach ($value as $nestedValue) {
                        if (empty(trim($nestedValue))) {
                            continue 2;
                        }
                    }
                } else if (empty(trim($value))) {
                    continue;
                }
                $array[$key] = $value;
            }
        }
        
        return $array;
    }
}
