<?php
namespace Controller\Backend;

use Library\Controller;
use Model\Entity\Usuario;

class EstadisticaController extends Controller {
  static $template = 'Layout/base.html.php';
  private $tipoPersona = [
    1=>'Juridica',
    2=>'Natural',
  ];

  public function indexAction(){
    $usuario = new Usuario;
    $chart = [
      'tipopersona'=>['categories'=>[],'series'=>[]],
      'rango'=>['categories'=>[],'series'=>[]],
      'atenciones'=>['categories'=>[],'series'=>[]],
    ];
    foreach($usuario->getClientsByRange() as $r){
      $chart['rango']['categories'][] = $r['categories'];
      $chart['rango']['series'][] = (int)$r['series'];
    }

    foreach($usuario->getClientsByTipoPersona() as $tp){
      $chart['tipopersona']['categories'][] = $this->tipoPersona[$tp['categories']];
      $chart['tipopersona']['series'][] = (int)$tp['series'];
    }

    foreach($usuario->getClientsWithAtenciones() as $at){
      $chart['atenciones']['categories'][] = $at['categories'];
      $chart['atenciones']['series'][] = (int)$at['series'];
    }

    return ['chart'=>$chart,'title'=>'Dashboard'];
  }
}
