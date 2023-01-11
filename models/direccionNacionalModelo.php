<?php

class DireccionNacionalModelo extends Model{
    private $idDnac;
    private $nom_dnac;

    public function __construct(){
        parent::__construct();
}

public function getIdDnac(){
    return $this->idDnac;
}

public function getNom_dnac(){
    return $this->nom_dnac;
}

public function setIdDnac($idDnac){
    $this->idDnac= $idDnac;
}
public function setNom_dnac($nom_dnac){
    $this->nom_dnac= $nom_dnac;
}

public function listadoDirecciones(){
    $arreglo = [];
    $sql = "SELECT * FROM DIRECCIONES_NACIONALES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function insertarDirecciones(){
    $sql = "INSERT INTO DIRECCIONES_NACIONALES(nom_dnac) 
    VALUES('".$this->nom_dnac."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}

public function modificarDirecciones(){
    $sql = "UPDATE DIRECCIONES_NACIONALES SET nom_dnac='".$this->nom_dnac."' WHERE idDnac=".$this->idDnac;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}



?>