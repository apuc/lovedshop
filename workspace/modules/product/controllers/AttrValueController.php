<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\modules\product\models\Attribute;
use workspace\modules\product\models\AttrValue;
use workspace\modules\product\requests\AttrValueRequest;

class AttrValueController extends Controller
{
    public $viewPath = '/modules/product/views/attrvalue';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/attrvalue';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'AttrValue', 'url' => 'attrvalue']);
    }

    public function actionIndex()
    {
        $model = AttrValue::all();
        $options = [
            'serial' => '#',
            'fields' => [
                'Атрибут' => ['label' => 'Атрибут', 'value' => function ($model) {
                    $attr = Attribute::where('id', $model->attr_id)->first();

                    return !empty($attr->name) ? $attr->name : null;
                }],
                'value' => [
                    'label' => 'Значение'
                ],
            ],
            'baseUri' => 'attrvalue'
        ];

        return $this->render('attrvalue.tpl', ['h1' => 'Значение атрибутов', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = AttrValue::where('id', $id)->first();

        $options = [
            'fields' => [
                'attr_id' => 'attr_id',
                'value' => 'value',
            ],
        ];

        return $this->render('attrvalue/view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        $request = new AttrValueRequest();
        if($request->isPost() && $request->validate()) {
            $model = new AttrValue();
            $model->attr_id = $request->attr_id;
            $model->value = $request->value;
            $model->save();
            $this->redirect('admin/attrvalue');
        } else
            $attribute = Attribute::all();
            return $this->render('store.tpl', ['h1' => 'Добавить','attribute'=>$attribute]);
    }

    public function actionEdit($id)
    {
        $model = AttrValue::where('id', $id)->first();

        if(isset($_POST['value']) && isset($_POST['attr_id'])) {
            $model->attr_id = $_POST['attr_id'];
            $model->value = $_POST['value'];
            $model->save();

            $this->redirect('admin/attrvalue');
        } else
            $attribute = Attribute::all();
            return $this->render('edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model, 'attribute'=>$attribute]);
    }

    public function actionDelete()
    {
        AttrValue::where('id', $_POST['id'])->delete();
    }
}