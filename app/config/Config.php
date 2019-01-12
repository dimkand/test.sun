<?php

/**
 * Базовый URI
 */
Config::set('base_url', 'http://www.test.sun/');
/**
 * Включение и отключение вывода ошибок php
 */
Config::set('show_errors', true);
/**
 * Котроллер по умолчанию
 */
Config::set('default_controller', 'articles');
/**
 * Метод по умолчанию
 */
Config::set('default_action', 'index');
/**
 * Параметры соединения с базой данных
 */
Config::set('db.enable', true);
Config::set('db.host', 'localhost');
Config::set('db.name', 'testsun');
Config::set('db.user', 'phpmyadmin');
Config::set('db.pass', 'root');
/**
 * Страница ошибки 404
 */
Config::set('404', '404');

Config::set('default_img', 'default_img.jpeg');