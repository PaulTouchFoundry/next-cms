<?php

namespace Wearenext\CMS\Support\Html;

use Collective\Html\FormBuilder as BaseFormBuilder;

class FormBuilder extends BaseFormBuilder
{
    protected $wrapInput = false;
    protected $wrapFor = [];

    public function open(array $options = array())
    {
        // Add form class
        $options = array_add($options, 'class', 'form');

        return parent::open($options);
    }

    public function wrapLabel($name, $value = null, $options = array())
    {
        $this->wrapInput = true;
        $this->labels[] = $name;
        array_unshift($this->wrapFor, $name);

        $class = 'label';
        if (session()->get('errors') != null) {
            if (session()->get('errors')->get($name) != null) {
                $class = 'label has-error';
            }
        }

        $options = array_add($options, 'class', $class);
        $options = $this->html->attributes($options);

        $value = e($this->formatLabel($name, $value));

        return '<label for="' . $name . '"' . $options . '>' . $value;
    }

    public function closeWrapLabel($name)
    {
        $this->wrapInput = false;
        $this->wrapFor = array_slice($this->wrapFor, 1);

        $error = '';
        if (session()->get('errors') != null && $name != null) {
            if (session()->get('errors')->get($name) != null) {
                $message = array_get(session()->get('errors')->get($name), '0');
                $error = '<span class="help-text">' . $message . '</span>';
            }
        }
        return "{$error}</label>";
    }

    public function label($name, $value = null, $options = array())
    {
        $options = array_add($options, 'class', 'label');

        return parent::label($name, $value, $options);
    }

    public function input($type, $name, $value = null, $options = array())
    {
        $options = array_add($options, 'class', 'input');

        return $this->wrapWithLabel(parent::input($type, $name, $value, $options), $name);
    }

    public function checkbox($name, $value = 1, $checked = null, $options = array())
    {
        $options = array_add($options, 'class', 'checkbox');

        return $this->wrapWithLabel(parent::checkbox($name, $value, $checked, $options), $name);
    }

    public function select($name, $list = array(), $selected = null, $options = array())
    {
        $options = array_add($options, 'class', 'input input--select');

        return $this->wrapWithLabel(parent::select($name, $list, $selected, $options), $name);
    }

    public function button($value = null, $options = array())
    {
        $options = array_add($options, 'class', 'btn');

        return $this->wrapWithLabel(parent::button($value, $options));
    }

    public function submit($value = null, $options = array())
    {
        $options = array_add($options, 'class', 'btn');

        return $this->wrapWithLabel(parent::submit($value, $options));
    }

    public function textarea($name, $value = null, $options = array())
    {
        $options = array_add($options, 'class', 'input input--textarea');

        return $this->wrapWithLabel(parent::textarea($name, $value, $options), $name);
    }

    protected function wrapWithLabel($html, $name = '')
    {
        if (isset($this->wrapFor[0]) && $this->wrapFor[0] == $name) {
            return " ".$html.$this->closeWrapLabel($name);
        } else {
            return $html;
        }
    }

    public function old($name)
    {
        if ('_method' !== $name) {
            return parent::old($name);
        }
    }
}
