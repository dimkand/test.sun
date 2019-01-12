<?php

class Articles extends Controller
{
    function __construct()
    {
        $this->load->helper('FormatHelper');
    }

    public function index()
    {
        $data['articles'] = $this->articlesModel->getAll('*', true);

        $this->load->view('Header');
        $this->load->view('articles/ShowAll', $data);
        $this->load->view('Footer');
    }

    public function showAll()
    {
        $data['articles'] = $this->articlesModel->getAll('*', true);

        $html = $this->load->view('articles/ShowAll', $data, true);
        echo $html;
    }

    public function show($id)
    {
        $article = $this->articlesModel->get($id);
        $this->load->view('articles/Show', $article);
    }

    public function add()
    {
        if (isset($_FILES['img']) && $this->formValidation->run($this->articlesModel->articles_rules)) {

            $img_name = $this->articlesModel->renameImgFile($_FILES['img']);

            $article = array(
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'img' => $img_name,
                'date' => date('Y-m-d')
            );

            $this->articlesModel->insert($article);

            $html = $this->load->view('InfoPage', ['info' => 'Статья добавлена'], true);
            echo $html;
            return;
        }

        $html = $this->load->view('articles/Add', [], true);
        echo $html;
    }

    public function edit($id)
    {
        if (isset($_FILES['img']) && $this->formValidation->run($this->articlesModel->articles_rules)) {

            $img_name = $this->articlesModel->renameImgFile($_FILES['img']);

            $article = array(
                'title' => $_POST['title'],
                'text' => $_POST['text'],
                'img' => $img_name,
                'date' => date('Y-m-d')
            );

            $this->articlesModel->update($article, 'id', $id);

            $html = $this->load->view('InfoPage', ['info' => 'Статья отредактирована'], true);
            echo $html;
            return;
        }

        $article = $this->articlesModel->get($id);
        $html = $this->load->view('articles/Edit', $article, true);
        echo $html;
    }

    public function delete($id)
    {
        $this->articlesModel->deleteImgFileByid($id);
        $this->articlesModel->delete($id);

        $html = $this->load->view('InfoPage', ['info' => 'Статья удалена'], true);
        echo $html;
    }
}