<?php

namespace Wearenext\CMS\Requests;

class PageTypeRequest extends BaseRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [
            'label' => 'required|string|between:1,255',
            'slug' => 'required|alpha_dash|between:1,255',
        ];
        
        foreach (array_keys($this->get('fields', [])) as $key) {
            $rules["fields.{$key}.value"] = 'string|between:3,50';
            $rules["fields.{$key}.field"] = 'string|between:3,50';
        }
        
        return $rules;
    }
    
    public function attributes()
    {
        $attributes = parent::attributes();
        
        foreach (array_keys($this->get('fields', [])) as $key) {
            $attributes["fields.{$key}.value"] = array_get($attributes, 'fields.value', 'Value');
            $attributes["fields.{$key}.field"] = array_get($attributes, 'fields.field', 'Label');
        }
        
        return $attributes;
    }
}
