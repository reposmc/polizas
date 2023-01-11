<?php 
class Usuarios extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function Index(){
    
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->datos = $this->getModel()->listadoUsuarios();
    $this->getView()->roles= $this->getModel()->listadoRoles();
    
  $this->getView()->dependencia= $this->getModel()->listadoUnidades();
     $pagina = 'usuarios/index';
     $this->getView()->loadView($pagina);

    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
 }

    
    public function Username(){
        $username = $_POST['username'];
        $usernames = $this->getModel()->username($username);
       if($usernames){  

       echo "<span class='estado-no-disponible-usuario; text-danger'> Usuario no Disponible.</span>";
      
          
        }else {
            echo "<span class='estado-disponible-usuario; text-success'> Usuario Disponible.</span>";
        }
    
    
    }


    public function agregar(){
        if(!empty($_POST)){
            $respuesta="";
            if (intval( $_POST['hId'])==0){
            $this->getModel()->setIdRoles($_POST['sRoles']);
            $this->getModel()->setNombre($_POST['txtNombre']);
            $this->getModel()->setUsername($_POST['txtUsername']);
            $this->getModel()->setContrasena($_POST['txtContrasena']);
            $this->getModel()->setCorreo($_POST['txtCorreo']);
            $this->getModel()->setIdDependencia($_POST['sDependencia']);
            $respuesta = $this->getModel()->insertarUsuarios($_POST['txtUsername']);
            
           //var_dump($respuesta);
        }else{

            
            $this->getModel()->setIdUsuarios($_POST['hId']);
            $this->getModel()->setIdRoles($_POST['sRoles']);
            $this->getModel()->setNombre($_POST['txtNombre']);
            $this->getModel()->setUsername($_POST['txtUsername']);
            $this->getModel()->setContrasena($_POST['txtContrasena']);
            $this->getModel()->setCorreo($_POST['txtCorreo']);
            $this->getModel()->setIdDependencia($_POST['sDependencia']);
            $res = $this->getModel()->modificarUsuarios();
            echo($res).die();

        }
        // print_r($_POST);
        echo $respuesta;
    }
    
    
    }


}
?>