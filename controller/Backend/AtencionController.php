<?php
namespace Controller\Backend;
use Library\CrudController;
use Model\Entity\Usuario;
use Model\Entity\Abogado;

class AtencionController extends CrudController {
    static $template = 'Layout/base.html.php';
    protected $entity = null;
    protected $module = 'atencion';
    protected $route = [
        'index' => '/backend/atencion',
        'edit' => '/backend/atencion/edit',
    ];
    protected $vtitles = [
        'index'=>'Listado de Atenciones',
        'edit'=>'Editar Atencion',
        'new'=>'Nueva Atencion',
    ];
    protected $fields = [
        'fechayhora'=>['name'=>'Fecha y Hora','type'=>'text', 'class'=>"datetimepicker"],
        'usuario_id'=>['name'=>'Cliente','type'=>'select'],
        'abogado_id'=>['name'=>'Abogado','type'=>'select'],
        'estado'=>['name'=>'Estado','type'=>'select'],
    ];
    protected $messages = [
        'save'=>'Atención guardada con éxito',
        'create'=>'Atención creada con éxito',
    ];

    protected $status = [
        1=>'Agendada',
        2=>'Confirmada',
        3=>'Anulada',
        4=>'perdida',
        5=>'realizada',
    ];

    function __construct(){
        $this->entity = new \Model\Entity\Atencion;
    }

    function indexAction(){
        $action = parent::indexAction();
        $entities = [];
        $abogados = (new Abogado)->getAsOptions();
        $abg = [];
        foreach ($abogados as $abogado){
            $abg[$abogado['id']] = $abogado['name'];
        }
        $usuarios = (new Usuario)->getClients();
        $usr = [];
        foreach ($usuarios as $usuario){
            $usr[$usuario['id']] = $usuario['name'];
        }

        foreach($action['entities'] as $entity){
            $entity['usuario_id'] = $usr[$entity['usuario_id']];
            $entity['abogado_id'] = $abg[$entity['abogado_id']];
            $entity['estado'] = $this->status[$entity['estado']];
            $entities[] = $entity;
        }
        $action['entities'] = $entities;
        return $action;
    }

    function newAction(){
        unset($this->fields['estado']);
        $action = parent::newAction();
        $action['entity'] = [
            'usuario_id' => [
                'options'=>(new Usuario)->getClients(),
            ],
            'abogado_id' => [
                'options'=>(new Abogado)->getAsOptions(),
            ],
        ];
        return $action;
    }

    function editAction(){
        $action = parent::editAction();
        $action['entity']['usuario_id'] = [
            'selected'=> (int)$action['entity']['usuario_id'],
            'options'=>(new Usuario)->getClients(),
        ];
        $action['entity']['abogado_id'] = [
            'selected'=> (int)$action['entity']['abogado_id'],
            'options'=>(new Abogado)->getAsOptions(),
        ];
        foreach ($this->status as $id => $option) {
            $estatus_options[]=['id'=>(int)$id, 'name'=>$option];
        }
        $action['entity']['estado'] = [
            'selected'=> (int)$action['entity']['estado'],
            'options'=>$estatus_options,
        ];
        return $action;
    }

    function saveAction(){
        $e = $_POST['entity'];
        $valid = ($e['fechayhora'] && $e['usuario_id'] && $e['abogado_id'] && $e['estado']);
        if(!$valid) {
            $action = $this->editAction();
            $action['entity']['usuario_id']['selected'] = (int)$_POST['entity']['usuario_id'];
            $action['entity']['abogado_id']['selected'] = (int)$_POST['entity']['abogado_id'];
            $action['entity']['estado']['selected'] = (int)$_POST['entity']['estado'];

            unset($_POST['entity']['usuario_id'], $_POST['entity']['abogado_id'], $_POST['entity']['estado']);

            $action['entity'] = array_merge($action['entity'],$_POST['entity']);
            $action['entity']['id'] = $_GET['id'];
            $_SESSION['error'] = 'Los datos ingresados no son válidos';
            $action['_view'] = 'edit';

            return $action;
        }
        parent::saveAction();
    }

    function createAction(){
        $e = $_POST['entity'];
        $valid = ($e['fechayhora'] && $e['usuario_id'] && $e['abogado_id']);
        if(!$valid){
            $action = $this->editAction();
            $action['entity']['usuario_id']['selected'] = (int)$_POST['entity']['usuario_id'];
            $action['entity']['abogado_id']['selected'] = (int)$_POST['entity']['abogado_id'];

            unset($_POST['entity']['usuario_id'], $_POST['entity']['abogado_id']);

            $action['entity'] = array_merge($action['entity'],$_POST['entity']);
            $action['entity']['id'] = $_GET['id'];
            $_SESSION['error'] = 'Los datos ingresados no son válidos';
            $action['_view'] = 'edit';

            return $action;
        }
        $_POST['entity']['estado'] = 1;
        parent::createAction();
    }

}
