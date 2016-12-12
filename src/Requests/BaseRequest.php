<?php

namespace Wearenext\CMS\Requests;
 
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    abstract public function authorize();
    abstract public function rules();
}
