<?php

class Dependencia extends Controller{
    public function __construct(){
        parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->datos = $this->getModel()->listadoDependencia();
     $pagina = 'dependencia/index';
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
        $this->getModel()->setNom_dependencia($_POST['txtDependencia']);
        $respuesta = $this->getModel()->insertarDependencia();
       
        }else{
            $this->getModel()->setIdDependencia($_POST['hId']);
            $this->getModel()->setNom_dependencia($_POST['txtDependencia']);
            $res = $this->getModel()->modificarDependencia();
        echo($res).die();
        }
        echo $respuesta;
    }

    
    // print_r($_POST);
}


}

?>