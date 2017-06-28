<?php
namespace Model\Entity;

use Library\Repository;

class Abogado extends Repository {
    protected $table = 'abogado';

    function getAsOptions(){
        $sql = "SELECT id, CONCAT(nombre, ' ', apellido) name FROM $this->table";
        return $this->customQuery($sql);
    }
}
