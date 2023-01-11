<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="<?=constant('URL')?>public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="<?=constant('URL')?>public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </head>
<body>
    <?php
        require_once 'views/header.php';
    ?>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-lg-10 mt-4">
                <div class="card mt-4">
                    <div class="card-header text-white" style="background-color: #313945;">
                        <h5>Ingrese los siguientes datos para generar reporte</h5>
                    </div>
                    <div class="card-body">                    
                        <form action="<?=constant('URL')?>reportes/pdfPago" method="POST" target="_blank">                
                            <div class="row">
                            <?php
                                           if($_SESSION['idRoles']==1 || $_SESSION['idRoles']==3){
                                        ?>
                            <div class="col-6">
                                    Dependencia
                                    <select class="form-control" name="sDependencia" id="sDependencia" required>
                                        <option></option>    
                                        <?php
                                            foreach ($this->dependencia as $value) {
                                        ?>
                                        <option value="<?=$value['idDependencia']?>"><?=$value['nom_dependencia']?></option> 
                                        <?php
                                            }
                                        ?>                                                       
                                    </select>
                                </div>
                                <?php
                                            }
                                        ?>   
                            <div class="col-6">
                                    Unidad
                                    <select class="form-control" name="sUnidad" id="sUnidad" required>
                                        <option></option>    
                                        <?php
                                            foreach ($this->unidad as $value) {
                                        ?>
                                        <option value="<?=$value['idUnoperativa']?>"><?=$value['nom_unoperativa']?></option> 
                                        <?php
                                            }
                                        ?>                                                       
                                    </select>
                                </div>
                                <div class="col-6">
                                    Año
                                    <select class="form-control" name="txtAnio" required>
                                        <option></option>    
                                        <?php
                                            foreach ($this->anio as $value) {
                                        ?>
                                        <option value="<?=$value['idEjercicio']?>"><?=$value['anio']?></option> 
                                        <?php
                                            }
                                        ?>                                                       
                                    </select>
                                   
                                </div>
                                <div class="col-6">
                                    Meses
                                    <select class="form-control" name="sMeses" required>
                                        <option></option>    
                                        <?php
                                            foreach ($this->meses as $value) {
                                        ?>
                                        <option value="<?=$value['idMes']?>"><?=$value['mes']?></option> 
                                        <?php
                                            }
                                        ?>                                                       
                                    </select>
                                </div>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary mt-3"   style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;">Generar PDF</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        require_once 'views/footer.php';
    ?>
  <script>
        var url = "<?=constant('URL')?>";
    </script>.
 <script src="<?=constant('URL')?>public/js/reportes.js"></script>   
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
 <script src="<?=constant('URL')?>public/datajs//bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
  
    <script>
//    limpiar();
        $(".txtanio").val="";
        $(".sMeses").val="";
//         function limpiar(){
//             $(".txtanio").val('');
//         $(".sMeses").val('');
//         }
        
          
        
        
    </script>

</body>
</html>