<?php 
class TipoTransaccion extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function index(){
   
    if(isset($_SESSION['idDependencia'])){
    $this->getView()->datos = $this->getModel()->listadoTipo();
     $pagina = 'tipoTransaccion/index';
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

        $this->getModel()->setTipoTransacciones($_POST['txtTipo']);
        $respuesta = $this->getModel()->insertarTipo();
        echo $respuesta;
    }else{
        $this->getModel()->setIdTip_Transaccion($_POST['hId']);
        $this->getModel()->setTipoTransacciones($_POST['txtTipo']);
        $res = $this->getModel()->modificarTipo();
        echo($res).die();
    }
    // print_r($_POST);
    echo $respuesta;
}


}

}
 ?>