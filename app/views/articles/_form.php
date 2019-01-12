<form id="aform" enctype="multipart/form-data" action="<?= $action?>" method="post">
    <div class="form-group">
        <label for="title">Название :</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Название статьи"
               value="<?= setValue('title', $title ?? '') ?>">
        <div class="error"><?= errors('title'); ?></div>
    </div>
    <div class="form-group">
        <label for="text">Текст</label>
        <textarea class="form-control" id="text" name="text"
                  placeholder="Текст статьи"><?= setValue('text', $text ?? '') ?></textarea>
        <div class="error"><?= errors('text'); ?></div>
    </div>
    <div id="aform_img" class="form-group">
        <label for="img">Катринка :</label>
        <?php if(isset($img)):?>
            <img id="img"  src="<?= baseUrl() . ArticlesModel::$img_path . ($img ?? '')?>" title="<?= $title ?? ''?>">
        <?php endif;?>
        <input type="file" class="form-control-file" name="img">
        <input type="hidden" name="old_img" value="<?= $img ?? ''?>">
    </div>
    <a class="btn btn-info" href="<?= baseUrl(); ?>articles/showAll">Назад на главную</a>
    <button type="submit" onClick="articleSave()" class="btn btn-primary" name="submit">Сохранить</button>
</form>