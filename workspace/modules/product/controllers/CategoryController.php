<?php

namespace workspace\modules\product\controllers;

use core\App;
use core\Controller;
use core\Debug;
use workspace\modules\product\models\Category;
use workspace\modules\product\services\NestedSet;

class CategoryController extends Controller
{
    public $viewPath = '/modules/product/views/category';

    protected function init()
    {
        //if(!isset($_SESSION['role']) || $_SESSION['role'] != 1) $this->redirect('');

        $this->viewPath = '/modules/product/views/category';
        $this->layoutPath = App::$config['adminLayoutPath'];
        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Attribute', 'url' => 'category']);
    }

    public function actionIndex()
    {
        NestedSet::addItem(3,[]);
        foreach (NestedSet::getParent(3) as $it) {
            Debug::prn($it->name);
        }die();
        $model = Category::all();

        $options = [
            'serial' => '#',
            'fields' => [
                'name' => [
                    'label' => 'Название'
                ],
                'title' => [
                    'label' => 'title'
                ],
                'description' => [
                    'label' => 'Описание'
                ],
                'status' => [
                    'label' => 'Статус'
                ],
            ],
            'baseUri' => 'category'
        ];

        return $this->render('category.tpl', ['h1' => 'Категория', 'model' => $model, 'options' => $options]);
    }

    public function actionView($id)
    {
        $model = Category::where('id', $id)->first();

        $options = [
            'fields' => [
                'name' => 'Названия',
                'title' => 'title',
                'description' => 'description',
                'status' => 'status',
            ],
        ];

        return $this->render('view.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionStore()
    {
        if(isset($_POST['name']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['status'])) {
            $model = new Category();
            $model->name = $_POST['name'];
            $model->title = $_POST['title'];
            $model->description = $_POST['description'];
            $model->status = $_POST['status'];
            $model->save();

            $this->redirect('category');
        } else
            return $this->render('store.tpl', ['h1' => 'Добавить категорию']);
    }

    public function actionEdit($id)
    {
        $model = Category::where('id', $id)->first();

        if(isset($_POST['name']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['status'])) {
            $model->name = $_POST['name'];
            $model->title = $_POST['title'];
            $model->description = $_POST['description'];
            $model->status = $_POST['status'];
            $model->save();

            $this->redirect('category');
        } else
            return $this->render('edit.tpl', ['h1' => 'Редактировать: ', 'model' => $model]);
    }

    public function actionDelete()
    {
        Category::where('id', $_POST['id'])->delete();
    }
}
