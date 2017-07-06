<?php
namespace Controller\Backend;

use Library\Controller;
use Model\Entity\Usuario;
use Model\Entity\Atencion;

class EstadisticaController extends Controller {
  static $template = 'Layout/base.html.php';
  private $tipoPersona = [
    1=>'Juridica',
    2=>'Natural',
  ];

  private $meses = [
      1=>'Enero',
      2=>'Febrero',
      3=>'marzo',
      4=>'Abril',
      5=>'Mayo',
      6=>'Junio',
      7=>'Julio',
      8=>'Agosto',
      9=>'Septiembre',
      10=>'Octubre',
      11=>'Noviembre',
      12=>'Diciembre',
  ];

  protected $status = [
      1=>'Agendada',
      2=>'Confirmada',
      3=>'Anulada',
      4=>'perdida',
      5=>'realizada',
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

    return ['chart'=>$chart,'title'=>'Dashboard - Clientes'];
  }

  public function atencionesAction(){
      $atencion = new Atencion;
      $chart = [
        'meses'=>['categories'=>[],'series'=>[]],
        'fechas'=>['categories'=>[],'series'=>[]],
        'abogados'=>['categories'=>[],'series'=>[]],
        'especialidad'=>['categories'=>[],'series'=>[]],
        'estados'=>['categories'=>[],'series'=>[]],
      ];

      foreach($atencion->getByMeses() as $m){
        $chart['meses']['categories'][] = $this->meses[$m['categories']];
        $chart['meses']['series'][] = (int)$m['series'];
      }

      foreach($atencion->getByRangeDate() as $f){
        $chart['fechas']['categories'][] = $f['categories'];
        $chart['fechas']['series'][] = (int)$f['series'];
      }

      foreach($atencion->getByAbogado() as $a){
        $chart['abogados']['categories'][] = $a['categories'];
        $chart['abogados']['series'][] = (int)$a['series'];
      }

      foreach($atencion->getByEspecialidad() as $e){
        $chart['especialidad']['categories'][] = $e['categories'];
        $chart['especialidad']['series'][] = (int)$e['series'];
      }

      foreach($atencion->getByEstado() as $e){
        $chart['estados']['categories'][] = $this->status[$e['categories']];
        $chart['estados']['series'][] = (int)$e['series'];
      }

      return ['chart'=>$chart,'title'=>'Dashboard - Atenciones'];
  }
}
