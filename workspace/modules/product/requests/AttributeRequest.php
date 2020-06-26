<?php

namespace workspace\modules\product\requests;

use core\Request;

/**
 * Class AttributeRequest
 * @package workspace\modules\product\requests
 * @property string $name
 */
class AttributeRequest extends Request
{
    public $name;

    public function rules()
    {
        return [
            'name'=>'required',
        ];
    }
}