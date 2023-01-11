<?php 
class Medidores extends Controller{
    public function __construct(){
        parent ::__construct();
 }
 public function index(){
    
    
    if(isset($_SESSION['idDependencia'])){

        if($_SESSION['idRoles']==2){
            $this->getView()->unidades = $this->getModel()->listadoUnidades($_SESSION['idDependencia']);
            $this->getView()->datos = $this->getModel()->listadoMedidores($_SESSION['idDependencia']);
            }else{
            $this->getView()->unidades = $this->getModel()->listadoUnidad();
            $this->getView()->datos = $this->getModel()->listadoMedidor();
            }
    $this->getView()->Suministrantes= $this->getModel()->listadoSuministrantes();
   
    
     $pagina = 'medidores/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
    
    
     
 }

 

public function agregar(){
    
    if(!empty($_POST)){
        $respuesta="";
        if (intval($_POST['hId'])==0){
        $this->getModel()->setNum_Medidor($_POST['txtNumeroMedidor']);
        $this->getModel()->setIdUnoperativa($_POST['sUnidades']);
        $this->getModel()->setIdSuminis_SB($_POST['sSuministrantes']);
        $respuesta = $this->getModel()->insertarMedidores();
    
        }else{

            $this->getModel()->setIdMedidor($_POST['hId']);
            $this->getModel()->setNum_Medidor($_POST['txtNumeroMedidor']);
            $this->getModel()->setIdUnoperativa($_POST['sUnidades']);
            $this->getModel()->setIdSuminis_SB($_POST['sSuministrantes']);
            $res = $this->getModel()->modificarMedidores();
            echo($res).die();

    }
        echo $respuesta;
    }
}


public function medidor(){
    $medidor = $_POST['txtNumeroMedidor'];
    $numero = $this->getModel()->medidor($medidor);
   if($numero){  

   echo "<span class='estado-no-disponible-usuario; text-danger'> Numero Medidor no Disponible.</span>";
  
      
    }else {
        echo "<span class='estado-disponible-usuario; text-success'> Numero Medidor Disponible.</span>";
    }


}
 
}
 ?>