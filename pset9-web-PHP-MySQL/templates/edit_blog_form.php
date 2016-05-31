<form action="edit_blog.php" method="post">
    <fieldset>
        <div class="form-group">
            <textarea autofocus id="form-topic" name="question" placeholder="Пытанне" rows="1" cols="100%"><?= $qvalue ?></textarea>
        </div>
        <div class="form-group">
            <textarea autofocus id="form-topic" name="header" placeholder="Тэма" rows="1" cols="100%"><?= $hvalue ?></textarea>
        </div>
        <div class="form-group">
            <textarea id="form-text" name="body" placeholder="Тэкст" rows="20" cols="100%"><?= $bvalue ?></textarea>
        </div>
        <div class="form-group">
            <button type="submit" name="id" value="<?= $idvalue ?>" class="btn btn-new">апублікаваць</button>
        </div>
        <a href="javascript:history.go(-1);">назад</a>
    </fieldset>
</form>