<?php
namespace Wearenext\CMS\Support\Html;

interface FieldInterface
{
    public function value($default = null);
    public function name();
    public function labelClass();
    public function help();
    public function helpHtml();
}
