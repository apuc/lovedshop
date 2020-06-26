<?php


namespace workspace\modules\product\requests;

use core\Request;

/**
 * Class AttrValueRequest
 * @package workspace\modules\product\requests
 * @property integer $attr_id
 * @property string $value
 */
class AttrValueRequest extends Request
{
    public $attr_id;
    public $value;

    public function rules()
    {
        return [
            'attr_id'=>'required|integer',
            'value'=>'required',
        ];
    }
}