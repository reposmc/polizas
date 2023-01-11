<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servicio Basicos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=constant('URL')?>public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="<?=constant('URL')?>public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="<?=constant('URL')?>public/validetta/validetta.css" rel="stylesheet" type="text/css" media="screen" >

</head>
<body  style="font-family:  sans-serif;">
<header>
<?php
        require_once 'views/header.php';
        ///var_dump($_SESSION['idUsuarios']) ;
    ?>
</header>
<div class="container">

<hr>
<h5>Poliza de Servicios Basicos </h5>
<hr>
</br >
<?php
                    $encabezado = $this->encabezado;
                    
                    // print_r($producto);
                ?>

<form id="frmEncabezados" action="<?=constant('URL')?>servicioBasico/agregar"  method="POST"  name="frmEncabezados">
<div class="row">

<input type="hidden"  class="form-control" name="txtId" id="txtId" value="<?=$encabezado[0]['idPoliza']?>"  >
<div class="col-md-3">
        <label  >Nombre del encargado</label>
        <input type="text" name="txtNombre" id="txtNombre" class="form-control"  value="<?=$encabezado[0]['nombre']?>" disabled> <br>
        
        </div>
        <input type="hidden" name="hSuministrante" id="hSuministrante" class="form-control"  value="<?=$encabezado[0]['idSuminis_SB']?>" readonly> <br>
        
                   <div class=" col-md-3">
        <label>Numero de poliza</label>
            <input type="text"  class="form-control" name="txtNumero" id="txtNumero"   value="<?=$encabezado[0]['num_Poliza']?>" readonly >

    
        </div>  
        <div class=" col-md-3">
        <label>Ejercicio fiscal</label>
        <input type="text"  class="form-control" name="txtanio" id="txtanio" value="<?=$encabezado[0]['anio']?>" readonly >
        </div>
       

        <div class="col-md-3">
        <label>Fecha de creacion</label>
        <input type="date"   class="form-control" name="dtFecha" id="dtFecha"  value="<?=$encabezado[0]['fec_crear']?>"  placeholder="yyyy-MM-dd" required>
        </div>

        <div class="col-md-3">
        
          <label for="">Suministrantes</label>             
          <select name="sSuministrante" id="sSuministrante" class="form-control" required>
             <option></option>
                 
             <?php
             
          foreach ($this->Suministrantes as $value) {
             ?>   
             <option value="<?=$value['idSuminis_SB']?>" <?=($value['idSuminis_SB']==$encabezado[0]['idSuminis_SB'])?'selected':'';?>><?=$value['nom_suminist']?></option>
                      
            <?php
               }
              ?>                                 
        
          </select>
          
                   </div>
      

        <input type="hidden" step="0.01" name="txttotal"  id="txttotal" class="form-control" readonly>
      </form>
       
        </div>
     

