<?php 
class DireccionNacional extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function Index(){
    
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->datos = $this->getModel()->listadoDirecciones();
     $pagina = 'direccionNacional/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
 }
 
    
    
    public function agregar(){
        if(!empty($_POST)){
            $respuesta="";
            if (intval( $_POST['hId'])==0){
            $this->getModel()->setNom_dnac($_POST['txtNombre']);
            $respuesta = $this->getModel()->insertarDirecciones();
           
            }else{
                $this->getModel()->setIdDnac($_POST['hId']);
                $this->getModel()->setNom_dnac($_POST['txtNombre']);
                $res = $this->getModel()->modificarDirecciones();
            echo($res).die();
            }
            echo $respuesta;
        }

        
        // print_r($_POST);
    }
    
    
    }

?>