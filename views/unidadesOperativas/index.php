<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unidades Operativas</title>
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
<div class="container my-5">

<hr>
<h5>Unidades Operativas</h5>
<hr>
</br >
                <div class="row">
                 
                <div class="col-md-12">
<button type="button"  class="btn btn-primary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  data-toggle="modal" data-target="#exampleModal" id="btnModal1" >Agregar</button>
<br><br><br>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Unidades Operativas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=constant('URL')?>UnidadesOperativas/agregar" method="POST" id="frmUnidades">

        <input type="hidden" class="form-control" name="hId" id="hId" value=""  >
          <div class="form-group">
            <label  class="col-form-label"  >Nombre de Unidades Operativas:</label>
            <input type="text" class="form-control" name="txtNombre" id="txtNombre" data-validetta="required">
          </div>
         
          <div class="form-group">
            <label for="message-text" class="col-form-label">Departamento:</label>
           <select class="form-control" name="sDepartamento" id="sDepartamento" data-validetta="required"> 
           <option> </option>

           <?php

    foreach ($this->departamento as $value) {
    ?>      
        <option value="<?=$value['idDepto']?>" ><?=$value['nom_depto']?></option>
    <?php
    }
    ?>  
             

     </select>
      </div>
      
      <div class="form-group">
            <label for="message-text" class="col-form-label">Direcciones Nacionales:</label>
           <select class="form-control" name="sDnac" id="sDnac" data-validetta="required"> 
           <option> </option>

           <?php

    foreach ($this->direcciones as $value) {
    ?>      
        <option value="<?=$value['idDnac']?>" ><?=$value['nom_dnac']?></option>
    <?php
    }
    ?>  
             

     </select>
      </div>
      <?php
                    if($_SESSION['idRoles']==1){
                        ?>
      <div class="form-group"> 
    
            <label for="message-text" class="col-form-label">Dependencia:</label>
           <select class="form-control" name="sDependencia" id="sDependencia" data-validetta="required"> 
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

<?php
   if($_SESSION['idRoles']==2){
    ?>  
          <input type="hidden" class="form-control" name="sDependencia" id="sDependencia" value="<?=$_SESSION['idDependencia']?>" data-validetta="required">
             
             <?php
             
  }
    ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  data-dismiss="modal" id="btnCancelar">Cancelar</button>
        
        <button  class="btn btn-primary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  type="submit">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
            
<div class="table-responsive">

                <table class="table table-bordered" id="unidad">
                    <thead class=" text-white text-center" style="background-color: #313945;">
                        <tr>
                      
                        <th scope="col" style="display:none;">Id Unidades Operativas </th>
                        <th scope="col">Nombre de Unidades Operativas</th>
                        <th scope="col"  style="display:none;">IdDepartamento</th>
                        <th scope="col">Departamento</th>
                        <th scope="col"  style="display:none;">IdDnac</th>
                        <th scope="col">Direcciones Nacionales</th>
                        <th scope="col" style="display:none;">idDependencia</th>
                        <th scope="col">Dependencia</th>
                        <th scope="col">Acciones</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->datos as $value){
  
                ?> 
                 <tr  class="text-center" >

                  
            <td style="display:none;"><?php echo $value['idUnoperativa']; ?></td>
            <td><?php echo $value['nom_unoperativa']; ?></td>
            <td style="display:none;"><?php echo $value['idDepto']; ?></td>
            <td><?php echo $value['nom_depto']; ?></td>
            <td style="display:none;"><?php echo $value['idDnac']; ?></td>
            <td><?php echo $value['nom_dnac']; ?></td>
            <td style="display:none;"><?php echo $value['idDependencia']; ?></td>
            <td><?php echo $value['nom_dependencia']; ?></td>
            <td class="text-center">                             
                <div class="btn-group">
              
                    
                    <a href="" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="SeleccionarUnidades()"><i class="bi bi-pencil"></i></a> 
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
                            </div>
                            </div>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
                            <br>
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

  <script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
  <script src="<?=constant('URL')?>public/js/unidadesOperativas.js"></script>
  <script src="<?=constant('URL')?>public/datajs/sweetalert2@11.js"></script>
  <script src="<?=constant('URL')?>public/validetta/validetta.js"></script>
  <script src="<?=constant('URL')?>public/validetta/validettaLang-es-ES.js"></script>
  <script src="<?=constant('URL')?>public/datajs//bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  <link href="<?=constant('URL')?>public/css/jquery.dataTables.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/js/jquery.dataTables.min.js"></script>
</body>
</html>