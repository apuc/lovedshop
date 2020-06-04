<?php


namespace core;


class Widget
{
    /**
     * @var View
     */
    public $view;

    protected $params;

    public $viewPath = '/widgets/views/';
    private $defaultViewPath = '/widgets/views/';

    public function __construct()
    {
        $this->view = View::get();

        $this->view->setViewPath(WORKSPACE_DIR . $this->viewPath);
    }

    public function run()
    {
    }

    public function setOptions($data)
    {
        $this->params = $data;
        return $this;
    }

    public static function widget()
    {
        $class = get_called_class();
        return new $class;
    }

}