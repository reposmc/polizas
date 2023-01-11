<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=constant('URL')?>public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="<?=constant('URL')?>public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="<?=constant('URL')?>public/validetta/validetta.css" rel="stylesheet" type="text/css" media="screen" >

  </head>
<body  style="font-family:  sans-serif;">
<?php
        require_once 'views/header.php';
    ?>
</header>
<div class="container">

<hr>
<h5>Registro de Pago de Servicio Basico</h5>
<hr>
</br >
<?php
                    if($_SESSION['idRoles']==1 ||$_SESSION['idRoles']==2){
                        ?>
                 
                <div class="col-xs-10">
<button type="button"  class="btn btn-primary" data-toggle="modal" style="-webkit-border-radius:26px;-moz-border-radius:26px;padding:10px 31px;" id="btnModal1" data-target="#exampleModal" >Agregar</button>
<br><br><br>
</div>
<?php
                    }
                        ?>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=constant('URL')?>pagoReintegro/agregar" method="POST" id="frmPago">
        <div class="form-row"> 
      <input type="hidden" class="form-control" name="hId" id="hId" value="0">
      <div></div>
      <?php
                    if($_SESSION['idRoles']==1){
                        ?>
      <div class="form-group col-md-6">
        <label class="col-form-label">Dependencia</label>
        <select class="form-control" name="sDependencia" id="sDependencia" data-validetta="required"> Tenes que poner nombre al campo por ejemplo name="sUnidades"
           <option> </option>
           <?php
         foreach ($this->dependencia as $value) {
         ?>      
        <option value="<?=$value['idDependencia']?>" ><?=$value['nom_dependencia']?></option>
        <?php
         }
         ?>  
     </select>
     </div> 
     <?php
                    }
                        ?> 
      <div class="form-group col-md-6">
        <label class="col-form-label">poliza</label>
        <select class="form-control" name="sPoliza" id="sPoliza"   data-validetta="required"> Tenes que poner nombre al campo por ejemplo name="sUnidades"
        <option value=""></option>
        
        <?php
         foreach ($this->poliza as $value) {
         ?>      
        <option value="<?=$value['idPoliza']?>" data-id="<?= $value["montoTotal"]?>"><?=$value['num_Poliza']?></option>
        <?php
         }
         ?>
         
     </select>
     
     
     </div>  
     <div class="form-group col-md-6" >
            <label  class="col-form-label" >Monto Total</label>
            
            <input type="text" class="form-control"  name="txtTotal" id="txtTotal" value=""  data-validetta="required" readonly>
            
        
     </div>
    
     
      <div class="form-group col-md-6">
            <label  class="col-form-label">Fecha actual</label>
            <input type="date" class="form-control" name="dFechaActual" id="dFechaActual" data-validetta="required">
          
     </div>
          <div class="form-group col-md-6">
            <label for="message-text" class="col-form-label">Fecha de pago:</label>
           
            <input type="date" class="form-control" name="dFechaPago" id="dFechaPago" data-validetta="required">
          
      </div>

      
      <div class="form-group col-md-6">
        <label class="col-form-label">Tipo de Transaccion</label>
        <select class="form-control" name="sTipo" id="sTipo" data-validetta="required"> Tenes que poner nombre al campo por ejemplo name="sUnidades"
           <option> </option>
           <?php
         foreach ($this->TipoTransaccion as $value) {
         ?>      
        <option value="<?=$value['idTip_Transaccion']?>" ><?=$value['tipoTransacciones']?></option>
        <?php
         }
         ?>  
     </select>
     </div>  
     <div class="form-group col-md-6">
        <label class="col-form-label">Banco</label>
        <select class="form-control" name="sBanco" id="sBanco" data-validetta="required"> Tenes que poner nombre al campo por ejemplo name="sUnidades"
           <option> </option>
           <?php
         foreach ($this->banco as $value) {
         ?>      
        <option value="<?=$value['idBancos']?>" data-id="<?= $value["num_cuenta"]?>" ><?=$value['nomb_Bancos']?></option>
        <?php
         }
         ?>  
     </select>
     </div>  
     <div class="form-group col-md-6">
            <label  class="col-form-label">Numero de documento</label>
            <input type="text" class="form-control"  name="txtNumeroDocumento"  readonly  id="txtNumeroDocumento" data-validetta="required">
            
        
     </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;" data-dismiss="modal" id="btnCancelar">Cancelar</button>
        <button type="submit" class="btn btn-primary"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;" type="submit" >Guardar</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>



