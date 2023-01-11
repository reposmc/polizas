<?php

class Anio extends Controller{
    public function __construct(){
        parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->datos = $this->getModel()->listadoEjercicio();
     $pagina = 'anio/index';
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
        $this->getModel()->setAnio($_POST['txtAnio']);
        $respuesta = $this->getModel()->insertarEjercicio();
       
        }else{
            $this->getModel()->setIdEjercicio($_POST['hId']);
            $this->getModel()->setAnio($_POST['txtAnio']);
            $res = $this->getModel()->modificarEjercicio();
        echo($res).die();
        }
        echo $respuesta;
    }

    
    // print_r($_POST);
}
public function anio(){
    $anio = $_POST['anio'];
    $numero = $this->getModel()->anio($anio);
   if($numero){  

   echo "<span class='estado-no-disponible-usuario; text-danger'>Este año ya existe.</span>";
  
      
    }else {
        echo "<span class='estado-disponible-usuario; text-success'>Año Disponible.</span>";
    }


}

}

?>