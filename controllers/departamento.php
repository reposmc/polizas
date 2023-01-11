<?php 
class Departamento extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function index(){
    $this->getView()->datos = $this->getModel()->listadoDepartamento();
    if(isset($_SESSION['idDependencia'])){
     $pagina = 'departamento/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
 }





public function agregar(){
    if(!empty($_POST)){
        if (intval( $_POST['hId'])==0){
        $this->getModel()->setNom_depto($_POST['txtNombre']);
        $respuesta = $this->getModel()->insertarDepartamento();
        }else{
            
            $this->getModel()->setIdDepto($_POST['hId']);
            $this->getModel()->setNom_depto($_POST['txtNombre']);
            $res = $this->getModel()->modificarDepartamento();
            echo($res).die();

        }
        echo $respuesta;
    }
    // print_r($_POST);
}


}
 ?>