<?php

class Meses extends Controller{
    public function __construct(){
        parent ::__construct();
 }
 public function index(){

   
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->meses = $this->getModel()->listadoMeses();
     $pagina = 'meses/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }

}


}

?>