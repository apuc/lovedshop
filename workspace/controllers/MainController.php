<?php

namespace workspace\controllers;

use core\App;
use core\component_manager\lib\CM;
use core\component_manager\lib\Config;
use core\component_manager\lib\Mod;
use core\Controller;
use core\Debug;
use workspace\classes\Button;
use workspace\classes\Modules;
use workspace\models\User;
use workspace\widgets\Language;

class MainController extends Controller
{

    public function actionIndex()
    {
        $this->view->setTitle('Main Page');
        $this->view->addMeta('keywords', 'главная', ['some' => 'text']);
        $this->view->registerJs('/resources/js/bodyScript.js', [], true);

        return $this->render('main/index.tpl', ['h1' => 'Проект ' . App::$config['app_name']]);
    }

    public function actionLanguage()
    {
        Language::widget()->run();
    }

    public function actionSignUp()
    {
        $this->view->setTitle('Sign Up');
        if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
            $model = new User();
            $model->username = $_POST['username'];
            $model->email = $_POST['email'];
            $model->role = 2;
            $model->password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $model->save();

            $_SESSION['role'] = $model->role;
            $_SESSION['username'] = $model->username;

            $this->redirect('');
        } else {
            return $this->render('main/sign-up.tpl');
        }
    }

    public function actionSignIn()
    {
        $this->view->setTitle('Sign In');
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $model = User::where('username', $_POST['username'])->first();

            if (password_verify($_POST['password'], $model->password_hash)) {
                $_SESSION['role'] = $model->role;
                $_SESSION['username'] = $model->username;

                $this->redirect('');
            } else {
                $this->redirect('sign-in');
            }
        } else {
            return $this->render('main/sign-in.tpl');
        }
    }

    public function actionLogout()
    {
        session_destroy();
        $this->redirect('');
    }

    public function actionModules()
    {
        App::$header->add('Access-Control-Allow-Origin', '*');
        $content = file_get_contents('https://rep.craft-group.xyz/handler.php');
        $data = json_decode($content);

        $model = array();
        foreach ($data as $value)
            if ($value->type == 'module')
                array_push($model, new Modules($value->name, $value->version, $value->description));

        $options = [
            'serial' => '#',
            'fields' => [
                'action' => [
                    'label' => '',
                    'value' => function ($model) {
                        $mod = new Mod();
                        $button = new Button();

                        if ($mod->getModInfo($model->name)['status'] == 'active')
                            return $button->button('module-set-inactive', 'Отключить', $model->name, $model->name, 'toggle-on');
                        elseif ($mod->getModInfo($model->name)['status'] == 'inactive')
                            return $button->button('module-set-active', 'Включить', $model->name, $model->name, 'toggle-off');
                        else
                            return $button->button('module-download', 'Скачать', $model->name, $model->name, 'download');
                    }
                ],
                'delete' => [
                    'label' => '',
                    'value' => function ($model) {
                        $mod = new Mod();
                        $button = new Button();

                        if ($mod->getModInfo($model->name)['status'] == 'inactive')
                            return $button->button('fixed-width module-delete', 'Удалить', $model->name, $model->name, 'trash');
                        else
                            return '<div class="fixed-width"></div>';
                    }
                ],
                'status' => [
                    'label' => 'Статус',
                    'value' => function ($model) {
                        $mod = new Mod();
                        return '<div class="fixed-width">' . $mod->getModInfo($model->name)['status'] . '</div>';
                    }
                ],
                'name' => 'Название',
                'description' => 'Описание',
                'version' => 'Версия'
            ],
            'baseUri' => 'modules'
        ];

        App::$breadcrumbs->addItem(['text' => 'AdminPanel', 'url' => 'adminlte']);
        App::$breadcrumbs->addItem(['text' => 'Modules', 'url' => 'modules']);

        return $this->render('main/modules.tpl', ['model' => $model, 'options' => $options]);
    }

    public function actionModuleDownload()
    {
        try {
            $cm = new CM();
            $cm->download($_POST['slug']);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function actionSetActive()
    {
        try {
            $cm = new CM();
            $cm->modChangeStatusToActive($_POST['slug']);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function actionSetInactive()
    {
        try {
            $cm = new CM();
            $cm->modChangeStatusToInactive($_POST['slug']);
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function actionModuleDelete()
    {
        try {
            $cm = new CM();
            $mod = new Mod();
            $mod->deleteDirectory(ROOT_DIR . Config::get()->byKey($mod->getModInfo($_POST['slug'])['type'] . 'Path') . $_POST['slug']);
            $cm->modDeleteFromJson($_POST['slug']);
        } catch (\Exception $e) {
            return $e;
        }
    }

}