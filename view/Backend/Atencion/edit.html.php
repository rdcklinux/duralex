<h1><?=$vtitle?></h1>
<?php if($_SESSION['message']):?>
    <p class="alert alert-success"><?=$_SESSION['message']?></p>
    <?php unset($_SESSION['message']) ?>
<?php endif ?>
<form class="form" action="/backend/<?=$module?>/<?=$method?$method:"save?id=$entity[id]"?>" method="post">
<table class="table">
    <?php foreach ($fields as $key => $field):?>
    <tr>
        <td><?=$field['name']?></td>
        <td>
            <?php if($field['type'] == 'select'):?>
                <select class="form-control" name="entity[<?=$key?>]" required>
                    <option value="">Seleccione <?=$field['name']?></option>
                    <?php foreach($entity[$key]['options'] as $option):?>
                        <option value="<?=$option['id']?>" <?=$entity[$key]['selected']==$option['id']?'selected':''?> ><?=$option['name']?></option>
                    <?php endforeach ?>
                </select>
            <?php else: ?>
                <input value="<?=$entity[$key]?>" type="<?=$field['type']?>" class="form-control" name="entity[<?=$key?>]">
            <?php endif ?>
        </td>
    </tr>
    <?php endforeach ?>
</table>
<a href="/backend/<?=$module?>" class="btn btn-default">Volver</a>
<button type="submit" class="btn btn-success">Guardar</button>
</form>
