<div>
<fieldset>
    <?php foreach ($images as $image) : ?>
        <div class="img">
            <a target="_blank" href="<?= $image ?>">
                <img src="<?= $image ?>">
            </a>
            <?php if (!empty($_SESSION["id"])) : ?>
            <form action="delete_image.php" method="post">
                <button name="delete" id="gallerybtn" type="submit" value="<?= $image ?>">x</button> 
            </form>
            <?php endif ?> 
        </div>
    <?php endforeach ?>
</fieldset>
    <?php if (!empty($_SESSION["id"])) : ?>
        <form action="upload.php">
            <button class="btn btn-new" type="submit">Дадаць фота</button>
        </form>
    <?php endif ?> 
</div>