
<?php if (!empty($_SESSION["id"])) : ?>
    <fieldset>
        <a href="post_blog.php" class="btn btn-new">дадаць</a>
    </fieldset>
<?php endif ?>

<?php foreach ($rows as $row) : ?>
    <fieldset id="blog">
        <p><?= $row["date"] ?></p><p class="ques"><h5><?= $row["question"] ?></h5></p>
        <p><h4><?= $row["header"] ?></h4></p>
        <p><?= $row["body"] ?></p>
    </fieldset>
    <?php if (!empty($_SESSION["id"])) : ?>
        <div>
            <a href="edit_blog.php?q=<?= $row["id"] ?>" class="btn btn-new">змяніць</a>
            <a href="delete_blog.php?q=<?= $row["id"] ?>" class="btn btn-new">выдаліць</a>
        </div>
    <?php endif ?>
<?php endforeach ?>
