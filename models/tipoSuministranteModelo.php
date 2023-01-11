<?php

class TipoSuministranteModelo extends Model{
    private $idTipoSuministrante;
    private $tipo_suminist;

    public function __construct(){
        parent::__construct();
}

public function getIdTipoSuministrante(){
    return $this->idTipoSuministrante;
}
 
public function getTipo_suminist(){
    return $this->tipo_suminist;
}
public function setIdTipoSuministrante($idTipoSuministrante){
   $this->idTipoSuministrante=$idTipoSuministrante;
}
public function setTipo_suminist($tipo_suminist){
    $this->tipo_suminist= $tipo_suminist;
}

public function listadoTipo(){
    $arreglo = [];
    $sql = "SELECT * from TIPOS_DE_SUMINISTRANTE";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function insertarTipo(){
    $sql = "INSERT INTO TIPOS_DE_SUMINISTRANTE(tipo_suminist) 
    VALUES('".$this->tipo_suminist."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}

public function modificarTipo(){
    $sql = "UPDATE TIPOS_DE_SUMINISTRANTE
    SET tipo_suminist='".$this->tipo_suminist."' WHERE idTipoSuministrante=".$this->idTipoSuministrante;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}



?>