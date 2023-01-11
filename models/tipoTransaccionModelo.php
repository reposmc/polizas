<?php
class TipoTransaccionModelo extends model{
    private $idTip_Transaccion;
    private $tipoTransacciones;

  public function __construct(){
    parent::__construct();
   

}

public function getIdTip_Transaccion(){
    return $this->idTip_Transaccion;
}
public function getTipoTransacciones(){
    return $this->tipoTransacciones;
}

public function setIdTip_Transaccion($idTip_Transaccion){
  $this->idTip_Transaccion=$idTip_Transaccion;
}
public function setTipoTransacciones($tipoTransacciones){
   $this->tipoTransacciones=$tipoTransacciones;
}

public function listadoTipo(){
    $arreglo = [];
    $sql = "SELECT * FROM TIPOS_DE_TRANSACCIONES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function insertarTipo(){
    $sql = "INSERT INTO TIPOS_DE_TRANSACCIONES(tipoTransacciones) 
    VALUES('".$this->tipoTransacciones."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}


public function modificarTipo(){
    $sql = "UPDATE TIPOS_DE_TRANSACCIONES
    SET tipoTransacciones='".$this->tipoTransacciones.
    "' WHERE idTip_Transaccion=".$this->idTip_Transaccion;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}
?>