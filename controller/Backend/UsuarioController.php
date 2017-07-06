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
        'fecha_incorporacion'=>['name'=>'Fecha Incorporacion','type'=>'text'],
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
          $entities[] = $entity;
      }
      $action['entities'] = $entities;
      return $action;
    }

    function editAction(){
        $action = parent::editAction();
        $action['entity']['password']='';
        foreach ($this->tipo_persona as $id => $option) {
            $tipo_options[]=['id'=>$id, 'name'=>$option];
        }
        $action['entity']['tipo_persona'] = [
            'selected'=> $action['entity']['tipo_persona'],
            'options'=>$tipo_options,
        ];
        return $action;
    }

    function saveAction(){
        if($_POST['entity']['password'] == $_POST['entity']['r_password'] && !empty($_POST['entity']['password'])){
            $_POST['entity']['password'] = sha1($_POST['entity']['password']);
            unset($_POST['entity']['r_password']);
        } else {
            unset($_POST['entity']['password'], $_POST['entity']['r_password']);
        }

        parent::saveAction();
    }


    function createAction(){
        if($_POST['entity']['password'] == $_POST['entity']['r_password'] && !empty($_POST['entity']['password'])){
            $_POST['entity']['password'] = sha1($_POST['entity']['password']);
            unset($_POST['entity']['r_password']);
        } else {
            unset($_POST['entity']['password'], $_POST['entity']['r_password']);
        }

        parent::createAction();
    }
    /*
    function setSelectedClientAction(){
        // Asigna un cliente 'seleccionado' a una variable de sesion, para que cuando queramos asignar una ambulancia ya sepamos a quien le pertenecera
        $rut = $this->post('rut');
        // ############### MEJORAR SEGURIDAD EVITANDO INJECCION SQL!!! #######
        $query = "select * from persona where rut = '$rut' and cliente = 1 and activo = 1;";
        $cliente = (new Usuario)->customQuery($query)-> fetch();
        if ($cliente == false) {
          unset($_SESSION['selectedCliente']);
          echo json_encode(['success'=> false, 'alert_param'=>'?alert=rut_no_encontrado']); exit;
        }
        $_SESSION['selectedCliente']= $cliente;
        echo json_encode(['cliente'=> $cliente, 'alert_param'=>'?alert=cliente_seleccionado', 'success'=> true]); exit;

    }

    function asignarAmbulanciaAction(){
      $user_id = $this->post('user_id');
      $query_ambulancias_libres = "select * from ambulancia where persona_id is null limit 1;";
      $ambulancia = (new Ambulancia)->customQuery($query_ambulancias_libres)->fetch();
      $ambulancia_id = $ambulancia['id'];
      if ($ambulancia == false) {
        echo json_encode(['success'=> false, 'alert_param'=>'?alert=sin_ambulancias_libres']); exit;
      }
      $query_usario_con_ambulancia = "select * from ambulancia where persona_id = $user_id limit 1;";
      $ya_tiene_ambulancia = (new Ambulancia)->customQuery($query_usario_con_ambulancia)->fetch();

      if ($ya_tiene_ambulancia != false) {
        echo json_encode(['success'=> false, 'alert_param'=>'?alert=ambulancia_ya_asignada']); exit;
      }

      $query_asignar_ambulancia = "update ambulancia set persona_id = $user_id where id = $ambulancia_id;";
      $ambulancia = (new Ambulancia)->customQuery($query_asignar_ambulancia);
      echo json_encode(['success'=> true, 'alert_param'=>'?alert=ambulancia_asignada', "ambulancia_id"=> $ambulancia_id]); exit;

    }
    */
}
