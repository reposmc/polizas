<?php
class SuministranteModelo extends Model{
private $idSuminis_SB;
private $nomb_suminist;
private $idTipoSuministrante;
private $suministro;

public function __construct(){
    parent::__construct();

}
public function getIdSuminis_SB(){
    return $this->idSuminis_SB;
}
public function getNomb_suminist(){
    return $this->nomb_suminist;
}
public function getIdTipoSuministrante(){
    return $this->idTipoSuministrante;
}
public function getSuministro(){
    return $this->suministro;
}

public function setIdSuminis_SB($idSuminis_SB){
    $this->idSuminis_SB= $idSuminis_SB;
}
public function setNomb_suminist($nomb_suminist){
    $this->nomb_suminist = $nomb_suminist;
}
public function setIdTipoSuministrante($idTipoSuministrante){
 $this->idTipoSuministrante= $idTipoSuministrante;
}
public function setSuministro($suministro){
 $this->suministro= $suministro;
}

public function listadoSuministrante(){
    $arreglo = [];
    $sql = "SELECT p.idSuminis_SB, p.nom_suminist,m.idTipoSuministrante, m.tipo_suminist as TIPOS_DE_SUMINISTRANTE FROM SUMINISTRANTES_SB p
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=p.idTipoSuministrante order by  p.idSuminis_SB  ";
    $datos = $this->getDb()->conectar()->query($sql);
    
    
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    
    }
    return $arreglo;
}
public function listadoTipo(){
    $arreglo = [];
    $sql = "SELECT * FROM TIPOS_DE_SUMINISTRANTE";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}



public function insertarSuministrante(){
    $sql = "INSERT INTO SUMINISTRANTES_SB(nom_suminist,idTipoSuministrante) 
    VALUES('".$this->nomb_suminist."','".$this->idTipoSuministrante."')";
    $res = $this->getDb()->conectar()->query($sql);
    $lastid = insert_id($res);
  echo $lastid;
    return ($res===TRUE)?true:false;
}

public function modificarSuministrante(){
    $sql = "UPDATE SUMINISTRANTES_SB
    SET nom_suminist='".$this->nomb_suminist."', idTipoSuministrante='".$this->idTipoSuministrante.
    "' WHERE idSuminis_SB=".$this->idSuminis_SB;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}


?>