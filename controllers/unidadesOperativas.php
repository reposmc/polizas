<?php 
class UnidadesOperativas extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
        if($_SESSION['idRoles']==2){
            $this->getView()->dependencia = $this->getModel()->listadoDependencias($_SESSION['idDependencia']);
            $this->getView()->datos = $this->getModel()->listadoUnidades($_SESSION['idDependencia']);
     }else{
    $this->getView()->dependencia = $this->getModel()->listadoDependencia();
    $this->getView()->datos = $this->getModel()->listadoUnidad();
    }
    // print_r($datos);
   
   $this->getView()->departamento = $this->getModel()->listadoDepartamento();
   $this->getView()->direcciones = $this->getModel()->listadoDirecciones();
     $pagina = 'unidadesOperativas/index';
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
        $this->getModel()->setNom_unoperativa($_POST['txtNombre']);
        $this->getModel()->setIdDepto($_POST['sDepartamento']);
        $this->getModel()->setIdDnac($_POST['sDnac']);
        $this->getModel()->setIdDependencia($_POST['sDependencia']);
        $respuesta = $this->getModel()->insertarUnidades();
        }else{
            $this->getModel()->setidUnoperativa($_POST['hId']);
        $this->getModel()->setNom_unoperativa($_POST['txtNombre']);
        $this->getModel()->setIdDepto($_POST['sDepartamento']);
        $this->getModel()->setIdDnac($_POST['sDnac']);
        $this->getModel()->setIdDependencia($_POST['sDependencia']);
        $res = $this->getModel()->modificarUnidades();
         echo($res).die();

        }
        echo $respuesta;
    }
    // print_r($_POST);
}

}
 ?>