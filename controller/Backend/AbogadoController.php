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
        'valorhora'=>['name'=>'Valor Hora','type'=>'number'],
    ];
    protected $messages = [
        'save'=>'Abogado guardado con exito',
        'create'=>'Abogado creado con exito',
    ];

    function __construct(){
        //if(!$_SESSION['user']['gestor']) $this->redirect('/backend/client/home');
        $this->entity = new \Model\Entity\Abogado;
    }
    /*
    function indexAction(){
        $action = parent::indexAction();
        $action['entities'] = $this->entity->getAllWithPerson();
        $append = [
            'rut'=>['name'=>'Rut paciente'],
            'nombre'=>['name'=>'Nombre paciente'],
            'apellido'=>['name'=>'Apellido paciente'],
        ];
        $action['fields'] += $append;

        return $action;
    }

    function releaseAction(){
      $id = (int)$this->get('id');
      $this->entity->release($id);

      $this->redirect("/backend/ambulancia?alert=liberada");
    }
    */
}
