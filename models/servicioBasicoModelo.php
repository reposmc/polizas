<?php 
 class ServicioBasicoModelo extends Model{
     //ENCABEZADO
     private $idPoliza;
     private $idUsuarios;
     private $idSuminis_SB;
     private $idEstado;
     private $num_poliza;
     private $ejercicio;
     private $fec_crear;
     private $idTip_Poliza;
     private $montoTotal;
     private $tipo_Estado;
     //DETALLE
    private $idPoliza_SB;
    private $idMedidor;
    private $num_doc_resp;
    private $idMes;
    private $fecha;
    private $valor;
    private $year;

    
    public function __construct(){
        parent::__construct();
    
    }
//ENCABEZADO
    public function getIdUsuarios(){
        return $this->idUsuarios;
    }
    public function getIdPoliza(){
        return $this->idPoliza;
    }
    
    public function getIdSuminis_SB(){
        return $this->idSuminis_SB;
    }
    
    public function getYear(){
        return $this->year;
    }

    public function getIdEstado(){
        return $this->idEstado;
    }
    public function getNum_poliza(){
        return $this->num_poliza;
    }
    public function getEjercicio(){
        return $this->ejercicio;
    }
    public function getFec_crear(){
        return $this->fec_crear;
    }
    public function getIdTip_Poliza(){
        return $this->idTip_Poliza;
    }
    public function getMontoTotal(){
        return $this->montoTotal;
    }
    public function getTipo_Estado(){
        return $this->tipo_Estado;
    }
    
//DETALLE
    public function getIdPoliza_SB(){
        return $this->idPoliza_SB;
    }
    public function getIdMedidor(){
        return $this->idMedidor;
    }
    public function getNum_doc_resp(){
        return $this->$num_doc_resp;
    }
    
    public function getIdMes(){
        return $this->idMes;
    }
    public function getFecha(){
        return $this->fecha;
    }
    public function getValor(){
        return $this->valor;
    }
    

   

    //ENCABEZADO
    public function setIdUsuarios($idUsuarios){
      $this->idUsuarios = $idUsuarios;
    }
    public function setIdPoliza($idPoliza){
        $this->idPoliza = $idPoliza;
      }
    
    public function setIdSuminis_SB( $idSuminis_SB){
        $this->idSuminis_SB= $idSuminis_SB;
    }
    public function setTipo_Estado($tipo_Estado){
        $this->tipo_Estado=$tipo_Estado;
    }
    public function setIdEstado($idEstado){
        $this->idEstado=$idEstado;
        
    }

    public function setNum_poliza($num_poliza){
       $this->num_poliza=$num_poliza;
    }
    public function setEjercicio($ejercicio){
       $this->ejercicio=$ejercicio;
    }
    public function setFec_crear($fec_crear){
      $this->fec_crear=$fec_crear;
    }
    public function setIdTip_Poliza($idTip_Poliza){
      $this->idTip_Poliza=$idTip_Poliza;
    }
    public function setMontoTotal($montoTotal){
       $this->montoTotal=$montoTotal;
    }
    public function setYear($year){
        $this->year = $year;
    }
    //DETALLE
    public function setIdPoliza_SB($idPoliza_SB){
    $this->idPoliza_SB =$idPoliza_SB;
    }
    public function setIdMedidor($idMedidor){
        $this->idMedidor= $idMedidor;
    }

    public function setNum_doc_resp($num_doc_resp){
        $this->num_doc_resp=$num_doc_resp;
    }

    public function setIdMes($idMes){
        $this->idMes=$idMes;
    }

    public function setFecha($fecha){
        $this->fecha=$fecha;
    }

    public function setValor($valor){
        $this->valor=$valor;
    }
    

    public function listadoDependencia(){
        $arreglo = [];
        $sql = "SELECT * FROM DEPENDENCIAS";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }

    public function mostrarListado($idUnoperativa){
        $arreglo = [];
        $sql = "SELECT a.idPoliza,b.idUsuarios,b.nombre,b.idDependencia,e.idSuminis_SB,e.nom_suminist,a.num_Poliza,f.idEjercicio,f.anio
        ,a.fec_crear,c.idEstado,c.tipo_Estado,d.idTip_Poliza,d.tipo_poliza,a.montoTotal FROM ENCABEZADO a
        inner join USUARIOS b ON a.idUsuarios=b.idUsuarios
        inner join SUMINISTRANTES_SB e ON a.idSuminis_SB=e.idSuminis_SB
        inner join ESTADOS c ON a.idEstado=c.idEstado
         inner join EJERCICIOS_FISCALES f ON a.idEjercicio=f.idEjercicio
        inner join TIPOS_DE_POLIZAS d ON a.idTip_Poliza=d.idTip_Poliza where b.idDependencia = ".$idUnoperativa." AND d.idTip_Poliza=1 ";
    //    var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function mostrarListadoPoliza(){
        $arreglo = [];
        $sql = "SELECT a.idPoliza,b.idUsuarios,b.nombre,b.idDependencia,e.idSuminis_SB,e.nom_suminist,a.num_Poliza,f.idEjercicio,f.anio
        ,a.fec_crear,c.idEstado,c.tipo_Estado,d.idTip_Poliza,d.tipo_poliza,a.montoTotal FROM ENCABEZADO a
        inner join USUARIOS b ON a.idUsuarios=b.idUsuarios
        inner join SUMINISTRANTES_SB e ON a.idSuminis_SB=e.idSuminis_SB
        inner join ESTADOS c ON a.idEstado=c.idEstado
         inner join EJERCICIOS_FISCALES f ON a.idEjercicio=f.idEjercicio
        inner join TIPOS_DE_POLIZAS d ON a.idTip_Poliza=d.idTip_Poliza WHERE d.idTip_Poliza=1  ";
       // var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function encabezado(){
        $arreglo = [];
        $sql = "SELECT a.idPoliza,b.idUsuarios,b.nombre,b.idDependencia,k.idPoliza_SB,u.idMedidor,p.idUnoperativa,p.nom_unoperativa,e.idSuminis_SB,e.nom_suminist,a.num_Poliza,f.idEjercicio,f.anio
        ,a.fec_crear,c.idEstado,c.tipo_Estado,d.idTip_Poliza,d.tipo_poliza,a.montoTotal FROM POLIZA_SB K
        inner join ENCABEZADO a on k.idPoliza=a.idPoliza
        inner join MEDIDORES u ON  k.idMedidor= u.idMedidor
        inner join USUARIOS b ON a.idUsuarios=b.idUsuarios
        inner join UNIDADES_OPERATIVAS p ON p.idUnoperativa=u.idUnoperativa 
        inner join SUMINISTRANTES_SB e ON a.idSuminis_SB=e.idSuminis_SB
        inner join ESTADOS c ON a.idEstado=c.idEstado
         inner join EJERCICIOS_FISCALES f ON a.idEjercicio=f.idEjercicio
        inner join TIPOS_DE_POLIZAS d ON a.idTip_Poliza=d.idTip_Poliza Where a.idPoliza=".$this->idPoliza." AND d.idTip_Poliza=1";
     //  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }
    public function listadoDetalle(){
        $arreglo = [];
        $sql = "SELECT a.idPoliza_SB,a.idPoliza,b.idMedidor,b.num_Medidor,a.num_doc_resp,c.idMes,c.mes,a.fecha_doc,a.valor_doc FROM POLIZA_SB a
        inner join MEDIDORES b ON a.idMedidor=b.idMedidor
        inner join MESES c On a.idMes=c.idMes where idPoliza=".$this->idPoliza." ";
       //var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
          
          
            return $arreglo;
    }

   

    public function listadoUnidades($idDependencia){
        $arreglo = [];
        $sql = "SELECT * FROM UNIDADES_OPERATIVAS WHERE idDependencia=".$idDependencia."";
        // var_dump($sql);
        $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            }
            return $arreglo;
    }

    public function listadoMedidores($idUnoperativa,$idSuminis_SB){
        $arreglo = [];
        $sql = "SELECT * FROM MEDIDORES WHERE  idUnoperativa=".$idUnoperativa." AND idSuminis_SB=".$idSuminis_SB."";
        // var_dump($sql);
        $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            }
            return $arreglo;
    }

    public function listadoMeses(){
        $arreglo = [];
        $sql = "SELECT * FROM MESES ";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }

 
    
    public function anios(){
        $arreglo = [];
        $sql = "SELECT MAX(anio) as ano, MAX(idEjercicio ) as idEjercicio FROM EJERCICIOS_FISCALES";
        // var_dump($sql);
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        }
        return $arreglo;
    }
    
    public function NumPolizaSelect($year,$idDependencia){
        
        $arreglo = [];
        $sql = "SELECT COUNT(a.num_Poliza) AS 'Contador' ,b.idDependencia,c.idEjercicio,c.anio FROM encabezado a inner join USUARIOS b ON 
        b.idUsuarios=a.idUsuarios
        Inner join EJERCICIOS_FISCALES c ON c.idEjercicio=a.idEjercicio where anio=".$year." AND b.idDependencia=".$idDependencia."";// var_dump($sql);
       // var_dump($sql);
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        }
        return $arreglo;
    }


   
   

    public function insertarEncabezado(){
        
       $id= 0;
       $result2=0;
        $sql="INSERT INTO ENCABEZADO(idPoliza,idUsuarios,idSuminis_SB ,num_Poliza,idEjercicio,fec_crear,idEstado,idTip_Poliza,montoTotal) 
         VALUES(NULL,'".$this->idUsuarios."','".$this->idSuminis_SB."','".$this->num_poliza."','".$this->ejercicio.
         "','".$this->fec_crear."','".$this->idEstado."','".$this->idTip_Poliza."','".$this->montoTotal."')";
       
       $result=  $this->getDb()->conectar()->query($sql);
      // var_dump($result);
       if ($result){
           $sql2="select max(idPoliza)count from  encabezado";

           $result2=  $this->getDb()->conectar()->query($sql2);
       }
       $row=$result2->fetch_assoc();
      // print_r($row["count"]);
       // $result= $res ;
       
       //  $id= ;
        
         return $row["count"];
       
 }
    // pub

    public function insertarDetalle(){
    
        $sql = "INSERT INTO poliza_SB(idPoliza,idMedidor,num_doc_resp,idMes,fecha_doc,valor_doc) 
        VALUES(".$this->idPoliza.",'".$this->idMedidor."','".$this->num_doc_resp."','".$this->idMes."','".$this->fecha."','".$this->valor."')";
        $res = $this->getDb()->conectar()->query($sql);

       // print_r($res);
      //  print_r($sql);
       
       return $res;


}
public function listadoSuministrantes(){
    $arreglo = [];
    $sql = "SELECT * FROM SUMINISTRANTES_SB";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}


public function modificarEncabezado(){
    $sql = "UPDATE ENCABEZADO 
    SET fec_crear='".$this->fec_crear."', montoTotal=".$this->montoTotal.
    " WHERE idPoliza=".$this->idPoliza;
    // print_r($sql).die();
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}

public function modificarEstado(){
    $sql = "UPDATE ENCABEZADO 
    SET idEstado='".$this->idEstado.
    "' WHERE idPoliza=".$this->idPoliza;
    // print_r($sql).die();
    // var_dumpr($sql);
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}



public function eliminarDetalle(){
    $sql = "DELETE FROM POLIZA_SB WHERE idPoliza_SB=".$this->idPoliza_SB;
    $res = $this->getDb()->conectar()->query($sql);
    return ($res===TRUE)?true:false;
}


 }
    




?>