<?php
namespace Model\Entity;

use Library\Repository;

class Atencion extends Repository {
    protected $table = 'atencion';

    function getByRangeDate(){
        $sql = "SELECT COUNT(id) AS series, date_format(fechayhora, '%m-%Y') AS categories
        		FROM $this->table
        		GROUP BY categories ORDER BY categories DESC";
        return $this->customQuery($sql);
    }

    function getByMeses(){
        $sql = "SELECT MONTH(fechayhora) AS categories, COUNT(id) AS series
                FROM $this->table
                GROUP BY categories";
        return $this->customQuery($sql);
    }

    function getByEspecialidad(){
        $sql = "SELECT COUNT(at.id) AS series, a.especialidad AS categories
        		FROM $this->table at JOIN abogado a ON at.abogado_id = a.id
        		GROUP BY categories";
        return $this->customQuery($sql);
    }

    function getByAbogado(){
        $sql = "SELECT COUNT(at.id) AS series, CONCAT(a.nombre,' ', a.apellido) AS categories
        		FROM $this->table at JOIN abogado a ON at.abogado_id = a.id
        		GROUP BY categories";
        return $this->customQuery($sql);
    }

    function getByEstado(){
        $sql = "SELECT COUNT(a.id) AS series, a.estado AS categories
                FROM $this->table a
                GROUP BY categories";
        return $this->customQuery($sql);
    }
}
