<?php

namespace Wearenext\CMS\Support\Html;

class Input implements FieldInterface
{
    protected $name;
    protected $form;

    public function __construct(Form $form, $name)
    {
        $this->form = $form;
        $this->name = $name;
    }

    protected function oldInput()
    {
        return session()->getOldInput($this->name);
    }
    
    public function helpHtml()
    {
        if (!is_null($message = $this->help())) {
            return "<span class=\"help-text\">{$message}</span>";
        }
    }

    public function help()
    {
        if (!is_null($messages = session('errors'))) {
            if ($messages->has($this->name)) {
                $messagesArray = $messages->get($this->name);
                return implode('<br>', $messagesArray);
            }
        }
    }

    public function labelClass()
    {
        if (!is_null($this->help())) {
            return 'label has-error';
        }
        return 'label';
    }

    public function name()
    {
        return $this->name;
    }

    public function value($default = null)
    {
        if (!is_null($value = $this->oldInput())) {
            return $value;
        }
        if (!is_null($value = $this->form->getData($this->name, $default))) {
            return $value;
        }
        return $default;
    }
    
    public function isChecked($value = null)
    {
        $data = $this->value();
        if (is_null($value)) {
            return !is_null($data);
        }
        if (is_array($data)) {
            return isset($data[$value]);
        }
        return ($this->value() == $value);
    }
    
    public function checked($value = null)
    {
        if ($this->isChecked($value)) {
            return ' checked="checked"';
        }
        return '';
    }
    
    public function selected($value = null)
    {
        if ($this->isChecked($value)) {
            return ' selected="selected"';
        }
        return '';
    }
}
