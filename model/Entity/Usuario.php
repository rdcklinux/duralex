<?php
namespace Model\Entity;

use Library\Repository;

class Usuario extends Repository {
  protected $table ='usuario';

  function getClients(){
      $sql = "SELECT id, CONCAT(nombre, ' ', apellido) name FROM $this->table WHERE perfil=0";
      return $this->customQuery($sql);
  }
}