<div class="table-responsive">
                <table class="table table-bordered" id="pagoR">
                    <thead class="text-white text-center" style="background-color: #313945;">
                        <tr>
                      
                        <th scope="col" style="display:none;">IdPago</th>
                        <th scope="col" style="display:none;">IdPoliza</th>
                        <th scope="col"> No Poliza</th>
                        <th scope="col">Fecha Pago</th>
                        <th scope="col"  >fechaActual</th>
                        <th scope="col">Monto Pagado</th>
                        <th scope="col"  >Numero Documento</th>
                        <th scope="col">Año</th>
                        <th scope="col" style="display:none;">idTipo de Transaccion</th>
                        <th scope="col">Tipo de Transaccion</th>
                        <th scope="col" style="display:none;">idBanco</th>
                        <th scope="col">Banco</th>
                        <th scope="col" style="display:none;">idDependencia</th>
                        <?php
                    if($_SESSION['idRoles']==2){
                        ?>
                        <th scope="col">Acciones</th>
                        <?php
                    }
                        ?>

                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->datos as $value){
  
                ?> 
                 <tr  class="text-center" >
                <td style="display:none;"><?php echo $value['idPago_Reint']; ?></td>
                <td style="display:none;"><?php echo $value['idPoliza']; ?></td>
                <td ><?php echo $value['num_Poliza']; ?></td>
                <td><?php echo $value['fechaPago']; ?></td>
                <td><?php echo $value['fechaActual']; ?></td>
                <td><?php echo $value['total']; ?></td>
                <td><?php echo $value['num_Documento']; ?></td>
             
                <td><?php echo $value['anio']; ?></td>
                <td style="display:none;"><?php echo $value['idTip_Transaccion']; ?></td>
                <td><?php echo $value['tipoTransacciones']; ?></td>
                <td style="display:none;"><?php echo $value['idBancos']; ?></td>
                <td><?php echo $value['nomb_bancos']; ?></td>
                <td style="display:none;"><?php echo $value['idDependencia']; ?></td>
                
                <?php
                    if($_SESSION['idRoles']==2){
                        ?>
            <td class="text-center">                             
                <div class="btn-group">
                
                <a class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#exampleModal"  <?php if($this->anios[0]["idEjercicio"]!=$value['idEjercicio']){ ?> style="display: none;" <?php   } ?> onclick="SeleccionarPago()"><i class="bi bi-pencil"></i></a> 
                
                </div>
            </td>
            </tr>
            <?php
                    }
                        ?>
                <?php
             
            }
               ?> 
                    </tbody>
                    
                </table>
                </div>         </div>
                           
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <?php
        require_once 'views/footer.php';
    ?>                     

<script>
        var url = "<?=constant('URL')?>";
    </script>
    <script src="<?=constant('URL')?>public/js/pagoReintegro.js"></script>

    <script src="<?=constant('URL')?>public/datajs/sweetalert2@11.js"></script>
<script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
<script src="<?=constant('URL')?>public/validetta/validetta.js"></script>
<script src="<?=constant('URL')?>public/validetta/validettaLang-es-ES.js"></script>
<script src="<?=constant('URL')?>public/datajs/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   <link href="<?=constant('URL')?>public/css/jquery.dataTables.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/js/jquery.dataTables.min.js"></script>
 <script>
   window.onload = function(){
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('dFechaActual').value=ano+"-"+mes+"-"+dia;
  }
 </script>
</body>
</html>