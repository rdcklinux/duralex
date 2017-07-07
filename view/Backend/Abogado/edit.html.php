<h1><?=$vtitle?></h1>
<?php include('../view/Layout/flash.html.php'); ?>
<form class="form" action="/backend/<?=$module?>/<?=$method?$method:"save?id=$entity[id]"?>" method="post">
<table class="table">
    <?php foreach ($fields as $key => $field):?>
    <tr>
        <td><?=$field['name']?></td>
        <td><input value="<?=$entity[$key]?>" type="<?=$field['type']?>" class="form-control" name="entity[<?=$key?>]"></td>
    </tr>
    <?php endforeach ?>
</table>
<a href="/backend/<?=$module?>" class="btn btn-default">Volver</a>
<button type="submit" class="btn btn-success">Guardar</button>
</form>
