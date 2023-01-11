<?php

class UsuariosModelo extends Model{

   private $idUsuarios;
    private $idRoles;
    private $nombre;
    private $username;
    private $contrasena;
    private $correo;
    private $idUnoperativa;

    public function __construct(){
        parent::__construct();
}


public function getIdUsuarios(){
  return $this->idUsuarios;
}

public function getIdRoles(){
    return $this->idRoles;
  }
 
public function getNombre(){
    return $this->nombre;
}
public function getUsername(){
    return $this->username;
}
public function getContrasena(){
    return $this->contrasena;
}
public function getCorreo(){
    return $this->correo;

   
}
public function getIdDependencia(){
    return $this->idDependencia;
}
//set
public function setIdUsuarios($idUsuarios){
    $this->idUsuarios= $idUsuarios;
}
public function setIdRoles($idRoles){
    $this->idRoles= $idRoles;
}
public function setNombre($nombre){
    $this->nombre=$nombre;

}
public function setUsername($username){
    $this->username= $username;

}
public function setContrasena($contrasena){
    $this->contrasena= $contrasena;

}
public function setCorreo($correo){
    $this->correo=$correo;
}
public function setIdDependencia($idDependencia){
    $this->idDependencia=$idDependencia;
}

public function listadoUsuarios(){
    $arreglo = [];
    $sql = "SELECT p.idUsuarios, p.nombre, p.username,p.contrasena,p.correo, m.idRoles, m.roles,f.idDependencia,f.nom_dependencia FROM USUARIOS p
    INNER JOIN ROLES m ON m.idRoles=p.idRoles INNER JOIN DEPENDENCIAS f ON f.idDependencia=p.idDependencia";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function listadoUnidades(){
    $arreglo = [];
    $sql = "SELECT *FROM DEPENDENCIAS";
  
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}
public function listadoRoles(){
    $arreglo = [];
    $sql = "SELECT * from ROLES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

public function username($username){
    $arreglo = "";
    $sql = "SELECT idUsuarios,username FROM USUARIOS
    WHERE username='".$username."' ";
    $datos = $this->getDb()->conectar()->query($sql);
   
        while($fila = $datos->fetch_assoc()){

            $arreglo = $fila['idUsuarios'];
        }
    return $arreglo;
           
      
    
}
// public function user($username){
        
//     $arreglo = [];
//     $sql = "SELECT idUsuarios from USUARIOS where =".$username.""; 
//     var_dump($sql);
//     $datos = $this->getDb()->conectar()->query($sql);
//     while($fila = $datos->getAttribute(PDO::ATTR_DRIVER_NAME) ){
//         $arreglo[] = $fila;
//     }
//     return $arreglo;
// }

public function insertarUsuarios(){

     //   var_dump(2);
        $sql = "INSERT INTO USUARIOS(idRoles,nombre,username,contrasena,correo,idDependencia) 
        VALUES('".$this->idRoles."','".$this->nombre."','".$this->username."','".$this->contrasena."','".$this->correo."','".$this->idDependencia."')";
        $res = $this->getDb()->conectar()->query($sql);
      //  $num = $res->num_rows;
    
    return ($res===TRUE)?true:false;
    
}

public function modificarUsuarios(){
    $sql = "UPDATE USUARIOS
    SET idRoles='".$this->idRoles."', nombre='".$this->nombre."', username='".$this->username."', 
    contrasena='".$this->contrasena."', correo='".$this->correo."', idDependencia='".$this->idDependencia.
    "' WHERE idUsuarios=".$this->idUsuarios;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;

}
public function roles(){
    $arreglo = [];
    $sql = "SELECT * from ROLES";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


}


?>