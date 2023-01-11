<?php 

class InicioModelo extends Model{
private $idUsuarios;
private $idRoles;
private $username;
private $contrasena;


public function __construct(){
    parent::__construct();
}
public function getIdUsuarios(){
    return $this->idUsuarios;
}
public function getIdRoles(){
    return $this->idRoles;
}
public function getUsername(){
    return $this->username;
}
public function getContrasena(){
    return $this->contrasena; 

}
//LOS SET
public function setIdUsuarios($idUsuarios){
    $this->idUsuarios= $idUsuarios;
}
public function setIdRoles($idRoles){
    $this->idRoles = $idRoles;
}
public function setUsername($username){
    $this->username = $username;
}

public function setContrasena($contrasena){
   $this->contrasena = $contrasena;
}
 
public function validarUsuario(){
    $rol = "";
    
    $sql = "SELECT idUsuarios,idRoles, nombre,idDependencia FROM USUARIOS
    WHERE username='".$this->username."' AND contrasena='".$this->contrasena."'";
    $datos = $this->getDb()->conectar()->query($sql);
   
        while($fila = $datos->fetch_assoc()){

            $rol = $fila['idDependencia'];
          //  $rol = $fila['idRoles'];
        }
        return $rol;
    
   
   
}

public function validarRol(){
    $roli = "";
    $sql = "SELECT idUsuarios,idRoles, nombre FROM USUARIOS
    WHERE username='".$this->username."' AND contrasena='".$this->contrasena."'";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_assoc()){
        $roli = $fila['idRoles'];
    }
    return $roli;
}

public function usuario(){
    $roli = "";
    $sql = "SELECT idUsuarios,idRoles, nombre FROM USUARIOS
    WHERE username='".$this->username."' AND contrasena='".$this->contrasena."'";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_assoc()){
        $roli = $fila['idUsuarios'];
    }
    return $roli;
}
}

?>