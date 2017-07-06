 <h1><?=$vtitle?></h1>
 <?php if ($user_profile == 1):?>
     <a href="/backend/<?=$module?>/new" class="btn btn-success">Nuevo <?=ucfirst($module)?></a>
 <?php endif ?>
<table class="table data-table table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <?php foreach($fields as $field):?>
        <th><?=$field['name']?></th>
        <?php endforeach?>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($entities as $entity):?>
            <?php if($entity['gestor'] && in_array($user_profile,[3,2])) continue;?>
        <tr>
            <td><?=$entity['id']?></td>
            <?php foreach($fields as $key=>$field):?>
            <td><?=$entity[$key]?></td>
            <?php endforeach?>
            <td>
                <?php if ($user_profile == 1):?>
                <a href="/backend/<?=$module?>/edit?id=<?=$entity['id']?>" class="btn btn-success  btn-sm">Editar</a>
                <a href="/backend/<?=$module?>/delete?id=<?=$entity['id']?>" class="btn btn-danger  btn-sm">Eliminar</a>
                <?php endif?>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
