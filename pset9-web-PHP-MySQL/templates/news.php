<?php if(!empty($_SESSION["id"])) : ?>
    <a href="update.php" class="btn btn-new">Дадаць аб'явы</a>
<?php endif ?>

<form action="index.php" method="get">
    <?php foreach($positions as $position): ?>
        <fieldset id="blog">
        <p>
            <a href="index.php?newsdate=<?= $position['date'] ?>" ><?= $position['date'] ?></a>
            <h3><a href="index.php?newsid=<?= $position['id'] ?>" ><?= $position["header"] ?></a></h3>
        </p>
        <p><?= $position["body"] ?></p>            
        </fieldset>
        <p>    
            <?php if(!empty($_SESSION["id"])) : ?>
                <a href="edit.php?newsid=<?= $position['id'] ?>" class="btn btn-new">Выправіць</a>
                <a href="delete.php?newsid=<?= $position['id'] ?>" class="btn btn-new">Выдаліць</a>
            <?php endif ?>  
        </p>
    <?php endforeach ?>
</form>
