<?php

class App extends Component
{
    private $route;

    public function __construct()
    {
        require_once(BASEPATH . DC . 'core' . DC . 'Route.php');
        $this->route = new Route();

        // Если в Config параметр db.enable = true то инклюдим Db.php
        if (Config::get('db.enable'))
            require_once(BASEPATH . DC . 'core' . DC . 'Db.php');

        // Загрузка autoload классов
        $autoload = require_once(APPPATH . DC . 'config' . DC . 'AutoLoad.php');
        if (!empty($autoload['models'])) {
            $autoload_models = explode(', ', $autoload['models']);
            foreach ($autoload_models as $model)
                $this->load->model($model);
        }
        if (!empty($autoload['libs'])) {
            $autoload_libs = explode(', ', $autoload['libs']);
            foreach ($autoload_libs as $lib)
                $this->load->lib($lib);
        }
    }

    public function run()
    {
        $controller_class_name = ucfirst($this->route->getController());
        $controller_method_name = $this->route->getAction();


        $controller_path = APPPATH . DC . 'controllers' . DC . $controller_class_name . '.php';
        if (file_exists($controller_path))
            require_once($controller_path);
        else {
            $this->load->view(Config::get('404'));
            return;
        }

        $controller_object = new $controller_class_name;

        if (method_exists($controller_object, $controller_method_name)) {
            is_array($this->route->getParams()) ? $controller_object->$controller_method_name(...$this->route->getParams()) : $controller_object->$controller_method_name();
        } else {
            $this->load->view(Config::get('404'));
            return;
        }
    }
}