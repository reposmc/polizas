<?php 
 class ReportePagoModelo extends Model{
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
    public function encabezado($idDependencia,$idEjercicio){
        $arreglo = [];
        $sql = "  SELECT DISTINCT k.idDependencia,k.nom_dependencia,p.idEjercicio,p.anio FROM PAGOS_REINTEGROS a 
        INNER JOIN ENCABEZADO b ON a.idPoliza=b.idPoliza
        INNER JOIN TIPOS_DE_TRANSACCIONES c ON a.idTip_Transaccion=c.idTip_Transaccion
        INNER JOIN USUARIOS f ON b.idUsuarios=f.idUsuarios
        INNER JOIN DEPENDENCIAS k ON f.idDependencia=k.idDependencia
        INNER JOIN EJERCICIOS_FISCALES p ON b.idEjercicio=p.idEjercicio
        INNER JOIN  BANCOS d ON a.idBancos=d.idBancos WHERE f.idDependencia=".$idDependencia." AND p.idEjercicio=".$idEjercicio."";
        $datos = $this->getDb()->conectar()->query($sql);
      
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
      }
    public function listadoPago($idDependencia,$idEjercicio){
        $arreglo = [];
        $sql = "  SELECT a.idPago_Reint,b.idPoliza, b.num_Poliza,a.fechaPago,a.fechaActual,a.total,a.num_Documento,
        c.idTip_Transaccion,c.tipoTransacciones,d.idBancos,d.nomb_bancos,f.idUsuarios,f.idDependencia,p.idEjercicio,p.anio FROM PAGOS_REINTEGROS a 
        INNER JOIN ENCABEZADO b ON a.idPoliza=b.idPoliza
        INNER JOIN TIPOS_DE_TRANSACCIONES c ON a.idTip_Transaccion=c.idTip_Transaccion
        INNER JOIN USUARIOS f ON b.idUsuarios=f.idUsuarios
        INNER JOIN EJERCICIOS_FISCALES p ON b.idEjercicio=p.idEjercicio
        INNER JOIN  BANCOS d ON a.idBancos=d.idBancos WHERE f.idDependencia=".$idDependencia." AND p.idEjercicio=".$idEjercicio."";
        $datos = $this->getDb()->conectar()->query($sql);
      
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
      }

    

 }