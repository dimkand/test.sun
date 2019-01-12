<h1>Список статей</h1>
<div>
    <a href="<?= baseUrl() ?>articles/add" class="btn btn-success">Добавить статью</a>
</div>
<div id="articles_list">
    <?php if (!is_array($articles)): ?>
        <div class="alert alert-primary" role="alert">
            Список статей пуст
        </div>
    <?php else:;
        foreach ($articles as $key => $article): ?>
            <div class="article">
                <div class="article_img">
                    <img src="<?= baseUrl() . ArticlesModel::$img_path . $article['img'] ?>" alt="<?= $article['title']?>">
                </div>
                <div class="article_title">
                    <a href="<?= baseUrl() . 'articles/show/' . $article['id'] ?>"><?= $article['title'] ?></a>
                </div>
                <div class="article_date">
                    <?= asDate($article['date']) ?>
                </div>
                <div class="article_control">
                    <a href="<?= baseUrl() . 'articles/edit/' . $article['id'] ?>"
                       class="btn btn-primary btn-sm">Редактировать</a>
                    <a href="<?= baseUrl() . 'articles/delete/' . $article['id'] ?>" class="btn btn-danger btn-sm">Удалить</a>
                </div>
            </div>
            <div class="hr"></div>
        <?php endforeach; endif; ?>
</div>
