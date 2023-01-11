<?php
class DependenciaModelo extends model{
  private $idDependencia;
  private $nom_dependencia;

  public function __construct(){
    parent::__construct();

}

public function getIdDependencia(){
    return $this->idDependencia;
}
public function getNom_dependencia(){
    return $this->nom_dependencia;
}

public function setIdDependencia($idDependencia){
    $this->idDependencia= $idDependencia;
}
public function setNom_dependencia($nom_dependencia){
    $this->nom_dependencia=$nom_dependencia;
}

public function listadoDependencia(){
    $arreglo = [];
    $sql = "SELECT * FROM DEPENDENCIAS";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function insertarDependencia(){
    $sql = "INSERT INTO  DEPENDENCIAS(nom_dependencia) 
    VALUES('".$this->nom_dependencia."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}

public function modificarDependencia(){
    $sql = "UPDATE  DEPENDENCIAS
    SET nom_dependencia='".$this->nom_dependencia.
    "' WHERE idDependencia=".$this->idDependencia;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}
?>