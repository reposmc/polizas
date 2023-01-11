<?php 
class Bancos extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
       
        if($_SESSION['idRoles']==2){
            $this->getView()->datos = $this->getModel()->listadoBanco($_SESSION['idDependencia']);
        $this->getView()->dependencia  = $this->getModel()->listadoDependencia($_SESSION['idDependencia']);
        }else{
            $this->getView()->datos = $this->getModel()->listadoBancos();
            $this->getView()->dependencia  = $this->getModel()->listadoDependencias();
        }
     $pagina = 'bancos/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
 }





public function agregar(){
    if(!empty($_POST)){
        if (intval( $_POST['hId'])==0){
        $this->getModel()->setNomb_bancos($_POST['txtNombre']);
        $this->getModel()->setNum_cuenta($_POST['txtNumero']);
        $this->getModel()->setIdUnoperativa($_POST['sDependencia']);
        $respuesta = $this->getModel()->insertarBanco();
        }else{
            
            $this->getModel()->setIdDepto($_POST['hId']);
            $this->getModel()->setNomb_bancos($_POST['txtNombre']);
            $this->getModel()->setNum_cuenta($_POST['txtNumero']);
            $this->getModel()->setIdUnoperativa($_POST['sDependencia']);
            $res = $this->getModel()->modificarBanco();
            echo($res).die();

        }
        echo $respuesta;
    }
    // print_r($_POST);
}


}
 ?>