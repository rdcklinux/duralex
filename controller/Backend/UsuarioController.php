<?php
namespace Controller\Backend;

use Library\CrudController;
use Library\Controller;
use Model\Entity\Usuario;

class UsuarioController extends CrudController {
    static $template = 'Layout/base.html.php';

    protected $entity = null;
    protected $module = 'usuario';
    protected $route = [
        'index' => '/backend/usuario',
        'edit' => '/backend/usuario/edit',
    ];
    protected $vtitles = [
        'index'=>'Listado de Usuarios',
        'edit'=>'Editar Usuario',
        'new'=>'Nuevo Usuario',
    ];
    protected $fields = [
        'rut'=>['name'=>'Rut','type'=>'text'],
        'password'=>['name'=>'Password','type'=>'password'],
        'r_password'=>['name'=>'Repita Password','type'=>'password'],
        'nombre'=>['name'=>'Nombre','type'=>'text'],
        'apellido'=>['name'=>'Apellido','type'=>'text'],
        'tipo_persona'=>['name'=>'Tipo Persona','type'=>'select'],
        'fecha_incorporacion'=>['name'=>'Fecha Incorporacion','type'=>'text', 'class'=>'datepicker'],
        'telefonos'=>['name'=>'Telefonos','type'=>'text'],
        'direccion'=>['name'=>'Direccion','type'=>'text'],
        'perfil'=>['name'=>'Perfil','type'=>'select']
    ];

    protected $messages = [
        'save'=>'Usuario guardada con exito',
        'create'=>'Usuario creada con exito',
    ];

    protected $tipo_persona = [
        1=>'Juridica',
        2=>'Natural',
    ];

    protected $perfil = [
        0=>'Cliente',
        1=>'Administrador',
        2=>'Gerente',
        3=>'Secretaria',
    ];

    function __construct(){
        if($_SESSION['user']['perfil'] != 1){
            $this->vtitles['index'] = 'Listado de Clientes';
        }
        $this->entity = new \Model\Entity\Usuario;
    }

    function indexAction(){
      unset($this->fields['password'], $this->fields['r_password'], $this->fields['direccion']);
      $action = parent::indexAction();
      foreach($action['entities'] as $entity) {
          $entity['tipo_persona'] = $this->tipo_persona[$entity['tipo_persona']];
          $entity['perfil'] = $this->perfil[$entity['perfil']];

          $dv = $this->entity->getDV($entity['rut']);
          $entity['rut'] = $entity['rut'] . '-' . $dv;
          $entities[] = $entity;
      }
      $action['entities'] = $entities;
      return $action;
    }

    function newAction(){
        $action = parent::newAction();
        foreach ($this->tipo_persona as $id => $option) {
            $tipo_options[]=['id'=>(int)$id, 'name'=>$option];
        }
        $action['entity']['tipo_persona'] = [
            'selected'=> null,
            'options'=>$tipo_options,
        ];

        foreach ($this->perfil as $id => $option) {
            $perfil_options[]=['id'=>(int)$id, 'name'=>$option];
        }
        $action['entity']['perfil'] = [
            'selected'=> null,
            'options'=>$perfil_options,
        ];

        return $action;
    }

    function editAction(){
        $action = parent::editAction();
        $action['entity']['password']='';
        foreach ($this->tipo_persona as $id => $option) {
            $tipo_options[]=['id'=>(int)$id, 'name'=>$option];
        }
        $action['entity']['tipo_persona'] = [
            'selected'=> (int)$action['entity']['tipo_persona'],
            'options'=>$tipo_options,
        ];

        foreach ($this->perfil as $id => $option) {
            $perfil_options[]=['id'=>(int)$id, 'name'=>$option];
        }
        $action['entity']['perfil'] = [
            'selected'=> (int)$action['entity']['perfil'],
            'options'=>$perfil_options,
        ];
        $dv = $this->entity->getDV($action['entity']['rut']);
        $action['entity']['rut'] = $action['entity']['rut'] . '-' . $dv;

        return $action;
    }

    function saveAction(){
        if($_POST['entity']['password'] == $_POST['entity']['r_password'] && !empty($_POST['entity']['password'])){
            $_POST['entity']['password'] = sha1($_POST['entity']['password']);
            unset($_POST['entity']['r_password']);
        } else {
            unset($_POST['entity']['password'], $_POST['entity']['r_password']);
        }
        $rut = $this->entity->validateRut($_POST['entity']['rut']);
        $e = $_POST['entity'];
        $valid = ($rut && $e['nombre'] && $e['apellido'] && $e['tipo_persona'] && $e['fecha_incorporacion'] && $e['telefonos'] && $e['direccion'] && $e['perfil']);
        if(!$valid){
            $action = $this->editAction();
            unset($_POST['entity']['password'], $_POST['entity']['r_password']);
            $action['entity']['tipo_persona']['selected'] = (int)$_POST['entity']['tipo_persona'];
            $action['entity']['perfil']['selected'] = (int)$_POST['entity']['perfil'];
            unset($_POST['entity']['tipo_persona'], $_POST['entity']['perfil']);

            $action['entity'] = array_merge($action['entity'],$_POST['entity']);
            $action['entity']['id'] = $_GET['id'];
            $_SESSION['error'] = 'Los datos ingresados no son válidos';
            return $action;
        }

        $_POST['entity']['rut']=$rut;
        parent::saveAction();
    }

    function createAction(){
        if($_POST['entity']['password'] == $_POST['entity']['r_password'] && !empty($_POST['entity']['password'])){
            $_POST['entity']['password'] = sha1($_POST['entity']['password']);
            unset($_POST['entity']['r_password']);
        } else {
            unset($_POST['entity']['password'], $_POST['entity']['r_password']);
        }
        $rut = $this->entity->validateRut($_POST['entity']['rut']);
        $e = $_POST['entity'];
        $valid = ($rut && $e['nombre'] && $e['apellido'] && $e['tipo_persona'] && $e['fecha_incorporacion'] && $e['telefonos'] && $e['direccion'] && $e['perfil']);
        if(!$valid){
            $action = $this->editAction();
            unset($_POST['entity']['password'], $_POST['entity']['r_password']);
            $action['entity']['tipo_persona']['selected'] = (int)$_POST['entity']['tipo_persona'];
            $action['entity']['perfil']['selected'] = (int)$_POST['entity']['perfil'];
            unset($_POST['entity']['tipo_persona'], $_POST['entity']['perfil']);

            $action['entity'] = array_merge($action['entity'],$_POST['entity']);
            $_SESSION['error'] = 'Los datos ingresados no son válidos';
            return $action;
        }
        $_POST['entity']['rut']=$rut;
        parent::createAction();
    }
}
