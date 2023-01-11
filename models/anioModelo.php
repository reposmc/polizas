<?php
class AnioModelo extends model{
  private $idEjercicio;
  private $anio;

  public function __construct(){
    parent::__construct();

}

public function getIdEjercicio(){
    return $this->idEjercicio;
}
public function getAnio(){
    return $this->anio;
}

public function setIdEjercicio($idEjercicio){
    $this->idEjercicio= $idEjercicio;
}
public function setAnio($anio){
    $this->anio=$anio;
}

public function listadoEjercicio(){
    $arreglo = [];
    $sql = "SELECT * FROM EJERCICIOS_FISCALES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function insertarEjercicio(){
    $sql = "INSERT INTO  EJERCICIOS_FISCALES(anio) 
    VALUES('".$this->anio."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}

public function anio($anio){
    $arreglo = "";
    $sql = "SELECT idEjercicio,anio FROM EJERCICIOS_FISCALES
    WHERE anio='".$anio."' ";
    $datos = $this->getDb()->conectar()->query($sql);
   
        while($fila = $datos->fetch_assoc()){

            $arreglo = $fila['idEjercicio'];
        }
    return $arreglo;
           
      
    
}

public function modificarEjercicio(){
    $sql = "UPDATE  EJERCICIOS_FISCALES
    SET anio='".$this->anio.
    "' WHERE idEjercicio=".$this->idEjercicio;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}
?>