<?php
namespace Model\Entity;

use Library\Repository;

class Usuario extends Repository {
  protected $table ='usuario';

  function getClients(){
      $sql = "SELECT id, CONCAT(nombre, ' ', apellido) name FROM $this->table WHERE perfil=0";
      return $this->customQuery($sql);
  }

  function getClientsByTipoPersona(){
    $sql = "SELECT COUNT(id) series, tipo_persona AS categories
    FROM $this->table
    WHERE perfil=0
    GROUP BY tipo_persona";
    return $this->customQuery($sql);
  }

  function getClientsByRange(){
    $sql = "SELECT
                PERIOD_DIFF(DATE_FORMAT(CURRENT_DATE(), '%Y%m'),
                DATE_FORMAT(fecha_incorporacion, '%Y%m')) AS categories,
                COUNT(id) AS series
    				  FROM $this->table
              WHERE perfil=0
    				  GROUP BY categories
              ";

    return $this->customQuery($sql);
  }

  function getClientsWithAtenciones(){
    $sql = "SELECT CONCAT(nombre,' ', apellido) AS categories, COUNT(a.id) AS series
    			   FROM usuario u JOIN atencion a ON u.id = a.usuario_id
             WHERE u.perfil = 0
    			   GROUP BY u.id";
    return $this->customQuery($sql);
  }

  function getDV($number){
      $x=9;$t=0;
      foreach(str_split(strrev($number)) as $digit) {
          $t+=$digit*$x;
          $x=($x==4)?9:$x-1;
      }
      $r = ($t % 11);
      $dv=($r==10)?"K":$r;

      return $dv;
  }

  function validateRut($rut){
    if (!preg_match('/^[0-9]{1,2}\.?[0-9]{3}\.?[0-9]{3}\-[0-9kK]{1}$/',$rut) ){
        return false;
    }
    list($number, $verifier_digit) = explode('-',strtoupper($rut), 2);
    $number = str_replace('.', '', $number);
    $x=9;$t=0;
    foreach(str_split(strrev($number)) as $digit) {
        $t+=$digit*$x;
        $x=($x==4)?9:$x-1;
    }
    $r = ($t % 11);
    $dv=($r==10)?"K":$r;
    if( $verifier_digit != $dv ) return false;

    //is valid
    return $number;
  }

}
