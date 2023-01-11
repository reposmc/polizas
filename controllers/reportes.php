<?php
require_once 'public/fpdf/fpdf.php';

Class Reportes extends Controller{
    public function __construct(){
        parent::__construct();
    }
   

 

    //REPORTE DE PAGOS POR UNIDAD OPERATIVA
    public function pdfPago(){




 if(!empty($_POST)){
    
    $ano= $_POST["txtAnio"];
    $mes= $_POST["sMeses"];
    $unidad= $_POST["sUnidad"];
    if($_SESSION['idRoles']==2){
    $encabezar= $this->getModel()->encabezar($unidad,$_SESSION['idDependencia'],$ano,$mes);
    $pagos = $this->getModel()->pagosporUnidades($unidad,$_SESSION['idDependencia'],$ano,$mes);
    $sumaPago = $this->getModel()->sumaPago($unidad,$_SESSION['idDependencia'],$ano,$mes);
    }else{
        $dependencia= $_POST["sDependencia"];
        $encabezar= $this->getModel()->encabezar($unidad, $dependencia,$ano,$mes);
        $pagos = $this->getModel()->pagosporUnidades($unidad, $dependencia,$ano,$mes);
        $sumaPago = $this->getModel()->sumaPago($unidad, $dependencia,$ano,$mes);

    }
    $pdf = new FPDF('P', 'mm', array(300,250));

    $pdf->AliasNbPages();
    //  var_dump( $pdf->AddPage());
   
    $pdf->AddPage();

    $pdf->SetFont('Times','',12);
    
    
    $pdf->Image("public/img/footer.png", 15, 10, 40, 25, 'PNG');
    $pdf->Ln(20);
    foreach ($encabezar as $value){
        //$pdf->Cell(195, 5, utf8_decode($value['nombre']), 0, 1, 'C');
        
     
        $pdf->SetFont('Arial', 'B', 15);
     
      
        $pdf->Cell(225, 5, utf8_decode("INFORME MENSUAL DE PAGOS POR UNIDAD OPERATIVA"), 0, 1, 'C');
        $pdf->Ln(2);
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('Nombre de Unidad:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(120, 5, utf8_decode($value['nom_unoperativa']), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(20, 5, utf8_decode('Año Fiscal:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(70, 5, utf8_decode($value['anio']), 0, 1, 'L');
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('Mes:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['mes']), 0, 1, 'L');
        $pdf->Ln(4);

      $pdf->SetFont('Arial', 'B', 10);
      
        $pdf->Cell(27, 5, utf8_decode('Departamento:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(80, 5, $value['nom_depto'], 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 5, 'Direccion Nacional:', 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['nom_dnac']), 0, 1, 'L');
     
     
     

    }
   
                $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        // $pdf->Cell(222, 5, "", 1, 0, 'C', 0);
        // $pdf->SetTextColor(0, 0, 0);
        // $pdf->SetTextColor(255, 255, 255);

        $pdf->Cell(34, 5, utf8_decode("No Medidor"), 1, 0, 'L', 1);
        $pdf->Cell(84, 5, "Suministrante", 1, 0, 'L',1);
        $pdf->Cell(23, 5, "No Poliza", 1, 0, 'L',1);
        $pdf->Cell(35, 5, "No Documento", 1, 0, 'L',1);
        $pdf->Cell(30, 5, "Fecha", 1, 0, 'L',1);
        $pdf->Cell(30, 5, "Valor", 1, 1, 'L',1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(3);
    //    $nombre= $pagos['nom_depto'][0];
        foreach ($pagos as  $val){
           
            // $pdf->Cell(35, 5, number_format($row['cantidad'] * $row['precio'], 2, '.', ','), 0, 1, 'L');
        
        $pdf->SetFont('Arial', '', 10);
        
            $pdf->Cell(34, 5, $val['num_Medidor'], 0, 0, 'L');
            
            $pdf->Cell(84, 5, $val['nom_suminist'], 0, 0, 'L');
            $pdf->Cell(23, 5, $val['num_Poliza'], 0, 0, 'C');
            $pdf->Cell(25, 5, $val['num_doc_resp'], 0, 0, 'C');
            $pdf->Cell(30, 5, $val['fecha_doc'], 0, 0, 'C');
            $pdf->Cell(30, 5, $val['valor_doc'], 0, 1, 'C');
            $pdf->Ln(3);
        
    }
    $pdf->Ln(3);
      
    foreach ($sumaPago as $value){
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(211, 5, utf8_decode('Total:'),30,0, 0, 0, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(60, 5, utf8_decode($value['valor']), 0, 1, 'L');
   
    }

 
    
        $pdf->Output("pagosPorUnidad.pdf", "I");
    

    }else{
        if(isset($_SESSION['idDependencia'])){
            if($_SESSION['idRoles']==2){
            $this->getView()->unidad = $this->getModel()->listadoUnidades($_SESSION['idDependencia']);
        }
        $this->getView()->meses = $this->getModel()->listadoMeses();
        $this->getView()->anio = $this->getModel()->Anio();
        $this->getView()->dependencia = $this->getModel()->Dependencia();
           $pagina = 'reportes/pagoPorUnidad';
           $this->getView()->loadView($pagina);
        }else {
            $pagina = 'inicio/login';
            $this->getView()->loadView($pagina);
        }
}
}

public function dependencia(){
   
    if(!empty($_POST)){
      
        $idDependencia = $_POST["idDependencia"];
        $this->getView()->unidad = $this->getModel()->listadoUnidades($idDependencia);
        echo'<option value=""></option>';
        foreach ( $this->getView()->unidad as $value) {
            echo '<option value="'.$value["idUnoperativa"].'" >'.$value["nom_unoperativa"].'</option>';
            // var_dump($this->getView()->medidores);
        
    }
}
}


//REPORTE DE SB POR NUMERO DE MEDIDOR
public function pdfMedidor(){
    if(!empty($_POST)){
    $idMedidor = $_POST["sMedidor"];
    $anio= $_POST["txtAnio"];
   
    if($_SESSION['idRoles']==2){
    $medidor= $this->getModel()->medidor($_SESSION['idDependencia'],$idMedidor,$anio);
    $noMedidor = $this->getModel()->noMedidor($_SESSION['idDependencia'],$idMedidor,$anio);
    $suma=$this->getModel()->suma($_SESSION['idDependencia'],$idMedidor,$anio);
    }else{
        $sDependencia= $_POST["sDependencias"];
        $medidor= $this->getModel()->medidor($sDependencia,$idMedidor,$anio);
        $noMedidor = $this->getModel()->noMedidor($sDependencia,$idMedidor,$anio);
        $suma=$this->getModel()->suma($sDependencia,$idMedidor,$anio);
    }
    $pdf = new FPDF('P', 'mm', 'letter');
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    
     $pdf->Image("public/img/footer.png", 15, 10, 40, 25, 'PNG');
        $pdf->Ln(20);
    foreach ($medidor as $value){
        //$pdf->Cell(195, 5, utf8_decode($value['nombre']), 0, 1, 'C');
       
        $pdf->SetFont('Arial', 'B', 15);
     
        $pdf->Cell(196, 5, utf8_decode("REPORTE DE SERVICIO BASICO POR No MEDIDOR"), 0, 1, 'C');
        $pdf->Ln(2);
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('No Medidor:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, utf8_decode($value['num_Medidor']), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 5, utf8_decode('Suministrante:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['nom_Suminist']), 0, 1, 'L');
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('Año:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(50, 5, utf8_decode($value['anio']), 0, 0, 'L');
       $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 5, utf8_decode('Unidad Operativa:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5,utf8_decode( $value['nom_unoperativa']), 0, 1, 'L');
     
        
     

    }
   
                $pdf->Ln(5);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        // $pdf->Cell(196, 5, "REPORTE POR NUMERO DE MEDIDOR", 1, 1, 'C', 1);
       
        $pdf->Cell(40, 5, utf8_decode('No Poliza'), 0, 0, 'L',1);
        $pdf->Cell(46, 5, 'No Documento', 0, 0, 'L',1);
        $pdf->Cell(39, 5, 'Fecha', 0, 0, 'L',1);
        $pdf->Cell(39, 5, 'Mes', 0, 0, 'L',1);
        $pdf->Cell(39, 5, 'Valor.', 0, 1, 'L',1);
        $pdf->SetFont('Arial', '', 10);
        $pdf->SetTextColor(0, 0, 0);
        foreach ($noMedidor as $val){
            $pdf->Cell(40, 5, $val['num_Poliza'], 0, 0, 'L');
            $pdf->Cell(46, 5, $val['num_doc_resp'], 0, 0, 'L');
            $pdf->Cell(39, 5, $val['fecha_doc'], 0, 0, 'L');
            $pdf->Cell(39, 5, $val['mes'], 0, 0, 'L');
            $pdf->Cell(39, 5, $val['valor_doc'], 0, 1, 'L');
            // $pdf->Cell(35, 5, number_format($row['cantidad'] * $row['precio'], 2, '.', ','), 0, 1, 'L');

           
    }
    //$pdf->Cell(35, 5,  $val['valor_doc'], 2, '.', ','), 0, 1, 'L');
    $pdf->Ln(3);
      
        foreach ($suma as $value){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(163, 5, utf8_decode('Total:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['total']), 0, 1, 'L');
       
        }
    
        
        $pdf->Output("pagosPorUnidad.pdf", "I");
    }else{
        if(isset($_SESSION['idDependencia'])){
            if($_SESSION['idRoles']==2){
        
        $this->getView()->medidor = $this->getModel()->listadoMedidores($_SESSION['idDependencia']);
            }
            $this->getView()->dependencia = $this->getModel()->Dependencia();
        $this->getView()->anio = $this->getModel()->Anio();
        $pagina = 'reportes/reportePorNoMedidor';
        $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }

    }
    

}

public function medidor(){
   
    if(!empty($_POST)){
      
        $idDependencia = $_POST["idDependencia"];
        $this->getView()->medidor= $this->getModel()->listadoMedidores($idDependencia);
        
        echo'<option value=""></option>';
        foreach ( $this->getView()->medidor as $value) {
            echo '<option value="'.$value["idMedidor"].'" >'.$value["num_Medidor"].'</option>';
            // var_dump($this->getView()->medidores);
        
    }
}
}
 //REPORTE INFORME ANUAL POR TIPO DE SUMINISTRO DE SERVICIO BASICOS

public function pdfTipo(){
    if(!empty($_POST)){
    
    $stipo = $_POST["sTipo"];
    $anio= $_POST["txtAnio"];
    if($_SESSION['idRoles']==2){
    $tipo= $this->getModel()->tipo($_SESSION['idDependencia'], $stipo,$anio);
    $tipoDetalle = $this->getModel()->tipoDetalle($_SESSION['idDependencia'], $stipo,$anio);
    $notipo = $this->getModel()->notipo($_SESSION['idDependencia']);
    $enero = $this->getModel()->Enero($_SESSION['idDependencia'], $stipo,$anio);
    $febrero = $this->getModel()->Febrero($_SESSION['idDependencia'], $stipo,$anio);
    $marzo = $this->getModel()->Marzo($_SESSION['idDependencia'], $stipo,$anio);
    $abril = $this->getModel()->Abril($_SESSION['idDependencia'], $stipo,$anio);
    $mayo = $this->getModel()->Mayo($_SESSION['idDependencia'], $stipo,$anio);
    $junio = $this->getModel()->Junio($_SESSION['idDependencia'], $stipo,$anio);
    $julio= $this->getModel()->Julio($_SESSION['idDependencia'], $stipo,$anio);
    $agosto = $this->getModel()->Agosto($_SESSION['idDependencia'], $stipo,$anio);
    $septiembre = $this->getModel()->Septiembre($_SESSION['idDependencia'], $stipo,$anio);
    $octubre = $this->getModel()->Octubre($_SESSION['idDependencia'], $stipo,$anio);
    $noviembre = $this->getModel()->Noviembre($_SESSION['idDependencia'], $stipo,$anio);
    $diciembre = $this->getModel()->Diciembre($_SESSION['idDependencia'], $stipo,$anio);
 $subtotal = $this->getModel()->Subtotal($_SESSION['idDependencia'], $stipo,$anio);
    }else{
        $sDependencias= $_POST["sDependencia"];
        $tipo= $this->getModel()->tipo($sDependencias, $stipo,$anio);
        $notipo = $this->getModel()->notipo($sDependencias);
        // for($i=0; $i<=)
        $tipoDetalle = $this->getModel()->tipoDetalle($sDependencias, $stipo,$anio);
        $enero = $this->getModel()->Enero($sDependencias, $stipo,$anio);
        $febrero = $this->getModel()->Febrero($sDependencias, $stipo,$anio);
        $marzo = $this->getModel()->Marzo($sDependencias, $stipo,$anio);
        $abril = $this->getModel()->Abril($sDependencias, $stipo,$anio);
        $mayo = $this->getModel()->Mayo($sDependencias, $stipo,$anio);
        $junio = $this->getModel()->Junio($sDependencias, $stipo,$anio);
        $julio= $this->getModel()->Julio($sDependencias, $stipo,$anio);
        $agosto = $this->getModel()->Agosto($sDependencias, $stipo,$anio);
        $septiembre = $this->getModel()->Septiembre($sDependencias, $stipo,$anio);
        $octubre = $this->getModel()->Octubre($sDependencias, $stipo,$anio);
        $noviembre = $this->getModel()->Noviembre($sDependencias, $stipo,$anio);
        $diciembre = $this->getModel()->Diciembre($sDependencias, $stipo,$anio);
     $subtotal = $this->getModel()->Subtotal($sDependencias, $stipo,$anio);
    }

  
 $pdf = new FPDF('L','mm','A4');
 $pdf->AliasNbPages();
 $pdf->AddPage();
 $pdf->Image("public/img/footer.png", 15, 10, 40, 25, 'PNG');
 $pdf->Ln(25);
    foreach ($tipo as $value){
       
        
        $pdf->SetFont('Arial', 'B', 15);
     
        $pdf->Cell(269, 5, utf8_decode("INFORME ANUAL POR TIPO DE SUMINISTRANTE"), 0, 1, 'C');
        $pdf->Ln(2);
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(70, 5, utf8_decode('Tipo Suministrante:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(120, 5, utf8_decode($value['tipo_suminist']), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 5, utf8_decode('Año:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(70, 5, utf8_decode($value['anio']), 0, 1, 'L');
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(40, 5, utf8_decode('Unidad:'),30,0, 0, 0, 'L');
        // $pdf->SetFont('Arial', '', 10);
        // $pdf->Cell(40, 5, utf8_decode($value['nom_unoperativa']), 0, 1, 'L');
     
        
     

    }

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(275, 5, "INFORME", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(3);
             
        
        
        $pdf->Cell(25, 5, 'Suministrante', 0, 0, 'L');
        $pdf->Cell(24, 5, utf8_decode('No Medidor'), 0, 0, 'L');
        $pdf->Cell(16, 5, utf8_decode('Enero'), 0, 0, 'L');
        $pdf->Cell(17, 5, utf8_decode('Febrero'), 0, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode('Marzo'), 0, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode('Abril'), 0, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode('Mayo'), 0, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode('Junio'), 0, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode('Julio'), 0, 0, 'L');
        $pdf->Cell(15, 5, utf8_decode('Agosto'), 0, 0, 'L');
        $pdf->Cell(22, 5, utf8_decode('Septiembre'), 0, 0, 'L');
        $pdf->Cell(17, 5, utf8_decode('Octubre'), 0, 0, 'L');
        $pdf->Cell(23, 5, utf8_decode('Noviembre'), 0, 0, 'L');
        $pdf->Cell(24, 5, utf8_decode('Diciembre'), 0, 0, 'L');
        $pdf->Cell(24, 5, utf8_decode('Total'), 0, 1, 'L');
        $pdf->Ln(2);
      
    

        foreach ($notipo  as $tipo){
            $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(25, 5,  utf8_decode($tipo['nom_unoperativa']), 0, 1, 'L');
        
 
        
foreach($tipoDetalle as $val){

    if($val['idUnoperativa']==$tipo['idUnoperativa']){ 
         $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(25, 5, $val['nom_Suminist'], 0, 0, 'L');
        $pdf->Cell(24, 5, $val['num_Medidor'], 0, 0, 'L');
        $pdf->Cell(16, 5, $val['Enero'], 0, 0, 'L');
        $pdf->Cell(17, 5, $val['Febrero'], 0, 0, 'L');
        $pdf->Cell(15, 5, $val['Marzo'], 0, 0, 'L');
        $pdf->Cell(15, 5, $val['Abril'], 0, 0, 'L');
        $pdf->Cell(16, 5, $val['Mayo'], 0, 0, 'L');
        $pdf->Cell(15, 5, $val['Junio'], 0, 0, 'L');
        $pdf->Cell(15, 5, $val['Julio'], 0, 0, 'L');
        $pdf->Cell(15, 5, $val['Agosto'], 0, 0, 'L');
        $pdf->Cell(22, 5, $val['Septiembre'], 0, 0, 'L');
        $pdf->Cell(17, 5, $val['Octubre'], 0, 0, 'L');
        $pdf->Cell(23, 5, $val['Noviembre'], 0, 0, 'L');
        $pdf->Cell(24, 5, $val['Diciembre'], 0, 0, 'L');
        $pdf->Cell(24, 5, $val['total'], 0, 1, 'L');
    
    }
           
        }
    
    
    
        }

        
        foreach ($enero as $val){
            $pdf->SetFont('Arial', 'B', 10);
            
        $pdf->Cell(49, 5, 'Suma Total', 0, 0, 'L');
           
            $pdf->Cell(16, 5, $val['enero'], 0, 0, 'L');

        }
        foreach ($febrero as $val){
            $pdf->SetFont('Arial', 'B', 10);
         
            $pdf->Cell(16, 5, $val['febrero'], 0, 0, 'L');

        }
        foreach ($marzo as $val){
            $pdf->SetFont('Arial', 'B', 10);
     
            $pdf->Cell(16, 5, $val['marzo'], 0, 0, 'L');

        }
        foreach ($abril as $val){
            $pdf->SetFont('Arial', 'B', 10);
           
            $pdf->Cell(16, 5, $val['abril'], 0, 0, 'L');

        }
        foreach ($mayo as $val){
            $pdf->SetFont('Arial', 'B', 10);
           
            $pdf->Cell(15, 5, $val['mayo'], 0, 0, 'L');

        }
        foreach ($junio as $val){
            $pdf->SetFont('Arial', 'B', 10);
           
            $pdf->Cell(15, 5, $val['junio'], 0, 0, 'L');

        }
        foreach ($julio as $val){
            $pdf->SetFont('Arial', 'B', 10);

           
            $pdf->Cell(15, 5, $val['julio'], 0, 0, 'L');

        }
        foreach ($agosto as $val){
            $pdf->SetFont('Arial', 'B', 10);
            
       
           
            $pdf->Cell(15, 5, $val['agosto'], 0, 0, 'L');

        }
        foreach ($septiembre as $val){
            $pdf->SetFont('Arial', 'B', 10);

            $pdf->Cell(22, 5, $val['septiembre'], 0, 0, 'L');

        }
        foreach ($octubre as $val){
            $pdf->SetFont('Arial', 'B', 10);
           
            $pdf->Cell(17, 5, $val['octubre'], 0, 0, 'L');

        }
        foreach ($noviembre as $val){
            $pdf->SetFont('Arial', 'B', 10);
            
        
           
            $pdf->Cell(23, 5, $val['noviembre'], 0, 0, 'L');

        }
        foreach ($diciembre as $val){
            $pdf->SetFont('Arial', 'B', 10);
            
     
           
            $pdf->Cell(24, 5, $val['diciembre'], 0, 0, 'L');
        }
        foreach ($subtotal as $val){
            $pdf->SetFont('Arial', 'B', 10);
            
     
           
            $pdf->Cell(24, 5, $val['subtotal'], 0, 0, 'L');

        }
         
      
   
        // $pdf->Ln(3);
      
        // foreach ($sumatipo as $value){
        // $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(167, 5, utf8_decode('Total:'),30,0, 0, 0, 'L');
        // $pdf->SetFont('Arial', '', 10);
        // $pdf->Cell(60, 5, utf8_decode($value['monto']), 0, 1, 'L');
       
        // }
        
        
    
        
        $pdf->Output("informeAnual.pdf", "I");
    

}else{
    if(isset($_SESSION['idDependencia'])){
        $this->getView()->dependencia = $this->getModel()->Dependencia();
        $this->getView()->anio = $this->getModel()->Anio();
    $this->getView()->tipo = $this->getModel()->listadoTipo();
    $pagina = 'reportes/reporteAnualPorTipo';
    $this->getView()->loadView($pagina);
}else {
    $pagina = 'inicio/login';
    $this->getView()->loadView($pagina);
}

}
}


}
?>