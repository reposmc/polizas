<?php 
class Inicio extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function index(){
     if(!empty($_POST)){
        $this->getModel()->setUsername($_POST['txtUsername']);
        $this->getModel()->setContrasena($_POST['txtContrasena']);
         
         $rol =$this->getModel()->validarUsuario();
          $roli =$this->getModel()->validarRol();
          $usuario=$this->getModel()->usuario();
        //  echo $rol;
      
       
        if(!empty($rol)){
           
            $_SESSION['username'] = $_POST['txtUsername'];
            $_SESSION['idDependencia'] = $rol;
        
            $_SESSION['idRoles'] = $roli;
            $_SESSION['idUsuarios'] = $usuario;
          
           
            $pagina = 'inicio/index';
             $this->getView()->loadView($pagina);
        }
        else{
            echo "<div class='alert alert-danger alert-dismissable' style='float:right; margin-right:10px; 
            top: 70px;' >
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
            ¡Usuario o Contraseña incorrecta.!
          </div>";
            //echo "<script type='text/javascript'>alert('Contraseña o usuario incorrecto');</script>";
            $pagina = 'inicio/login';

            $this->getView()->loadView($pagina);
         
        }
    }else{
       
        if(isset($_SESSION['idDependencia'])){
            $pagina = 'inicio/index';
            $this->getView()->loadView($pagina);
          ///  session_destroy();
        }else{
            
            $pagina = 'inicio/login';

            $this->getView()->loadView($pagina);

        }
       
    }
}
    

  
           
    
    public function login(){
     $pagina = 'inicio/login';
     $this->getView()->loadView($pagina);
    }
   
    public function salir(){
        session_destroy();
        $pagina = "inicio/login";
        $this->getView()->loadView($pagina);
    }

    public function manual(){
        $tam = filesize("./public/manual.pdf");
        header("Content-type: application/pdf");
        header("Content-Length: $tam");
        header("Content-Disposition: inline; filename=manual.pdf");
        $file='./public/manual.pdf';
        readfile($file);
    }


}
?>