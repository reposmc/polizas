<?php

class PagoReintegro extends Controller{
    public function __construct(){
        parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
       
        if($_SESSION['idRoles']==2){
            $this->getView()->banco= $this->getModel()->listadoBancos($_SESSION["idDependencia"]);
            $this->getView()->datos = $this->getModel()->listadoPago($_SESSION["idDependencia"]);
        }else{
            $this->getView()->dependencia= $this->getModel()->listadoDependencia();
            $this->getView()->banco= $this->getModel()->listadoBanco();
            $this->getView()->datos = $this->getModel()->listadoRegistroPago();

           
        }
        $this->getView()->anios = $this->getModel()->anios();
            $ayo= $this->getView()->anios[0]["idEjercicio"];  
        // var_dump($ayo);
        $this->getView()->poliza= $this->getModel()->listadoPoliza($_SESSION['idDependencia'],$ayo);
        
        //  $this->getView()->poliza= $this->getModel()->listadoPoliza($_SESSION["idDependencia"]);
    $this->getView()->TipoTransaccion= $this->getModel()->listadoTipoTransaccion();
    

    
    
     $pagina = 'pagoReintegro/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
   
}

public function poliza(){ 
   

    
    $dependencias = $_POST["idDependencia"];
    $this->getView()->anios = $this->getModel()->anios();
        $ayo= $this->getView()->anios[0]["idEjercicio"];
    echo'<option value=""></option>';
    $this->getView()->poliza= $this->getModel()->listadoPoliza($dependencias,$ayo);
  
     foreach ( $this->getView()->poliza as $value) {
       
         echo '<option value="'.$value["idPoliza"].'" data-id="'.$value["montoTotal"].'">'.$value["num_Poliza"].'</option>';
        //  var_dump($this->getView()->medidores);
     }

    
    
}
    
    
    
public function banco(){ 
   

    
    $dependencias = $_POST["idDependencia"];
   
     echo'<option value=""></option>';
     $this->getView()->banco= $this->getModel()->listadoBancos($dependencias);
   
      foreach ( $this->getView()->banco as $value) {
        
          echo '<option value="'.$value["idBancos"].'" data-id="'.$value["num_cuenta"].'">'.$value["nomb_Bancos"].'</option>';
         //  var_dump($this->getView()->medidores);
      }
    
}


  

    public function agregar(){
        $respuesta="";
        if(!empty($_POST)){
           
            if (intval($_POST['hId'])==0){
    
            $this->getModel()->setIdPoliza($_POST['sPoliza']);
            $this->getModel()->setFechaPago($_POST['dFechaPago']);
            $this->getModel()->setFechaActual($_POST['dFechaActual']);
            $this->getModel()->setTotal($_POST['txtTotal']);
            $this->getModel()->setNum_Documento($_POST['txtNumeroDocumento']);
            $this->getModel()->setIdTipoTransaccion($_POST['sTipo']);
            $this->getModel()->setIdBanco($_POST['sBanco']);
            $respuesta = $this->getModel()->insertarPago();
            echo $respuesta;
        }
        else{
            $this->getModel()->setIdPago($_POST['hId']);
            $this->getModel()->setIdPoliza($_POST['sPoliza']);
            $this->getModel()->setFechaPago($_POST['dFechaPago']);
            $this->getModel()->setFechaActual($_POST['dFechaActual']);
            $this->getModel()->setTotal($_POST['txtTotal']);
            $this->getModel()->setNum_Documento($_POST['txtNumeroDocumento']);
            $this->getModel()->setIdTipoTransaccion($_POST['sTipo']);
            $this->getModel()->setIdBanco($_POST['sBanco']);
                $res = $this->getModel()->modificarPago();
                echo($res).die();
    
        // }
            
        }
        echo $respuesta;
        // print_r($_POST);
    }
    
    

}
}
?>