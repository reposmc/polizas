<?php 
 class MedidoresModelo extends Model{
    private $idMedidor;
    private $num_Medidor;
    private $idUnoperativa;
    private $idSuminis_SB;
    
    public function __construct(){
        parent::__construct();
    
    }

    public function getIdMedidor(){
        return $this->idMedidor;
    }
    public function getNum_Medidor(){
        return $this->num_Medidor;
    }
    public function getIdUnoperativa(){
        return $this->idUnoperativa;
    }
    public function getIdSuminis_SB(){
        return $this->idSuminis_SB;
    }

    public function setIdMedidor($idMedidor){
        $this->idMedidor= $idMedidor;
    }
    public function setNum_Medidor($num_Medidor){
        $this->num_Medidor= $num_Medidor;
    }
    public function setIdUnoperativa($idUnoperativa){
        $this->idUnoperativa = $idUnoperativa;
    }
    public function setIdSuminis_SB($idSuminis_SB){
     $this->idSuminis_SB= $idSuminis_SB;
    }
    public function listadoMedidores($idUnoperativa){
        $arreglo = [];
        $sql = "         SELECT f.idMedidor,f.num_Medidor,m.idUnoperativa,m.idDependencia,m.nom_unoperativa,f.idSuminis_SB, p.nom_suminist,a.idDepto,a.nom_depto from MEDIDORES f
        INNER JOIN SUMINISTRANTES_SB p ON f.idSuminis_SB=p.idSuminis_SB
          INNER JOIN UNIDADES_OPERATIVAS m ON f.idUnoperativa=m.idUnoperativa
        INNER JOIN DEPARTAMENTOS a ON m.idDepto=a.idDepto where m.idDependencia=".$idUnoperativa."";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }

    public function listadoMedidor(){
        $arreglo = [];
        $sql = "         SELECT f.idMedidor,f.num_Medidor,m.idUnoperativa,m.nom_unoperativa,f.idSuminis_SB, p.nom_suminist,a.idDepto,a.nom_depto from MEDIDORES f
        INNER JOIN SUMINISTRANTES_SB p ON f.idSuminis_SB=p.idSuminis_SB
          INNER JOIN UNIDADES_OPERATIVAS m ON f.idUnoperativa=m.idUnoperativa
        INNER JOIN DEPARTAMENTOS a ON m.idDepto=a.idDepto";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
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
   
    public function listadoUnidades($idDependencia){
        $arreglo = [];
        $sql = "SELECT * FROM UNIDADES_OPERATIVAS where idDependencia=".$idDependencia."";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }


    public function listadoUnidad(){
        $arreglo = [];
        $sql = "SELECT * FROM UNIDADES_OPERATIVAS ";
        $datos = $this->getDb()->conectar()->query($sql);
        while($fila = $datos->fetch_object()){
            $arreglo[] = json_decode(json_encode($fila),true);
        }
        return $arreglo;
    }
    public function medidor($medidor){
        $arreglo = "";
        $sql = "SELECT idMedidor,num_Medidor FROM MEDIDORES
        WHERE num_Medidor='".$medidor."' ";
        $datos = $this->getDb()->conectar()->query($sql);
       
            while($fila = $datos->fetch_assoc()){
    
                $arreglo = $fila['idMedidor'];
            }
        return $arreglo;
               
          
        
    }
    public function me(){
        $arreglo = "";
        $sql = "SELECT * FROM MEDIDORES
        WHERE idMedidor=".$this->idMedidor;
        $datos = $this->getDb()->conectar()->query($sql);
       
            while($fila = $datos->fetch_assoc()){
    
                $arreglo = $fila['idMedidor'];
            }
        return $arreglo;
               
          
        
    }
    public function insertarMedidores(){
        $sql = "INSERT INTO MEDIDORES(idSuminis_SB,num_Medidor,idUnoperativa) 
        VALUES('".$this->idSuminis_SB."','".$this->num_Medidor."','".$this->idUnoperativa."')";
        $res = $this->getDb()->conectar()->query($sql);
        return ($res===TRUE)?true:false;
    }
    public function modificarMedidores(){
        $sql = "UPDATE MEDIDORES
        SET idSuminis_SB='".$this->idSuminis_SB."',num_Medidor='".$this->num_Medidor."',idUnoperativa='".$this->idUnoperativa.
        "' WHERE idMedidor=".$this->idMedidor;
        // print_r($sql).die();
        $res = $this->getDb()->conectar()->query($sql);
        return ($res===TRUE)?true:false;
    
    }

 }

?>