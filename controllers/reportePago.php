<?php
require_once 'public/fpdf/fpdf.php';
class ReportePago extends Controller{
    public function __construct(){
        parent::__construct();
    }
  
    
    public function pdfReportePago(){
        // $pie=$this->Cell(0,10,'Page '.$this->PageNo(),0,0,'C');
        if(!empty($_POST)){
    $pdf = new FPDF('P', 'mm', array(300,270));
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $ano= $_POST["txtAnio"];
   
    if($_SESSION['idRoles']==2){
        $encabezado = $this->getModel()->encabezado($_SESSION['idDependencia'],$ano);
        $listadoPago = $this->getModel()->listadoPago($_SESSION['idDependencia'],$ano);

    }else{
        $dependencia= $_POST["sDependencia"];
        $encabezado = $this->getModel()->encabezado($dependencia,$ano);
        $listadoPago = $this->getModel()->listadoPago($dependencia,$ano);
    }
    
          
    $pdf->Image("public/img/footer.png", 15, 10, 40, 25, 'PNG');
    $pdf->Ln(25);
    $pdf->SetFont('Arial', 'B', 15);
 
    $pdf->Cell(230, 5, utf8_decode("Reporte de Registro de Pagos"), 0, 1, 'C');
    
    foreach ($encabezado as $value){
        //$pdf->Cell(195, 5, utf8_decode($value['nombre']), 0, 1, 'C');
       
      
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('Ejercicio Fiscal:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['anio']), 0, 1, 'L');
       
    }
                $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
     
        $pdf->Cell(20, 5, utf8_decode('N°'), 0, 0, 'L',1);
       
        $pdf->Cell(30, 5, utf8_decode('Fecha pago'), 0, 0, 'L',1);
        $pdf->Cell(36, 5, 'Fecha que ingreso', 0, 0, 'L',1);
        $pdf->Cell(20, 5, utf8_decode('N° Poliza'), 0, 0, 'L',1);
        $pdf->Cell(32, 5, 'Monto Pagado', 0, 0, 'L',1);
        $pdf->Cell(37, 5, 'Tipo Transaccion', 0, 0, 'L',1);
        $pdf->Cell(45, 5, 'Banco', 0, 0, 'L',1);
        $pdf->Cell(32, 5, 'No de cuenta', 0, 1, 'L',1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($listadoPago as $val) {
            $pdf->Cell(20, 5, $contador, 0, 0, 'L');
           
            $pdf->Cell(36, 5, $val['fechaPago'], 0, 0, 'L');
            $pdf->Cell(32, 5, $val['fechaActual'], 0, 0, 'L');
            $pdf->Cell(20, 5, $val['num_Poliza'], 0, 0, 'L');
            $pdf->Cell(32, 5, $val['total'], 0, 0, 'L');
            $pdf->Cell(35, 5, $val['tipoTransacciones'], 0, 0, 'L');
            $pdf->Cell(45, 5, $val['nomb_bancos'], 0, 0, 'L');
            $pdf->Cell(32, 5, $val['num_Documento'], 0, 1, 'L');
            // $pdf->Cell(35, 5, number_format($row['cantidad'] * $row['precio'], 2, '.', ','), 0, 1, 'L');
            $contador++;
        }
        $pdf->Ln(3);
      
        // foreach ($encabezado as $value){
        // $pdf->SetFont('Arial', 'B', 10);
        // $pdf->Cell(167, 5, utf8_decode('Total:'),30,0, 0, 0, 'L');
        // $pdf->SetFont('Arial', '', 10);
        // $pdf->Cell(60, 5, utf8_decode($value['montoTotal']), 0, 1, 'L');
       
        // }
      
        $pdf->Ln(160);
        // $pdf->Cell(100, 5, utf8_decode('pagina 1/1'),30,0, 0, 0, 'L');
        $pdf->Output("poliza.pdf", "I");
        }else{
            if(isset($_SESSION['idDependencia'])){
             
            
            $this->getView()->anio = $this->getModel()->Anio();
             $this->getView()->dependencia = $this->getModel()->Dependencia();
               $pagina = 'reportes/reporteRegistroPago';
               $this->getView()->loadView($pagina);
            }else {
                $pagina = 'inicio/login';
                $this->getView()->loadView($pagina);
            }
        }

}

}
?>