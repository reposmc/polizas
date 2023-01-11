<?php 
 class PolizaModelo extends Model{
    private $idPoliza;
    
    public function __construct(){
        parent::__construct();
    
    }
    public function getIdPoliza(){
        return $this->idPoliza;
    }
    public function setIdPoliza($idPoliza){
        $this->idPoliza = $idPoliza;
      }
    public function encabezado(){
        $arreglo = [];
        $sql = "SELECT a.idPoliza,b.idUsuarios,b.nombre,b.idDependencia,e.idSuminis_SB,e.nom_suminist,a.num_Poliza,f.idEjercicio,f.anio
        ,a.fec_crear,c.idEstado,c.tipo_Estado,d.idTip_Poliza,d.tipo_poliza,a.montoTotal FROM ENCABEZADO a
        inner join USUARIOS b ON a.idUsuarios=b.idUsuarios
        inner join SUMINISTRANTES_SB e ON a.idSuminis_SB=e.idSuminis_SB
        inner join ESTADOS c ON a.idEstado=c.idEstado
         inner join EJERCICIOS_FISCALES f ON a.idEjercicio=f.idEjercicio
        inner join TIPOS_DE_POLIZAS d ON a.idTip_Poliza=d.idTip_Poliza Where idPoliza=".$this->idPoliza."";
     //  var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }
    public function listadoDetalle(){
        $arreglo = [];
        $sql = "SELECT a.idPoliza_SB,a.idPoliza,b.idMedidor,b.num_Medidor,a.num_doc_resp,c.idMes,c.mes,a.fecha_doc,a.valor_doc,p.idUnoperativa,p.nom_unoperativa FROM POLIZA_SB a
        inner join MEDIDORES b ON a.idMedidor=b.idMedidor
        inner join UNIDADES_OPERATIVAS p ON b.idUnoperativa=p.idUnoperativa
        inner join MESES c On a.idMes=c.idMes where idPoliza=".$this->idPoliza."";
       //var_dump($sql);
       $datos = $this->getDb()->conectar()->query($sql);
            while($fila = $datos->fetch_assoc()){
                $arreglo[] = $fila;
            
            }
            return $arreglo;
    }

 }