<?php
class PagoReintegroModelo extends model{
private $idPago;
private $idPoliza;
private $fechapago;
private $fechaActual;
private $total;
private $num_Documento;
private $idTipoTransaccion;
private $idBanco;

  public function __construct(){
    parent::__construct();

}
public function getIdPago(){
  return $this->idPago;
}
public function getIdPoliza(){
  return $this->idPoliza;
}

public function getFechaPago(){
  return $this->fechaPago;
}

public function getFechaActual(){
  return $this->fechaActual;
}
public function getTotal(){
  return $this->total;
}
public function getNum_Documento(){
  return $this->num_Documento;
}
public function getIdTipoTransaccion(){
  return $this->idTipoTransaccion;
}

public function getIdBanco(){
  return $this->idBanco;
}


public function setIdPago($idPago){
  $this->idPago=$idPago;
}

public function setIdPoliza($idPoliza){
 $this->idPoliza= $idPoliza;
}

public function setFechaPago($fechaPago){
$this->fechaPago=$fechaPago;
}

public function setFechaActual($fechaActual){
$this->fechaActual=$fechaActual;
}
public function setTotal($total){
 $this->total= $total;
}
public function setNum_Documento($num_Documento){
  $this->num_Documento= $num_Documento;
 }
public function setIdTipoTransaccion($idTipoTransaccion){
 $this->idTipoTransaccion=$idTipoTransaccion;
}

public function setIdBanco($idBanco){
$this->idBanco= $idBanco;
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
public function listadoPoliza($idUsuario,$idEjercicio){
  $arreglo = [];
  $sql = "SELECT idPoliza, num_Poliza,montoTotal,idEjercicio idUsuarios FROM ENCABEZADO
   WHERE idEstado =2 and idUsuarios=".$idUsuario." AND idEjercicio=".$idEjercicio."";
  $datos = $this->getDb()->conectar()->query($sql);
  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}
public function listadoPago($idDependencia){
  $arreglo = [];
  $sql = "  SELECT a.idPago_Reint,b.idPoliza, b.num_Poliza,a.fechaPago,a.fechaActual,a.total,a.num_Documento,
  c.idTip_Transaccion,c.tipoTransacciones,d.idBancos,d.nomb_bancos,f.idUsuarios,f.idDependencia,p.idEjercicio,p.anio FROM PAGOS_REINTEGROS a 
  INNER JOIN ENCABEZADO b ON a.idPoliza=b.idPoliza
  INNER JOIN TIPOS_DE_TRANSACCIONES c ON a.idTip_Transaccion=c.idTip_Transaccion
  INNER JOIN USUARIOS f ON b.idUsuarios=f.idUsuarios
  INNER JOIN EJERCICIOS_FISCALES p ON b.idEjercicio=p.idEjercicio
  INNER JOIN  BANCOS d ON a.idBancos=d.idBancos WHERE f.idDependencia=".$idDependencia."";
  $datos = $this->getDb()->conectar()->query($sql);

  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}
public function listadoRegistroPago(){
  $arreglo = [];
  $sql = "  SELECT a.idPago_Reint,b.idPoliza, b.num_Poliza,a.fechaPago,a.fechaActual,a.total,a.num_Documento,
  c.idTip_Transaccion,c.tipoTransacciones,d.idBancos,d.nomb_bancos,f.idUsuarios,f.idDependencia,p.idEjercicio,p.anio FROM PAGOS_REINTEGROS a 
  INNER JOIN ENCABEZADO b ON a.idPoliza=b.idPoliza
  INNER JOIN TIPOS_DE_TRANSACCIONES c ON a.idTip_Transaccion=c.idTip_Transaccion
  INNER JOIN USUARIOS f ON b.idUsuarios=f.idUsuarios
  INNER JOIN EJERCICIOS_FISCALES p ON b.idEjercicio=p.idEjercicio
  INNER JOIN  BANCOS d ON a.idBancos=d.idBancos ";
  $datos = $this->getDb()->conectar()->query($sql);

  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}

public function listadoTipoTransaccion(){
  $arreglo = [];
  $sql = "SELECT idTip_Transaccion,tipoTransacciones FROM TIPOS_DE_TRANSACCIONES";
  $datos = $this->getDb()->conectar()->query($sql);
  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}

public function filtradoPago(){
  $arreglo = [];
  $sql = "  SELECT a.idPago_Reint,b.idPoliza, b.num_Poliza,a.fechaPago,a.fechaActual,a.total,a.num_Documento,
  c.idTip_Transaccion,c.tipoTransacciones,d.idBancos,d.nomb_bancos,f.idUsuarios,f.idDependencia,p.idEjercicio,p.anio FROM PAGOS_REINTEGROS a 
  INNER JOIN ENCABEZADO b ON a.idPoliza=b.idPoliza
  INNER JOIN TIPOS_DE_TRANSACCIONES c ON a.idTip_Transaccion=c.idTip_Transaccion
  INNER JOIN USUARIOS f ON b.idUsuarios=f.idUsuarios
  INNER JOIN EJERCICIOS_FISCALES p ON b.idEjercicio=p.idEjercicio
  INNER JOIN  BANCOS d ON a.idBancos=d.idBancos WHERE  a.idPago_Reint=".$this->idPago."";
  $datos = $this->getDb()->conectar()->query($sql);

  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}

public function insertarPago(){
  $sql = "INSERT INTO PAGOS_REINTEGROS(idPoliza,fechaPago,fechaActual,total,num_Documento,idTip_Transaccion,idBancos) 
  VALUES('".$this->idPoliza."','".$this->fechaPago."','".$this->fechaActual."','".$this->total."','".$this->num_Documento."','".$this->idTipoTransaccion."','".$this->idBanco."')";
  $res = $this->getDb()->conectar()->query($sql);
  return ($res===TRUE)?true:false;
}
public function listadoBanco(){
  $arreglo = [];
  $sql = "SELECT idBancos,nomb_Bancos,num_cuenta  FROM BANCOS";
  $datos = $this->getDb()->conectar()->query($sql);
  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}

public function listadoBancos($idDependencia){
  $arreglo = [];
  $sql = "SELECT idBancos,nomb_Bancos,num_cuenta,idDependencia  FROM BANCOS WHERE idDependencia=".$idDependencia."";
  $datos = $this->getDb()->conectar()->query($sql);
  while($fila = $datos->fetch_object()){
      $arreglo[] = json_decode(json_encode($fila),true);
  }
  return $arreglo;
}
public function modificarPago(){
  $sql = "UPDATE PAGOS_REINTEGROS
  SET idPoliza='".$this->idPoliza."', fechaPago='".$this->fechaPago."', fechaActual='".$this->fechaActual."', total='".$this->total.
  "',num_Documento='".$this->num_Documento."', idTip_Transaccion='".$this->idTipoTransaccion."',idBancos='".$this->idBanco.
  "' WHERE idPago_Reint=".$this->idPago;
  // print_r($sql).die();
  $res = $this->getDb()->conectar()->query($sql);
  return ($res===TRUE)?true:false;

}

}
?>