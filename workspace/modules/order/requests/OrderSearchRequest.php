<?php

namespace workspace\modules\order\requests;


use core\RequestSearch;

/**
 * Class OrderSearchRequest
 * @package workspace\modules\product\requests
 * @property integer $id
 * @property string $fio
 * @property string $email
 * @property string $phone
 * @property string $delivery_date
 * @property integer $delivery
 */
class OrderSearchRequest extends RequestSearch
{

    public $id;
    public $fio;
    public $email;
    public $phone;
    public $delivery;
    public $delivery_date;

    public function rules()
    {
        return [];
    }

}

