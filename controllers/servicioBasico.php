<?php 
class ServicioBasico extends Controller{
 public function __construct(){
     parent ::__construct();
 }
 public function Index(){

    

    if(isset($_SESSION['idDependencia'])){

        if($_SESSION['idRoles']==2){
            $this->getView()->datos = $this->getModel()->mostrarListado($_SESSION['idDependencia']);
            }else{
            $this->getView()->datos = $this->getModel()-> mostrarListadoPoliza();
            } 

            
     $pagina = 'servicioBasico/index';

     $this->getView()->loadView($pagina);
    
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }
        

 }
 public function nuevo(){
     if($_SESSION['idRoles']==2){
        $this->getView()->anio = $this->getModel()-> anios();
    $ayo= $this->getView()->anio[0]["ano"];
    $this->getView()->unidad= $this->getModel()->listadoUnidades($_SESSION['idDependencia']);
    $this->getView()->Suministrantes= $this->getModel()->listadoSuministrantes();
    $this->getView()->num_poliza = $this->getModel()->NumPolizaSelect( $ayo,$_SESSION['idDependencia']);
    $this->getView()->mes= $this->getModel()->listadoMeses();

    
    // }
    $pagina = 'servicioBasico/nuevo';
    $this->getView()->loadView($pagina);
}else {
    $pagina = 'inicio/login';
    $this->getView()->loadView($pagina);
}
    
  
}






public function AgregarPoliza(){
    
    $respuesta="";
    if(!empty($_POST)){
    //   if(intval(( $_POST['idPoliza'])==0)){
            $this->getModel()->setNum_poliza($_POST['txtNumero']);
            $this->getModel()->setEjercicio($_POST['hanio']);
            $this->getModel()->setFec_crear($_POST['dtFecha']);       
            $this->getModel()->setIdSuminis_SB($_POST['sSuministrante']);
            $this->getModel()->setIdEstado($_POST['txtEstado']); 
            $this->getModel()->setIdUsuarios($_SESSION['idUsuarios']); 
            $this->getModel()->setIdTip_Poliza($_POST['txtTipoP']); 
            $this->getModel()->setMontoTotal($_POST['txt_total']);
    
            
             $respuesta = $this->getModel()->insertarEncabezado();
             echo $respuesta;
            for($i=0; $i<count($_POST['medidor']); $i++){
                $this->getModel()->setIdPoliza($respuesta);
                $this->getModel()->setIdMedidor($_POST['medidor'][$i]);
                $this->getModel()->setNum_doc_resp($_POST['documento'][$i]);
                $this->getModel()->setIdMes($_POST['mes'][$i]);       
                $this->getModel()->setFecha($_POST['fecha'][$i]);
                $this->getModel()->setValor($_POST['valor'][$i]); 
           
               $respuest = $this->getModel()->insertarDetalle();
               echo $respuest;
       
           }
        

    }
  

 }

public function detalle(){

    if(!empty($_POST)){
    $this->getModel()->setIdPoliza($_POST['txtidPoliza']);
    $this->getModel()->setIdMedidor($_POST['sMedidores']);
    $this->getModel()->setNum_doc_resp($_POST['txtDocument']);
    $this->getModel()->setIdMes($_POST['sMeses']);       
    $this->getModel()->setFecha($_POST['dFechas']);
    $this->getModel()->setValor($_POST['txtValors']); 
    
    $respues = $this->getModel()->insertarDetalle();
    }
}

 public function agregar(){
    if(isset($_GET['idPoliza'])){
        $id = $_GET['idPoliza'];
        $this->getModel()->setIdPoliza($id);
        $this->getView()->detalle = $this->getModel()->listadoDetalle();
        $this->getView()->encabezado = $this->getModel()->encabezado();
        $this->getView()->Suministrantes= $this->getModel()->listadoSuministrantes();
        $this->getView()->mes= $this->getModel()->listadoMeses();
        $this->getView()->dependencia= $this->getModel()->listadoDependencia();

        if($_SESSION['idRoles']==2){
        
        $this->getView()->UnidadOP = $this->getModel()->listadoUnidades($_SESSION['idDependencia']);
        }else{
        $depen =$this->getView()->encabezado[0]["idDependencia"];
        $this->getView()->UnidadOP = $this->getModel()->listadoUnidades( $depen);
       
        }
    if(isset($_SESSION['idDependencia'])){
        
            $pagina = 'servicioBasico/agregar';
            $this->getView()->loadView($pagina);
            
          
           
           }else {
               $pagina = 'inicio/login';
               $this->getView()->loadView($pagina);
           }
                          
       }  else {
           


        $this->getModel()->setIdPoliza($_POST['txtId']);
        $this->getModel()->setFec_crear($_POST['dtFecha']);
        $this->getModel()->setMontoTotal($_POST['txttotal']); 
       
        $res = $this->getModel()->modificarEncabezado();
        //echo $res;

       }
    }

    // public function unidad(){
    //     if(!empty($_POST)){
    //     $unidad= $_POST['idDependencia'];
    //     $this->getView()->UnidadOP = $this->getModel()->listadoUnidades( $unidad);
    //     echo'<option value=""></option>';
    //     foreach ( $this->getView()->UnidadOP as $value) {
    //     echo '<option value="'.$value["idUnoperativa"].'" >'.$value["nom_unoperativa"].'</option>';
    //     // var_dump($this->getView()->medidores);
    // }
    //     }
     
    //     }


public function medidor(){
    if(!empty($_POST)){
    $idUnoperativa = $_POST["Unoperativa"];
    $idSuminis_SB = $_POST["idSuminis_SB"];
    $this->getView()->medidores = $this->getModel()->listadoMedidores($idUnoperativa,$idSuminis_SB);
    echo'<option value=""></option>';
    foreach ( $this->getView()->medidores as $value) {
        echo '<option value="'.$value["idMedidor"].'" >'.$value["num_Medidor"].'</option>';
        // var_dump($this->getView()->medidores);
    }
}
}

public function cambio(){
    // if(!empty($_POST)){
            $this->getModel()->setIdPoliza($_POST['txtId']);
            $this->getModel()->setIdEstado($_POST['txtCambio']);
            $res = $this->getModel()->modificarEstado();
            echo($res).die();
        // }
        
}


//año
public function NumPoliza(){
   
    if(!empty($_POST)){
        $year = $_POST["year"];
        $num_poliza = $this->getModel()->NumPolizaSelect($year,$_SESSION['idDependencia']);
        echo $num_poliza[0]["Contador"] ++;

     }
    }

     


    
     public function eliminar(){
        if(isset($_GET['idPoliza_SB'])){
            $this->getModel()->setIdPoliza_SB($_GET['idPoliza_SB']);
            $res = $this->getModel()->eliminarDetalle();
            echo $res;
        }
    }

 }



?>