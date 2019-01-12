<?php

class ArticlesModel extends Crud
{
    // название таблицы в БД с которой работает модель
    public $table = 'articles';
    // название ключа в БД с которой работает модель
    public $id_key = 'id';
    // путь к изображениям статей
    public static $img_path = 'img/articles/';
    // правила валидации статей
    public $articles_rules = array(
        array(
            'field' => 'title',
            'label' => 'Название статьи',
            'rules' => 'required, max_length[255]'
        ),
        array(
            'field' => 'text',
            'label' => 'Текст статьи',
            'rules' => 'required'
        )
    );
}