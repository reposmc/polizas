<?php

class DepartamentoModelo extends Model{
    private $idDepto;
    private $nom_depto;
  

    public function __construct(){
        parent::__construct();
}
public function getIdDepto(){
    return $this->idDepto;
}
public function getNom_depto(){
    return $this->nom_depto;
}



public function setIdDepto($idDepto){
    $this->idDepto= $idDepto;
}
public function setNom_depto($nom_depto){
    $this->nom_depto= $nom_depto;
}



public function listadoDepartamento(){
    $arreglo = [];
    $sql = "SELECT idDepto,nom_depto FROM DEPARTAMENTOS  order by idDepto";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function insertarDepartamento(){
    $sql = "INSERT INTO DEPARTAMENTOS(nom_depto) 
    VALUES('".$this->nom_depto."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}

public function modificarDepartamento(){
    $sql = "UPDATE DEPARTAMENTOS
    SET nom_depto='".$this->nom_depto.
    "' WHERE idDepto=".$this->idDepto;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}



?>