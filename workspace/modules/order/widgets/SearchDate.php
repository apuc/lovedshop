<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 04.06.20
 * Time: 23:29
 */

namespace workspace\modules\order\widgets;


use core\Debug;
use core\helpers\Form;
use core\Widget;

class SearchDate extends Widget
{

    public function run()
    {
        return Form::input($this->params['name'], [
            'attr' => [
                'value' => isset($_GET[$this->params['name']]) ? $_GET[$this->params['name']] : null,
                'type' => 'date',
                'class' => 'form-control __filter'
            ]
        ]);
    }

}