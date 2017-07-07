<?php
namespace Controller\Backend;

use Library\CrudController;

class AbogadoController extends CrudController {
    static $template = 'Layout/base.html.php';

    protected $entity = null;
    protected $module = 'abogado';
    protected $route = [
        'index' => '/backend/abogado',
        'edit' => '/backend/abogado/edit',
    ];
    protected $vtitles = [
        'index'=>'Listado de Abogados',
        'edit'=>'Editar Abogados',
        'new'=>'Nueva Abogados',
    ];
    protected $fields = [
        'rut'=>['name'=>'Run','type'=>'text'],
        'nombre'=>['name'=>'Nombre','type'=>'text'],
        'apellido'=>['name'=>'Apellido','type'=>'text'],
        'especialidad'=>['name'=>'Especialidad','type'=>'text'],
        'valor_hora'=>['name'=>'Valor Hora','type'=>'number'],
    ];
    protected $messages = [
        'save'=>'Abogado guardado con exito',
        'create'=>'Abogado creado con exito',
    ];

    function __construct(){
        $this->entity = new \Model\Entity\Abogado;
    }

    function indexAction(){
      $action = parent::indexAction();
      foreach($action['entities'] as $entity) {
          $dv = (new \Model\Entity\Usuario)->getDV($entity['rut']);
          $entity['rut'] = $entity['rut'] . '-' . $dv;
          $entities[] = $entity;
      }
      $action['entities'] = $entities;
      return $action;
    }

    function editAction(){
        $action = parent::editAction();
        $dv = (new \Model\Entity\Usuario)->getDV($action['entity']['rut']);
        $action['entity']['rut'] = $action['entity']['rut'] . '-' . $dv;

        return $action;
    }

    function saveAction(){
        $rut = (new \Model\Entity\Usuario)->validateRut($_POST['entity']['rut']);
        $e = $_POST['entity'];
        $valid = ($rut && $e['nombre'] && $e['apellido'] && $e['especialidad'] && $e['valor_hora']);
        if(!$valid) {
            $action = $this->editAction();
            $action['entity'] = $_POST['entity'];
            $action['entity']['id'] = $_GET['id'];
            $_SESSION['error'] = 'Los datos ingresados no son válidos';
            $action['_view'] = 'edit';
            return $action;
        }
        $_POST['entity']['rut']=$rut;
        parent::saveAction();
    }

    function createAction(){
        $rut = (new \Model\Entity\Usuario)->validateRut($_POST['entity']['rut']);
        $e = $_POST['entity'];
        $valid = ($rut && $e['nombre'] && $e['apellido'] && $e['especialidad'] && $e['valor_hora']);
        if(!$valid){
            $action = $this->editAction();
            $action['entity'] = $_POST['entity'];
            $_SESSION['error'] = 'Los datos ingresados no son válidos';
            return $action;
        }
        $_POST['entity']['rut']=$rut;
        parent::createAction();
    }
}
