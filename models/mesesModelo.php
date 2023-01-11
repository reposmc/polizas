<?php
class MesesModelo extends model{
  private $idRoles;
  private $rol;

  public function __construct(){
    parent::__construct();

}

public function getIdMes(){
    return $this->idMes;
}
public function getMes(){
    return $this->mes;
}

public function setMes($mes){
    $this->mes=$mes;
}
public function setIdMes($idMes){
  $this->idMes=$idMes;
}

public function listadoMeses(){
    $arreglo = [];
    $sql = "SELECT idMes,mes FROM MESES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}
}
?>