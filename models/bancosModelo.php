<?php

class   BancosModelo extends Model{

   private $idBancos;
    private $nomb_bancos;
    private $num_cuenta;
  
    private $idUnoperativa;

    public function __construct(){
        parent::__construct();
}


public function getIdBancos(){
  return $this->idBancos;
}

public function getNomb_bancos(){
    return $this->nomb_bancos;
  }
  public function getNum_cuenta(){
    return $this->num_cuenta;
  }

public function getIdUnoperativa(){
    return $this->idUnoperativa;
}
//set
public function setIdBancos($idBancos){
    $this->idBancos= $idBancos;
}
public function setNomb_bancos($nomb_bancos){
    $this->nomb_bancos= $nomb_bancos;
}
public function setNum_cuenta($num_cuenta){
    $this->num_cuenta= $num_cuenta;
}

public function setIdUnoperativa($idUnoperativa){
    $this->idUnoperativa=$idUnoperativa;
}

public function listadoBanco($idDependencia){
    $arreglo = [];
    $sql = "SELECT a.idBancos,a.nomb_bancos,a.num_cuenta,b.idDependencia,b.nom_dependencia FROM BANCOS a
    INNER JOIN  DEPENDENCIAS b ON b.idDependencia=a.idDependencia WHERE b.idDependencia=".$idDependencia."";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}
public function listadoBancos(){
    $arreglo = [];
    $sql = "SELECT a.idBancos,a.nomb_bancos,a.num_cuenta,b.idDependencia,b.nom_dependencia FROM BANCOS a
    INNER JOIN  DEPENDENCIAS b ON b.idDependencia=a.idDependencia";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function listadoDependencia($idDependencia){
    $arreglo = [];
    $sql = "SELECT *FROM DEPENDENCIAS WHERE idDependencia=".$idDependencia."";
  
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function listadoDependencias(){
    $arreglo = [];

    $sql = "SELECT *FROM DEPENDENCIAS";
  
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function insertarBanco(){

     //   var_dump(2);
        $sql = "INSERT INTO BANCOS(nomb_bancos,num_cuenta,idDependencia) 
        VALUES('".$this->nomb_bancos."','".$this->num_cuenta."','".$this->idUnoperativa."')";
        $res = $this->getDb()->conectar()->query($sql);
      //  $num = $res->num_rows;
    
    return ($res===TRUE)?true:false;
    
}

public function modificarBanco(){
    $sql = "UPDATE BANCOS
    SET nomb_bancos='".$this->nomb_bancos."', num_cuenta='".$this->num_cuenta."' ,idDependencia='".$this->idUnoperativa.
    "' WHERE idBancos=".$this->idBancos;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}



}


?>