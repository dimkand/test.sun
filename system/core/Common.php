<?php

function printArray($array)
{
    echo "<pre>";
    print_r($array);
    echo "<pre />";
}

function baseUrl()
{
	return Config::get('base_url');
}

function errors($field = false)
{
	return FormValidation::getErrors($field);
}

// Сохранение значений полей input, textarea при провале валидации других полей формы
function setValue($key, $default_key = '')
{		
	return $_POST[$key] ?? $default_key;
}