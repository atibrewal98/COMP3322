<?php  if (count($errors) > 0) : ?>
    <div class = "error">
        <?php foreach ($errors as $error) : ?>
            <h1 class = "hg"><?php echo $error ?></h1>
        <?php endforeach ?>
    </div>
<?php  endif ?>
<?php  if (count($confirm) > 0) : ?>
    <div class = "error">
        <?php foreach ($confirm as $error) : ?>
            <h1 class = "hg"><?php echo $error ?></h1>
        <?php endforeach ?>
    </div>
<?php  endif ?>
<?php  if (count($same) > 0) : ?>
    <div class = "error">
        <?php foreach ($same as $error) : ?>
            <h1 class = "hg"><?php echo $error ?></h1>
        <?php endforeach ?>
    </div>
<?php  endif ?>