<?php

 /**
 * Класс для загрузки классов
 */
class Load
{
	private function loader($path, $data = false, $buffer = false)
	{
		if($data)
			extract($data);

		if(file_exists($path)){
			if($buffer){// Если нужна буферизация вывода в перемеенную
				ob_start();
				require_once($path);
				return ob_get_clean();
			}
			require_once($path);
		}
		else
			throw new Exception("Не могу подключить фаил. Файла {$path} не существует");
	}

	// Загрузка моделей
	public function model($model_name)
	{
		$this->loader(APPPATH.DC.'models'.DC.$model_name.'.php');
	}

	// Загрузка видов
	public function view($view_name, $data = false, $buffer = false)
	{
		return $this->loader(APPPATH.DC.'views'.DC.$view_name.'.php', $data, $buffer);
	}

	// Загрузка хелперов
	public function helper($helper_name)
	{
        $this->loader(APPPATH.DC.'helpers'.DC.$helper_name.'.php');
	}

	// Загрузка библиотек
	public function lib($lib_name)
	{
		    // Ищем библиотеку в каталоге App
		if(file_exists(APPPATH.DC.'libs'.DC.$lib_name.'.php'))
			$this->loader(APPPATH.DC.'libs'.DC.$lib_name.'.php');
		else// Если там нет то ищем в базовом каталоге фреймворка
			$this->loader(BASEPATH.DC.'libs'.DC.$lib_name.'.php');
	}
}