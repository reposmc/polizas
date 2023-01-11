<?php 
 class ReportesModelo extends Model{
    private $idPoliza;
    
    public function __construct(){
        parent::__construct();
    
    }
    public function Dependencia(){
        $arreglo = [];
        $sql = "SELECT *FROM DEPENDENCIAS"; 
         $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }
    public function Anio(){
        $arreglo = [];
        $sql = "SELECT *FROM EJERCICIOS_FISCALES"; 
         $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }

    //anio


   //REPORTE MENSUAL DE PAGOS POR UNIDAD OPERATIVA
    public function pagosporUnidades($idUnoperativa,$idDependencia,$ano,$idMes){
        $arreglo = [];
        $sql = "   SELECT a.idPoliza,k.idEjercicio,k.anio,a.idTip_Poliza,h.idSuminis_SB,h.nom_suminist,g.idMes,g.mes,a.num_Poliza,b.idPoliza_SB,b.num_doc_resp,b.fecha_doc,b.valor_doc,c.idMedidor,
        c.num_Medidor,d.idUnoperativa,d.nom_unoperativa,e.idDepto,e.nom_depto,f.idDnac,f.nom_dnac,j.idDependencia
        FROM POLIZA_SB b inner join ENCABEZADO a ON a.idPoliza=b.idPoliza
        inner join MESES g ON g.idMes=b.idMes
        inner join SUMINISTRANTES_SB h ON h.idSuminis_SB=a.idSuminis_SB
        inner join MEDIDORES c ON c.idMedidor=b.idMedidor
        inner join EJERCICIOS_FISCALES k ON k.idEjercicio=a.idEjercicio
        inner join UNIDADES_OPERATIVAS d ON d.idUnoperativa=c.idUnoperativa
         inner join DEPENDENCIAS j ON j.idDependencia=d.idDependencia
        INNER JOIN DEPARTAMENTOS e ON e.idDepto=d.idDepto
        INNER JOIN DIRECCIONES_NACIONALES f ON f.idDnac=d.idDnac where d.idUnoperativa=".$idUnoperativa." AND  j.idDependencia = ".$idDependencia."   AND k.idEjercicio=".$ano." AND g.idMes=".$idMes." AND a.idTip_Poliza=1";
 //    var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }
    public function encabezar($idUnoperativa,$idDependencia,$ano,$idMes){
        $arreglo = [];
        $sql = "SELECT DISTINCT k.anio,a.idTip_Poliza,g.mes,
        d.idUnoperativa,d.nom_unoperativa,j.idDependencia,e.idDepto,e.nom_depto,f.idDnac,f.nom_dnac
         FROM POLIZA_SB b inner join ENCABEZADO a ON a.idPoliza=b.idPoliza
         inner join MESES g ON g.idMes=b.idMes
         inner join MEDIDORES c ON c.idMedidor=b.idMedidor
         inner join EJERCICIOS_FISCALES k ON k.idEjercicio=a.idEjercicio
         inner join UNIDADES_OPERATIVAS d ON d.idUnoperativa=c.idUnoperativa
          inner join DEPENDENCIAS j ON j.idDependencia=d.idDependencia
         INNER JOIN DEPARTAMENTOS e ON e.idDepto=d.idDepto
         INNER JOIN DIRECCIONES_NACIONALES f ON f.idDnac=d.idDnac where d.idUnoperativa=".$idUnoperativa." AND j.idDependencia = ".$idDependencia." AND  k.idEjercicio=".$ano." AND  g.idMes=".$idMes." AND a.idTip_Poliza=1";
    //  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function listadoUnidades($idDependencia){
        $arreglo = [];
        $sql = "SELECT p.idUnoperativa, p.nom_unoperativa,m.idDepto, m.nom_depto,a.idDnac,a.nom_dnac,b.idDependencia,b.nom_dependencia FROM UNIDADES_OPERATIVAS p
        INNER JOIN DEPARTAMENTOS m ON m.idDepto=p.idDepto 
        INNER JOIN DEPENDENCIAS b ON p.idDependencia=b.idDependencia
        INNER JOIN DIRECCIONES_NACIONALES a ON p.idDnac=a.idDnac  WHERE  b.idDependencia=".$idDependencia." order by idUnoperativa";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }
      
    public function sumaPago($idUnoperativa,$idDependencia,$ano,$idMes){
        $arreglo = [];
        $sql = " SELECT a.idPoliza,k.idEjercicio,k.anio,a.idTip_Poliza,h.idSuminis_SB,h.nom_suminist,g.idMes,g.mes,a.num_Poliza,b.idPoliza_SB,b.num_doc_resp,b.fecha_doc,sum(b.valor_doc) as valor,c.idMedidor,
        c.num_Medidor,d.idUnoperativa,d.nom_unoperativa,e.idDepto,e.nom_depto,f.idDnac,f.nom_dnac,j.idDependencia
        FROM POLIZA_SB b inner join ENCABEZADO a ON a.idPoliza=b.idPoliza
        inner join MESES g ON g.idMes=b.idMes
        inner join SUMINISTRANTES_SB h ON h.idSuminis_SB=a.idSuminis_SB
        inner join MEDIDORES c ON c.idMedidor=b.idMedidor
        inner join EJERCICIOS_FISCALES k ON k.idEjercicio=a.idEjercicio
        inner join UNIDADES_OPERATIVAS d ON d.idUnoperativa=c.idUnoperativa
         inner join DEPENDENCIAS j ON j.idDependencia=d.idDependencia
        INNER JOIN DEPARTAMENTOS e ON e.idDepto=d.idDepto
        INNER JOIN DIRECCIONES_NACIONALES f ON f.idDnac=d.idDnac 
        where d.idUnoperativa=".$idUnoperativa." AND j.idDependencia = ".$idDependencia."   AND k.idEjercicio=".$ano." AND g.idMes=".$idMes." AND a.idTip_Poliza=1";
     //  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function listadoMeses(){
        $arreglo = [];
        $sql = "SELECT idMes,mes FROM MESES";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }

    //REPORTE DE SERVICIO BASICO POR NO DE MEDIDOR 
    public function medidor($idDependencia,$idMedidor,$anio){
        $arreglo = [];
        $sql = "   SELECT DISTINCT k.idEjercicio,k.anio,a.idTip_Poliza,b.idSuminis_SB,b.nom_Suminist,f.idMedidor,f.num_Medidor,d.idUnoperativa,d.nom_unoperativa,d.idDependencia 
        FROM POLIZA_SB c INNER JOIN ENCABEZADO a ON a.idPoliza=c.idPoliza
        INNER JOIN SUMINISTRANTES_SB b ON b.idSuminis_SB=a.idSuminis_SB
         INNER JOIN MEDIDORES F ON f.idMedidor=c.idMedidor
          inner join EJERCICIOS_FISCALES k ON k.idEjercicio=a.idEjercicio
        INNER JOIN UNIDADES_OPERATIVAS d ON d.idUnoperativa=f.idUnoperativa  where d.idDependencia = ".$idDependencia." AND f.idMedidor=".$idMedidor." AND k.idEjercicio=".$anio." AND a.idTip_Poliza=1";
    //   var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function noMedidor($idDependencia,$idMedidor,$anio){
        $arreglo = [];
        $sql = "SELECT a.idPoliza,k.idEjercicio,k.anio,a.idTip_Poliza,g.idMes,g.mes,a.num_Poliza,b.idPoliza_SB,b.num_doc_resp,b.fecha_doc,b.valor_doc,c.idMedidor,c.num_Medidor,d.idDependencia,
        d.idUnoperativa,d.nom_unoperativa FROM POLIZA_SB b inner join ENCABEZADO a ON a.idPoliza=b.idPoliza
        inner join MESES g ON g.idMes=b.idMes
        inner join MEDIDORES c ON c.idMedidor=b.idMedidor
        inner join EJERCICIOS_FISCALES k ON k.idEjercicio=a.idEjercicio
        inner join UNIDADES_OPERATIVAS d ON d.idUnoperativa=c.idUnoperativa WHERE d.idDependencia = ".$idDependencia." AND c.idMedidor=".$idMedidor." AND  k.idEjercicio=".$anio." AND a.idTip_Poliza=1";
     //  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function suma($idDependencia,$idMedidor,$anio){
        $arreglo = [];
        $sql = "SELECT a.idPoliza,k.idEjercicio,k.anio,a.idTip_Poliza,g.idMes,g.mes,a.num_Poliza,b.idPoliza_SB,b.num_doc_resp,b.fecha_doc,sum(b.valor_doc) as total,c.idMedidor,c.num_Medidor,d.idDependencia,
        d.idUnoperativa,d.nom_unoperativa FROM POLIZA_SB b inner join ENCABEZADO a ON a.idPoliza=b.idPoliza
        inner join MESES g ON g.idMes=b.idMes
        inner join MEDIDORES c ON c.idMedidor=b.idMedidor
        inner join EJERCICIOS_FISCALES k ON k.idEjercicio=a.idEjercicio
        inner join UNIDADES_OPERATIVAS d ON d.idUnoperativa=c.idUnoperativa
        where d.idDependencia= ".$idDependencia." AND c.idMedidor=".$idMedidor." AND k.idEjercicio=".$anio." AND a.idTip_Poliza=1";
     //  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

    public function listadoMedidores($idDependencia){
        $arreglo = [];
        $sql = "SELECT b.idMedidor,b.num_Medidor,c.idUnoperativa,c.idDependencia FROM MEDIDORES b
        INNER JOIN UNIDADES_OPERATIVAS c ON c.idUnoperativa=b.idUnoperativa WHERE c.idDependencia=".$idDependencia."";
        
        $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            }
            return $arreglo;
    }


//REPORTE ANUAL POR TIPO DE SUMINISTRO DE SB



public function tipo($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante  where e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function tipoDetalle($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "SELECT j.idEjercicio,j.anio,a.idTip_Poliza,d.num_Medidor,e.idUnoperativa,e.nom_unoperativa,p.idDepto,p.nom_depto,k.idDnac,k.nom_dnac,f.idSuminis_SB,f.nom_Suminist, 
    m.idTipoSuministrante,m.tipo_suminist,e.idDependencia,
     max(case when c.idMes='1' then b.valor_doc end) as Enero,
	 max(case when c.idMes='2' then b.valor_doc end) as Febrero,
     max(case when c.idMes='3' then b.valor_doc end) as Marzo,
     max(case when c.idMes='4' then b.valor_doc end) as Abril,
     max(case when c.idMes='5' then b.valor_doc end) as Mayo,
     max(case when c.idMes='6' then b.valor_doc end) as Junio,
     max(case when c.idMes='7' then b.valor_doc end) as Julio,
     max(case when c.idMes='8' then b.valor_doc end) as Agosto,
     max(case when c.idMes='9' then b.valor_doc end) as Septiembre,
     max(case when c.idMes='10' then b.valor_doc end) as Octubre,
     max(case when c.idMes='11' then b.valor_doc end)as Noviembre,
     max(case when c.idMes='12' then b.valor_doc end) as Diciembre,
     SUM(b.valor_doc) as total
	From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN MESES c ON c.idMes=b.idMes
    INNER JOIN EJERCICIOS_FISCALES j ON j.idEjercicio=a.idEjercicio
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN DEPARTAMENTOS p ON p.idDepto=e.idDepto
    INNER JOIN DIRECCIONES_NACIONALES k ON k.idDnac=e.idDnac
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante
     Where idDependencia=".$idDependencia." AND m.idTipoSuministrante=".$stipo." AND j.idEjercicio=".$anio." 
    group by num_medidor, nom_unoperativa
    order by nom_unoperativa";//  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}


public function notipo($idDependencia){
        $arreglo = [];
        $sql = "SELECT a.idUnoperativa,a.nom_unoperativa FROM UNIDADES_OPERATIVAS as a
        inner join DEPENDENCIAS as b ON b.idDependencia=a.idDependencia
        WHERE b.idDependencia=".$idDependencia."";//  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

// public function sumatipo($idUnoperativa,$stipo,$anio){
//     $arreglo = [];
//     $sql = " SELECT a.ejercicio,a.idTip_Poliza,b.idPoliza_SB,sum(b.valor_doc) as monto,c.idMes,c.mes,d.idMedidor,d.num_Medidor,e.idUnoperativa,e.nom_unoperativa,f.idSuminis_SB,f.nom_Suminist, 
//     m.idTipoSuministrante,m.tipo_suminist
//     From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
//     INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
//     INNER JOIN MESES c ON c.idMes=b.idMes
//     INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
//     INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
//     INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante  where d.idUnoperativa = ".$idUnoperativa." AND f.idTipoSuministrante=".$stipo." AND ejercicio=".$anio." AND a.idTip_Poliza=1";
//  //  var_dump($sql);
//    $datos = $this->getDb()->conectar()->query($sql);
//         while($fila = $datos->fetch_assoc()){
//             $arreglo[] = $fila;
        
//         }
//         return $arreglo;
// }
public function listadoTipo(){
    $arreglo = [];
    $sql = "SELECT * FROM TIPOS_DE_SUMINISTRANTE";
    $datos = $this->getDb()->conectar()->query($sql);
    while($fila = $datos->fetch_object()){
        $arreglo[] = json_decode(json_encode($fila),true);
    }
    return $arreglo;
}

//MESES SUMAS
public function Subtotal($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as subtotal
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}

public function Enero($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as enero
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=1  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Febrero($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as febrero
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=2  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Marzo($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as marzo
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=3 AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Abril($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as abril
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=4 AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Mayo($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as mayo
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=5 AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Junio($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as junio
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=6  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Julio($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as julio
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=7  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Agosto($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as agosto
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=8  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Septiembre($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as septiembre
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=9 AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Octubre($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as octubre
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=10  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Noviembre($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as noviembre
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=11 AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}
public function Diciembre($idDependencia,$stipo,$anio){
    $arreglo = [];
    $sql = "   SELECT DISTINCT l.anio,a.idTip_Poliza,e.idDependencia,m.tipo_suminist,SUM(b.valor_doc) as diciembre
    From Poliza_SB b INNER JOIN ENCABEZADO a ON a.idPoliza=b.idPoliza
    INNER JOIN MEDIDORES d ON d.idMedidor=b.idMedidor
    INNER JOIN UNIDADES_OPERATIVAS e ON e.idUnoperativa=d.idUnoperativa
    INNER JOIN EJERCICIOS_FISCALES l ON l.idEjercicio=a.idEjercicio
    INNER JOIN SUMINISTRANTES_SB f ON f.idSuminis_SB=d.idSuminis_SB
    INNER JOIN TIPOS_DE_SUMINISTRANTE m ON m.idTipoSuministrante=f.idTipoSuministrante Where idMes=12  AND e.idDependencia = ".$idDependencia." AND f.idTipoSuministrante=".$stipo." AND l.idEjercicio=".$anio." AND a.idTip_Poliza=1";
 //  var_dump($sql);
   $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_assoc()){
            $arreglo[] = $fila;
        
        }
        return $arreglo;
}



 }