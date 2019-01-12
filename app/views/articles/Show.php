<div id="in_article">
    <h1>
        <?= $title ?>
    </h1>
    <div class="article_control">
        <a href="<?= baseUrl(). 'articles/edit/' . $id?>" class="btn btn-primary">Редактировать</a>
        <a href="<?= baseUrl(). 'articles/delete/' . $id?>" class="btn btn-danger">Удалить</a>
    </div>
    <div id="in_article_date">
        <?= asDate($date); ?>
    </div>
    <div id="in_article_text">
        <?= $text ?>
    </div>
    <a class="btn btn-info" href="<?= baseUrl(); ?>articles/showall">Назад на главную</a>
</div>