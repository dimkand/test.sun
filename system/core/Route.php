<?php

 /**
 * Класс для создания роутинга(ЧПУ)
 */
class Route extends Component
{
    private $uri;

	private $controller;

	private $action;

	private $params;

	function __construct()
	{
        //Задаем значения по умолчанию
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

		$this->uri = urldecode(trim($_SERVER["REQUEST_URI"], '/'));

        $uri_paths = explode('?', $this->uri);

        //Получаем части такие как /controller/action/param1/param2/...
        $path = $uri_paths[0];

        if(empty($path))
            return;

        $path_parts = explode('/',$path);

        //Получаем значение контроллера если он есть
        if(current($path_parts)){
            $this->controller = current($path_parts);
            array_shift($path_parts);
        }
        //Получаем значение метода если он есть
        if(current($path_parts)){
            $this->action = current($path_parts);
            array_shift($path_parts);
        }

        $this->params = $path_parts;
	}

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }
}