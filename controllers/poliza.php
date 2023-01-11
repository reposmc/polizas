<?php
require_once 'public/fpdf/fpdf.php';
class Poliza extends Controller{
    public function __construct(){
        parent::__construct();
    }
   
    
    public function pdfPoliza(){
     
      
       
    $pdf = new FPDF('P', 'mm', 'letter');
    $pdf->AliasNbPages();
   
   
    $pdf->AddPage();
    
    $pdf->SetFont('Times','',12);
  ;
    if(isset($_GET['idPoliza'])){
        $id = $_GET['idPoliza'];
            $this->getModel()->setIdPoliza($id);
           $encabezado = $this->getModel()->encabezado();
            $detalle = $this->getModel()->listadoDetalle();
    
            $pdf->Image("public/img/footer.png", 15, 10, 40, 25, 'PNG');
            $pdf->Ln(25);
            $pdf->SetFont('Arial', 'B', 15);
         
            $pdf->Cell(196, 5, utf8_decode("POLIZA DE CONCENTRACION DE OBLIGACIONES PARA LOS PAGOS DE"), 0, 1, 'C');
            $pdf->Cell(196, 5, utf8_decode(" SERVICIOS BASICOS"), 0, 1, 'C');
            $pdf->Ln(2);
    foreach ($encabezado as $value){
        //$pdf->Cell(195, 5, utf8_decode($value['nombre']), 0, 1, 'C');
        
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('Numero poliza:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['idPoliza']), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 5, utf8_decode('Año Fiscal:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(70, 5, utf8_decode($value['anio']), 0, 1, 'L');
       
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(40, 5, utf8_decode('Fecha de Poliza:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['fec_crear']), 0, 0, 'L');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(60, 5, utf8_decode('Suministrante:'), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(70, 5, utf8_decode($value['nom_suminist']), 0, 1, 'L');
    }
                $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(196, 5, "Detalle", 1, 1, 'C', 1);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(10, 5, utf8_decode('N°'), 0, 0, 'L');
        $pdf->Cell(90, 5, 'Unidad Operativa', 0, 0, 'L');
        $pdf->Cell(30, 5, utf8_decode('No Medidor'), 0, 0, 'L');
       
        $pdf->Cell(36, 5, 'No Documento', 0, 0, 'L');
        // $pdf->Cell(32, 5, 'Fecha', 0, 0, 'L');
        //  $pdf->Cell(32, 5, 'mes', 0, 0, 'L');
        $pdf->Cell(32, 5, 'Valor.', 0, 1, 'L');
        $pdf->SetFont('Arial', '', 10);
        $contador = 1;
        foreach ($detalle as $val) {
            $pdf->Cell(10, 5, $contador, 0, 0, 'L');
            $pdf->Cell(90, 5, $val['nom_unoperativa'], 0, 0, 'L');
            $pdf->Cell(30, 5, $val['num_Medidor'], 0, 0, 'L');
            
            $pdf->Cell(36, 5, $val['num_doc_resp'], 0, 0, 'L');
            // $pdf->Cell(32, 5, $val['fecha_doc'], 0, 0, 'L');
            //  $pdf->Cell(32, 5, $val['mes'], 0, 0, 'L');
            $pdf->Cell(32, 5, $val['valor_doc'], 0, 1, 'L');
            // $pdf->Cell(35, 5, number_format($row['cantidad'] * $row['precio'], 2, '.', ','), 0, 1, 'L');
            $contador++;
        }
        $pdf->Ln(3);
       
      
        foreach ($encabezado as $value){
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(167, 5, utf8_decode('Total:'),30,0, 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(60, 5, utf8_decode($value['montoTotal']), 0, 1, 'L');
       
        }
       
        $pdf->Output("poliza.pdf", "I");
}
}

}
?>