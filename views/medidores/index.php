<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medidores</title>
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
<h5>Medidores</h5>
<hr>
</br >
               
                 
                <div class="col-xs-10">
<button type="button"  class="btn btn-primary" style=" -webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;" data-toggle="modal"  id="btnModal1" data-target="#exampleModal" >Agregar</button>
<br><br><br>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Medidores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=constant('URL')?>medidores/agregar" method="POST" id="frmMedidores">
          
      <input type="hidden" class="form-control" name="hId" id="hId" value="">

      <div class="form-group">
        <label class="col-form-label">Numero de Medidor</label>
        <input type="text"  class="form-control" name="txtNumeroMedidor" id="txtNumeroMedidor"   value=""  data-validetta="required">
        <span id="estado"></span> 
        </div>  

    
          
      <div class="form-group">
            <label  class="col-form-label"  >Unidades Operativas</label>
            <select class="form-control" name="sUnidades" id="sUnidades" data-validetta="required"> Tenes que poner nombre al campo por ejemplo name="sUnidades"
           <option> </option>
           <?php
          foreach ($this->unidades as $value) {
             ?>      
           <option value="<?=$value['idUnoperativa']?>" ><?=$value['nom_unoperativa']?></option>
            <?php
               }
              ?>   
     </select>
     </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Suministrantes Servicio Básico:</label>
           <select class="form-control" name="sSuministrantes" id="sSuministrantes" data-validetta="required"> 
           <option> </option>
           <?php
          foreach ($this->Suministrantes as $value) {
             ?>      
           <option value="<?=$value['idSuminis_SB']?>" ><?=$value['nom_suminist']?></option>
            <?php
               }
              ?>    

     </select>
      </div>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;" data-dismiss="modal" id="btnCancelar">Cancelar</button>
        <button type="submit" class="btn btn-primary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="table-responsive">
                <table class="table table-bordered" id="medidores">
                    <thead class="text-white text-center" style="background-color: #313945;">
                        <tr>
                      
                        <th scope="col" style="display:none;">IdMedidor </th>
                        <th scope="col">Numero de Medidor</th>
                        <th scope="col" style="display:none;" >idDepartamento</th>
                        <th scope="col">Departamentos</th>
                        <th scope="col" style="display:none;" >idUnoperativa</th>
                        <th scope="col">Unidades Operativas</th>
                        <th scope="col" style="display:none;">idSuminis_SB</th>
                        <th scope="col">Suministrante Servicios Básicos</th>
                        <th scope="col">Acciones</th>

                        </tr>
                    </thead>
                    <tbody>
                    <?php

                    
                    foreach ($this->datos as $value){

                       
            
                ?> 
                 <tr  class="text-center">
                 <?php $urlModal = constant('URL').'medidores/modificar?idMedidor='.$value['idMedidor']; ?>

                <td style="display:none;"><?php echo $value['idMedidor']; ?></td>
            <td><?php echo $value['num_Medidor']; ?></td>
            <td style="display:none;"><?php echo $value['idDepto']; ?></td>
            <td><?php echo $value['nom_depto']; ?></td>
            <td style="display:none;"><?php echo $value['idUnoperativa']; ?></td>
            <td><?php echo $value['nom_unoperativa']; ?></td>
            <td style="display:none;"><?php echo$value['idSuminis_SB']; ?></td>
            <td><?php echo $value['nom_suminist']; ?></td>
            <td class="text-center">                             
                <div class="btn-group">
             
                 <a href="<?php echo $urlModal?>" class="btn btn-dark btn-sm"  data-toggle="modal" data-target="#exampleModal" onclick="SeleccionarMedidores()"><i class="bi bi-pencil"></i></a> 
                </div>
            </td>
                </tr>
                <?php
             
            }
               ?> 
                    </tbody>
                    
                </table>
                </div>        
                            </div>
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
    </script>.
<script src="<?=constant('URL')?>public/js/medidores.js"></script>
<script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>

<script src="<?=constant('URL')?>public/datajs/sweetalert2@11.js"></script>

   <script src="<?=constant('URL')?>public/validetta/validetta.js"></script>
   <script src="<?=constant('URL')?>public/validetta/validettaLang-es-ES.js"></script>
    <script src="<?=constant('URL')?>public/datajs//bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="<?=constant('URL')?>public/css/jquery.dataTables.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/js/jquery.dataTables.min.js"></script>
</body>
</html>