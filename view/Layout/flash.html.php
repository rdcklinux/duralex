<?php if($_SESSION['message']):?>
    <p class="alert alert-success"><?=$_SESSION['message']?></p>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>
<?php if($_SESSION['error']):?>
    <p class="alert alert-danger"><?=$_SESSION['error']?></p>
    <?php unset($_SESSION['error']) ?>
<?php endif ?>
