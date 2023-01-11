 <!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
<h5>Usuarios</h5>
<hr>
</br >
                <div class="row">
                 
                <div class="col-md-12">
<button type="button"  class="btn btn-primary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  data-toggle="modal" data-target="#exampleModal" id="btnModal1" >Agregar</button>
<br><br><br>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?=constant('URL')?>usuarios/agregar" method="POST" id="frmUsuarios">
        <div class="form-row">
        <input type="hidden" class="form-control" name="hId" id="hId" value="0"  >
        <div class="form-group col-md-6">
         <label for="message-text" class="col-form-label">Rol:</label>
          <select class="form-control" name="sRoles" id="sRoles" data-validetta="required"> 
          
                <option></option>
                <?php

                foreach ($this->roles as $value) {
          ?>      
              <option value="<?=$value['idRoles']?>"><?=$value['roles']?></option>
          <?php
          } ?>
            </select>
          </div>
          <div class="form-group col-md-6">
            <label  class="col-form-label"  >Nombre:</label>
            <input type="text" class="form-control" name="txtNombre" id="txtNombre" data-validetta="required">
          </div>
         
          <div class="form-group col-md-6" >
            <label for="message-text" class="col-form-label">Username:</label>
            <input type="text" class="form-control" name="txtUsername" id="txtUsername" data-validetta="required">
            <span id="estadousuario"></span> 
          </div>
           
           <div class="form-group col-md-6">
            <label for="message-text" class="col-form-label">Contraseña:</label>
            <input type="password" class="form-control" name="txtContrasena" id="txtContrasena" data-validetta="required" >
          </div> 
           <div class="form-group col-md-6">
            <label for="message-text" class="col-form-label">Correo:</label>
            <input type="text" class="form-control" name="txtCorreo" id="txtCorreo" data-validetta="email">
          </div>
    
         
          <div class="form-group col-md-6">
         <label for="message-text" class="col-form-label">Dependencia</label>
          <select class="form-control" name="sDependencia" id="sDependencia" data-validetta="required"> 
          
                <option></option>
              
                <?php

foreach ($this->dependencia as $value) {
?>      
<option value="<?=$value['idDependencia']?>"><?=$value['nom_dependencia']?></option>
<?php
} ?>
            </select>
          </div>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  id="btnCancelar">Cancelar</button>
       <button  class="btn btn-primary" style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  type="submit">Guardar</button>
      
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="col-md-12">
            
            
                   
<div class="table-responsive">
                <table class="table table-bordered" id="usuarios">
                    <thead class=" text-white text-center" style="background-color: #313945;">
                        <tr>
                      <!-- la posicion de id es 0 -->
                        <th scope="col"style="display:none;">IdUsuario</th> 
                        <th scope="col" style="display:none;">idRol</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Username</th>
                        <th scope="col">Contraseña</th>
                        <th scope="col">Correo</th>
                        <th scope="col" style="display:none;">idUnoperativa</th>
                        <th scope="col">Dependencia</th>
                        <th scope="col">Acciones</th>
                     
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($this->datos as $value){
  
                ?> 
                 <tr  class="text-center" >
               
               
                <td style="display:none;"><?php echo $value['idUsuarios']; ?></td>
                <td style="display:none;"><?php echo $value['idRoles']; ?></td>
                <td><?php echo $value['roles']; ?></td>
                <td><?php echo $value['nombre']; ?></td>
                <td><?php echo $value['username']; ?></td>
                <td><?php echo $value['contrasena']; ?></td>
                <td><?php echo $value['correo']; ?></td>
                <td style="display:none;"><?php echo $value['idDependencia']; ?></td>
                <td><?php echo $value['nom_dependencia']; ?></td>
                <td class="text-center">                             
                    <div class="btn-group">
                  
                        
                        <a class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="SeleccionarUsuarios()"><i class="bi bi-pencil"></i></a> 
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



                            <?php
        require_once 'views/footer.php';
    ?>                     

<script>
        var url = "<?=constant('URL')?>";
    </script>.
<script src="<?=constant('URL')?>public/js/usuarios.js"></script>
<script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
<script src="<?=constant('URL')?>public/datajs/sweetalert2@11.js"></script>
   <script src="<?=constant('URL')?>public/validetta/validetta.js"></script>
   <script src="<?=constant('URL')?>public/validetta/validettaLang-es-ES.js"></script>
    <script src="<?=constant('URL')?>public/datajs//bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <link href="<?=constant('URL')?>public/css/jquery.dataTables.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/js/jquery.dataTables.min.js"></script>
</body>
</html>