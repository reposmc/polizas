<?php

class UnidadesOperativasModelo extends Model{
    private $idUnoperativa;
    private $nom_unoperativa;
    private $idDepto;
    private $idDnac;
    private $idDependencia;

    public function __construct(){
        parent::__construct();
}
public function getIdUnoperativa(){
    return $this->idUnoperativa;
}
public function getNom_unoperativa(){
    return $this->nom_depto;
}
public function getIdDepto(){
    return $this->idDepto;
}
public function getIdDnac(){
    return $this->idDnac;
}
public function getIdDependencia(){
    return $this->idDependencia;
}

public function setIdUnoperativa($idUnoperativa){
    $this->idUnoperativa= $idUnoperativa;
}
public function setNom_unoperativa($nom_unoperativa){
    $this->nom_unoperativa= $nom_unoperativa;
}
public function setIdDepto($idDepto){
    $this->idDepto= $idDepto;
}
public function setIdDnac($idDnac){
     $this->idDnac= $idDnac;
}
public function setIdDependencia($idDependencia){
     $this->idDependencia= $idDependencia;
}



public function listadoUnidades($idDependencia){
    $arreglo = [];
    $sql = "SELECT p.idUnoperativa, p.nom_unoperativa,m.idDepto, m.nom_depto,a.idDnac,a.nom_dnac,b.idDependencia,b.nom_dependencia FROM UNIDADES_OPERATIVAS p
    INNER JOIN DEPARTAMENTOS m ON m.idDepto=p.idDepto 
    INNER JOIN DEPENDENCIAS b ON p.idDependencia=b.idDependencia
    INNER JOIN DIRECCIONES_NACIONALES a ON p.idDnac=a.idDnac  WHERE b.idDependencia=".$idDependencia." order by idUnoperativa";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function listadoUnidad(){
    $arreglo = [];
    $sql = "SELECT p.idUnoperativa, p.nom_unoperativa,m.idDepto, m.nom_depto,a.idDnac,a.nom_dnac,b.idDependencia,b.nom_dependencia FROM UNIDADES_OPERATIVAS p
    INNER JOIN DEPARTAMENTOS m ON m.idDepto=p.idDepto 
    INNER JOIN DEPENDENCIAS b ON p.idDependencia=b.idDependencia
    INNER JOIN DIRECCIONES_NACIONALES a ON p.idDnac=a.idDnac   order by idUnoperativa";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}
public function listadoDepartamento(){
    $arreglo = [];
    $sql = "SELECT * from DEPARTAMENTOS";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}
public function listadoDirecciones(){
    $arreglo = [];
    $sql = "SELECT * from DIRECCIONES_NACIONALES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function listadoDependencia(){
    $arreglo = [];
    $sql = "SELECT * from DEPENDENCIAS";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function listadoDependencias($idDependencia){
    $arreglo = [];
    $sql = "SELECT * from DEPENDENCIAS WHERE idDependencia=".$idDependencia."";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function insertarUnidades(){
    $sql = "INSERT INTO UNIDADES_OPERATIVAS(nom_unoperativa,idDepto,idDnac,idDependencia) 
    VALUES('".$this->nom_unoperativa."','".$this->idDepto."','".$this->idDnac."','".$this->idDependencia."')";
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}


public function modificarUnidades(){
    $sql = "UPDATE UNIDADES_OPERATIVAS
    SET nom_unoperativa='".$this->nom_unoperativa."', idDepto='".$this->idDepto."', idDnac='".$this->idDnac."',idDependencia='".$this->idDependencia.
    "' WHERE idUnoperativa=".$this->idUnoperativa;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
}



?>