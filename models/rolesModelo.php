<?php
class RolesModelo extends model{
  private $idRoles;
  private $rol;

  public function __construct(){
    parent::__construct();

}

public function getIdRoles(){
    return $this->idRoles;
}
public function getRol(){
    return $this->rol;
}

public function setRol($rol){
    $this->rol= $rol;
}
public function setIdRoles($idRoles){
    $this->idRoles=$idRoles;
}

public function listadoRoles(){
    $arreglo = [];
    $sql = "SELECT idRoles,roles FROM ROLES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}
}
?>