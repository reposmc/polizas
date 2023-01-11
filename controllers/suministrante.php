<?php 
class Suministrante extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->datos = $this->getModel()->listadoSuministrante();
    $this->getView()->tipo= $this->getModel()->listadoTipo();
     $pagina = 'suministrante/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
     
 }

 




public function agregar(){
    $respuesta="";
    if(!empty($_POST)){
       
        if (intval( $_POST['hId'])==0){

        $this->getModel()->setNomb_Suminist($_POST['txtNombre']);

        $this->getModel()->setIdTipoSuministrante($_POST['sTipos']);
       
        $respuesta = $this->getModel()->insertarSuministrante();
    }else{
        $this->getModel()->setIdSuminis_SB($_POST['hId']);
        $this->getModel()->setNomb_suminist($_POST['txtNombre']);
        $this->getModel()->setIdTipoSuministrante($_POST['sTipos']);
       
        
            $res = $this->getModel()->modificarSuministrante();
            echo($res).die();

    }
        echo $respuesta;
    }
    // print_r($_POST);
}





}
?>