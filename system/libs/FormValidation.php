<?php

class FormValidation
{
	private static $errors;

	public function run($rules_array)
	{
		self::$errors = array();

		foreach ($rules_array as $field) {

			$input = $_POST[$field['field']] ?? $_FILES[$field['field']]['name'];// Входные данные введенные пользователем в поле
			$rules = explode(', ', $field['rules']);
			
			foreach ($rules as $rule) {
				switch (true) {
					case $rule == 'required':
					    if(!$input)
					    	$this->addError($field['field'], "Поле '{$field['label']}' обязательно для заполнения. ");
						break;

					case strpos($rule, 'min_length') !== false:
					    $min = (int) substr($rule, 11, -1);
					    if(mb_strlen($input) < $min)
					    	$this->addError($field['field'], "Длина поля '{$field['label']}' должна быть не меньше $min. ");
						break;

					case strpos($rule, 'max_length') !== false:
					    $max = (int) substr($rule, 11, -1);
					    if(mb_strlen($input) > $max)
					    	$this->addError($field['field'], "Длина поля '{$field['label']}' должна быть не больше $max. ");
						break;

					case $rule == 'int':
					    if(!is_int($input))
					    	$this->addError($field['field'], "Значение поля '{$field['label']}' должно быть целочисленным. ");
						break;

					case $rule == 'numeric':
					    if(!is_numeric($input))
					    	$this->addError($field['field'], "Значение поля '{$field['label']}' должно быть числом. ");
						break;

					case strpos($rule, 'min') !== false:
					    $min = (int) substr($rule, 4, -1);
					    if($input < $min)
					    	$this->addError($field['field'], "Величина '{$field['label']}' должна быть не меньше $min. ");
						break;

				    case strpos($rule, 'max') !== false:
					    $max = (int) substr($rule, 4, -1);
					    if($input > $max)
					    	$this->addError($field['field'], "Величина '{$field['label']}' должна быть не больше $max. ");
						break;

					case $rule == 'email':
					    if(!filter_var($input, FILTER_VALIDATE_EMAIL) && !empty($input))
					    	$this->addError($field['field'], "Значение поля '{$field['label']}' должно соответствовать формату email. ");
						break;

					case $rule == 'url':
					    if(!filter_var($input, FILTER_VALIDATE_URL) && !empty($input))
					    	$this->addError($field['field'], "Значение поля '{$field['label']}' должно соответствовать формату URL. ");
						break;

					case $rule == 'tel':
						$pattern = "#^\+[0-9]{1,2}\([0-9]{3}\)[0-9]+\-[0-9]+\-[0-9]+$#"; 
					    if(!preg_match($pattern, $input) && !empty($input))
					    	$this->addError($field['field'], "Значение поля '{$field['label']}' должно соответствовать форату номера телефона +0(000)000-00-00. ");
						break;

					case $rule == 'img':
						if($_FILES[$field['field']]['error'] == 1) {
							$this->addError($field['field'], "Размер файла слишком велик для закачки и ограничен настройками php.ini");
							break;
						}
						if($_FILES[$field['field']]['error'] != 0)
							break;

						$file_path = $_FILES[$field['field']]['tmp_name'];
						$allowedExts = array("gif", "jpeg", "jpg", "png", "GIF", "JPEG", "JPG", "PNG");
						$temp = explode(".", $input);
						$ext = end($temp);

						if (!in_array($ext, $allowedExts)){
							$this->addError($field['field'], "Расширение файла не соответствувет форматам: gif, jpeg, jpg, png");
							break;
						}

						$what = @getimagesize($file_path);
						switch(strtolower($what['mime']))
						{
						    case 'image/png':
						        break;
						    case 'image/jpeg':
						        break;
						    case 'image/gif':
						        break;
						    default: 
						    	$this->addError($field['field'], "Формат изображения не поддерживается. Выбирите файл формата: gif, jpeg, jpg, png");
						    	break;
						}
				}
			}
		}
		//если нет ошибок функция возвращает true иначе false
		return empty(self::$errors);
	}

	private function addError($field, $error_string)
	{
		isset(self::$errors[$field]) ? self::$errors[$field] .= $error_string : self::$errors[$field] = $error_string;
	}

	public static function getErrors($field = false)
	{
		if(!$field)
			return self::$errors;
		
		return isset(self::$errors[$field]) ? self::$errors[$field] : '';
	}
}