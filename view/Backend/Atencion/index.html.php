<div class="row">
<div class="col-md-2"></div>
  <div class="col-md-8">

    <h1><?=$vtitle?></h1>
    <br>
    <a href="/backend/<?=$module?>/new" class="btn btn-info">Nueva <?=ucfirst($module)?></a>
    <br><br>
    <table class="table data-table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <?php foreach($fields as $field):?>
            <th><?=$field['name']?></th>
            <?php endforeach?>
            <th></th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($entities as $entity):?>
            <tr>
                <td><?=$entity['id']?></td>
                <?php foreach($fields as $key=>$field):?>
                <td><?=$entity[$key]?></td>
                <?php endforeach?>
                <td>
                    <?php if($user_profile != 2): ?>
                        <a href="/backend/<?=$module?>/edit?id=<?=$entity['id']?>" class="btn btn-success btn-xs btn-block">Editar</a>
                    <?php endif ?>
                    <?php if($user_profile == 1): ?>
                        <a href="/backend/<?=$module?>/delete?id=<?=$entity['id']?>" class="btn btn-danger btn-xs btn-block">Eliminar</a>
                    <?php endif ?>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
    </table>
  </div>
</div>
