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
        'fechayhora'=>['name'=>'Fecha y Hora','type'=>'text'],
        'usuario_id'=>['name'=>'Cliente','type'=>'select'],
        'abogado_id'=>['name'=>'Abogado','type'=>'select'],
        'estado'=>['name'=>'Estado','type'=>'select'],
    ];
    protected $messages = [
        'save'=>'Abogado guardado con exito',
        'create'=>'Abogado creado con exito',
    ];

    protected $status = [
        1=>'Agendada',
        2=>'Confirmada',
        3=>'Anulada',
        4=>'perdida',
        5=>'realizada',
    ];

    function __construct(){
        //if(!$_SESSION['user']['gestor']) $this->redirect('/backend/client/home');
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
            'estado'=> [
                'options'=>[
                    ['id'=>1, 'name'=>'Agendada'],
                    ['id'=>2, 'name'=>'Confirmada'],
                    ['id'=>3, 'name'=>'Anulada'],
                    ['id'=>4, 'name'=>'perdida'],
                    ['id'=>5, 'name'=>'realizada'],
                ],
            ]
        ];
        return $action;
    }

    function editAction(){
        $action = parent::editAction();
        //echo "<pre>";print_r($action); exit;
        $action['entity']['usuario_id'] = [
            'selected'=> $action['entity']['usuario_id'],
            'options'=>(new Usuario)->getClients(),
        ];
        $action['entity']['abogado_id'] = [
            'selected'=> $action['entity']['abogado_id'],
            'options'=>(new Abogado)->getAsOptions(),
        ];
        foreach ($this->status as $id => $option) {
            $estatus_options[]=['id'=>$id, 'name'=>$option];
        }
        $action['entity']['estado'] = [
            'selected'=> $action['entity']['estado'],
            'options'=>$estatus_options,
        ];
        return $action;
    }
}