<hr>
<h5><i></i>Detalle Poliza</h5>
<hr>
<form id="frmdetalle" action="<?=constant('URL')?>servicioBasico/detalle"  method="POST"  name="frmdetalle">

                
                    <div class="row">
                   
                    <!-- <input type="hidden" id="hId" class="form-control" name="hId" value="0"> -->
                    <!-- idpoliza -->
                    <input type="hidden" id="txtidPoliza" class="form-control" name="txtidPoliza" value="<?=$encabezado[0]['idPoliza']?>">
                   
                    <div class="col-md-2">
                    <label for="">Unidad Operativa</label>  
                    <select name="sUnidad" id="sUnidad" class="form-control" required>
                        <option></option>
                        
                        <?php
                        foreach ($this->UnidadOP as $value) {
                        ?>      
                        <option value="<?=$value['idUnoperativa']?>" ><?=$value['nom_unoperativa']?></option>
                        <?php
                        }
                        ?> 
                        </select>
                        </div>
                    
                    <div class="col-md-2">
                    <label for="">No Medidor</label>             
                    <select name="sMedidores" id="sMedidores" class="form-control"  data-validetta="required">
                    <option></option>
        
                    </select>
                   </div>
                    <div class="col-md-2">
                    <label for="">No Documento</label>  
                    <input type="number" id="txtDocument" name="txtDocument" class="form-control"  data-validetta="required" >
                    </div>
                    <div class="col-md-2">
                    <label for="">Mes</label>  
                    <select name="sMeses" id="sMeses" class="form-control"  data-validetta="required" >
                        <option></option>
                        
                        <?php
                        foreach ($this->mes as $value) {
                        ?>      
                        <option value="<?=$value['idMes']?>" ><?=$value['mes']?></option>
                        <?php
                        }
                        ?>  
                        </select>
                        </div>
                        <div class="col-md-2">
                        <label for="">fecha</label>  
                    <input type="date" name="dFechas" id="dFechas" value="0000/00/00"  placeholder="yyyy/MM/dd" class="form-control"  data-validetta="required">
                        </div>
                    <div class="col-md-2">
                    <label for="">Valor</label>  
                        <input type="number" step="0.01"  class="form-control" id="txtValors" name="txtValors"  data-validetta="required"/>
                        </div>

                                  <div class="col-md-1">
                        <label for="">Acciones</label> 
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-lg"  id="btnSeguir" type="submit" name="btnSeguir">
                            <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    
                    </div>
                        </div>
                        
                        
                                    
                        </form>        
                                <br>
                                <br>
                                <div class="table-responsive">

                <table class="table table-bordered" id="detalle">
               
                    <thead class="thead-dark text-white text-center">
                        <tr>
                        <th style="display:none;">Id Detalle</th>
                        <th style="display:none;">Id poliza</th>
                        <th style="display:none;">IdMedidor</th>
                        <th >No Medidor</th>
                        <th >No Documento</th>
                        <th  style="display:none;">IdMes</th>
                        <th >Mes</th>
                        <th >Fecha</th>
                        <th >Valor</th>
                        
                        <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="table" >
                    <?php
             
             foreach ($this->detalle as $value) {
                ?> 
                  <?php $eliminar = constant('URL').'servicioBasico/eliminar?idPoliza_SB='.$value['idPoliza_SB']; ?>
                <tr  class="text-center">
                       <td style="display:none;"><?php echo $value['idPoliza_SB']; ?></td>
                       <td style="display:none;"><?php echo $value['idPoliza']; ?></td>
                       <td style="display:none;"><?php echo $value['idMedidor'];  ?></td>
                       <td><?php echo $value['num_Medidor']; ?></td>
                       <td><?php echo $value['num_doc_resp']; ?></td>
                       <td><?php echo $value['mes']; ?></td>
                       <td><?php echo $value['fecha_doc']; ?></td>
                       <td><?php echo $value['valor_doc']; ?><input type="text"  value="<?php echo $value['valor_doc']; ?>" name="valor[]" hidden></td>
                       <td> <a href="<?php echo $eliminar?>" class="btn btn-danger btn-sm s"   id="btnEliminar"> x </a></td>
                       </tr>
                       <?php
             
             }
                ?> 
                    </tbody >
                    
                    
                </table>
               

            <table>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text" step="0.01" name="txt_total"  id="txt_total" class="form-control" readonly>
                </div>
            </div>
            </table>
            </div>
                <div class="form-group">
             
<button class="btn btn-primary btn-sm" type="submit" id="btnGuardarEdit"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  name="btnGuardar">Guardar Poliza</button>

<button class="btn btn-secondary btn-sm" type="button" id="btnSalir"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  name="btnGuardar">Salir</button>


</div>
  </div>

            
       <br><br><br><br><br><br><br><br><br><br>
       <br><br><br><br><br><br><br><br><br><br>


<?php
        require_once 'views/footer.php';
    ?>
<script>
        var url = "<?=constant('URL')?>";
    </script>.
<script src="<?=constant('URL')?>public/js/servicioBasico.js"></script>
<script src="<?=constant('URL')?>public/datajs/sweetalert2@11.js"></script>
<script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
<script src="<?=constant('URL')?>public/validetta/validetta.js"></script>
<script src="<?=constant('URL')?>public/validetta/validettaLang-es-ES.js"></script>
<script src="<?=constant('URL')?>public/datajs/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>



<script>




</script>
</body>
</html>