<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de poliza</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=constant('URL')?>public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="<?=constant('URL')?>public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="<?=constant('URL')?>public/validetta/validetta.css" rel="stylesheet" type="text/css" media="screen" >
 </head>
<body  style="font-family:  sans-serif;">
    <?php
        require_once 'views/header.php';
     //   var_dump($_SESSION['idUnoperativa']);
    ?>
    <div class="container">
    <hr>

    <div class="modal fade" id="mdlAprobar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
           
            <form action="<?=constant('URL')?>servicioBasico/cambio" method="POST" id="cambio">
                <div class="modal-body">
                <input  type="hidden" name="txtId" id="txtId" value="" />
                <!-- <input  type="text" name="Nombre" id="Nombre" value="" /> -->

                    <input type="hidden" name="txtCambio" id="txtCambio" value="2" />
                    <h4>Seguro que desea finalizar esta poliza?</h4>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success" name="btnAprobar" id="btnAprobar">Aprobar</button>
                </div>
            </form>
        </div>
    </div>
</div>
                <h2 class="p-3">Listado de poliza</h2>
                
                <hr> 
                <div>
                <?php
                    if($_SESSION['idRoles']==2){
                        ?>
                <a href="<?=constant('URL')?>servicioBasico/nuevo"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  class="btn btn-primary mt-4">Nueva poliza</a>
                <?php
                    }
                        ?>
                <br>
            </div>
            <br>
             
         
            
         
            <div class="table-responsive">
           
                <table class="table table-bordered" id="encabezado" >
                    <thead class="text-white text-center" style="background-color: #313945;">
                        <tr>
                        <th style="display:none;">Id</th>
                        <th >Encargado</th>
                        <th >Suministrante</th>
                        <th >N° de poliza</th>
                        <th >año</th>
                        <th >Fecha</th>
                        <th >Estado</th>
                        <th >Tipo Poliza</th>
                        <th >Total</th>
                        <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody >
                    <?php
                    $contador=0;
                    foreach ($this->datos as $value){
                  
                       
            
                ?> 
                <?php $urlAgregando = constant('URL').'servicioBasico/agregar?idPoliza='.$value['idPoliza']; ?>
           
                <?php $urlReporte = constant('URL').'poliza/pdfPoliza?idPoliza='.$value['idPoliza']; ?>
                 <tr  class="text-center">
                
                
                    <td class="id" style="display:none;"><?php echo $value['idPoliza']; ?></td>
                    <td ><?php echo $value['nombre']; ?></td>
                    <td><?php echo $value['nom_suminist']; ?></td>
                    <td><?php echo $value['num_Poliza']; ?></td>
                    <td><?php echo $value['anio']; ?></td>
                    <td><?php echo $value['fec_crear']; ?></td>
                    <td><?php echo $value['tipo_Estado']; ?></td>
                    <td><?php echo $value['tipo_poliza']; ?></td>
                    <td><?php echo $value['montoTotal']; ?></td>
                        <td class="text-center">                             
                        <div class="btn-group">
                     <a href="<?php echo $urlReporte?>" <?php if ($value['tipo_Estado'] == 'Iniciado'){ ?> style="display: none;" <?php   } ?>><button   class="btn btn-primary btn-sm"><i class="bi bi-printer"> </i></button> </a> 
                     <?php
                    if($_SESSION['idRoles']==1 ||$_SESSION['idRoles']==2){
                        ?>
         
                        <a href="<?php echo $urlAgregando?>"   <?php if ($value['tipo_Estado'] == 'Finalizado'){ ?> style="display: none;" <?php   } ?> class="btn btn-dark btn-sm " id="btnOcultar <?=$contador?>"> Agregar</a> 
                       
                       
                        <button id="Finalizar<?=$contador?>"  <?php if ($value['tipo_Estado'] == 'Finalizado'){ ?> style="display: none;" <?php   } ?> data-toggle="modal"  data-target="#mdlAprobar" onclick="Poliza()"  class="btn btn-secondary btn-sm">
                      Finalizar
                  </button>
                       <?php

                        
                    }
                    ?>
            
            <?php

                        
}
?>
           
                 
                  
                  
                 </div>
            </td>
                </tr>
              
              
                    </tbody>
                </table>
                
                </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br>
    <?php
        require_once 'views/footer.php';
    ?>
    <script>
        var url = "<?=constant('URL')?>";
    </script>
    <script src="<?=constant('URL')?>public/js/servicioBasico.js"></script>
<script src="<?=constant('URL')?>public/datajs/sweetalert2@11.js"></script>
<script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
<script src="<?=constant('URL')?>public/validetta/validetta.js"></script>
<script src="<?=constant('URL')?>public/validetta/validettaLang-es-ES.js"></script>
<script src="<?=constant('URL')?>public/datajs/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
   <link href="<?=constant('URL')?>public/css/jquery.dataTables.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/js/jquery.dataTables.min.js"></script>
 <script>

$('#encabezado').DataTable();
</script>
</body>
</html>