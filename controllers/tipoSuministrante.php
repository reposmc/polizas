<?php 
class TipoSuministrante extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function Index(){
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->datos = $this->getModel()->listadoTipo();
     $pagina = 'tipoSuministrante/index';
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

            $this->getModel()->setTipo_suminist($_POST['txtTipo']);
            $respuesta = $this->getModel()->insertarTipo();
            echo $respuesta;
        }else{
            $this->getModel()->setIdTipoSuministrante($_POST['hId']);
            $this->getModel()->setTipo_suminist($_POST['txtTipo']);
            $res = $this->getModel()->modificarTipo();
            echo($res).die();
        }
        // print_r($_POST);
        echo $respuesta;
    }
    
    
    }
}

?>