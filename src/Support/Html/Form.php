<?php

namespace Wearenext\CMS\Support\Html;

class Form
{
    protected $data;
    
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function field($name)
    {
        return new Input($this, $name);
    }
    
    public function getData($key, $default = null)
    {
        return array_get($this->data, $key, $default);
    }
}
