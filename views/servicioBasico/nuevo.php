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


<form id="frmEncabezado" action="<?=constant('URL')?>servicioBasico/AgregarPoliza"  method="POST"  name="frmEncabezado">
<div class="row">

<input type="hidden"  class="form-control" name="hId" id="hId" value="0"  >
<div class="col-md-3">
        <label  >Nombre del encargado</label>
        <input type="text" name="txtNombre" id="txtNombre" class="form-control"  value="<?=$_SESSION['username']?>" disabled> <br>
        
        </div>

      
         
                   <div class=" col-md-3">
        <label>Numero de poliza</label>
        <?php if (!empty($this->num_poliza[0]["Contador"])==0): ?>
            <input type="text"  class="form-control" name="txtNumero" id="txtNumero"   value="1" readonly >
         
        <?php else: ?>
            <input type="text"  class="form-control" name="txtNumero" id="txtNumero"   value="<?= $this->num_poliza[0]["Contador"]+1?>" readonly >

            

        <?php endif ?>
        </div>  
        <div class=" col-md-3">
        <label>Ejercicio fiscal</label>
        <?php  if($this->anio) { ?>
            <input type="hidden" class="form-control" name="hanio" id="hanio" value="<?= $this->anio[0]["idEjercicio"]?>" readonly > 
      
        <input type="text" class="form-control" name="txtanio" id="txtanio" value="<?= $this->anio[0]["ano"]?>" readonly > 
        <?php } ?>
    </div>
        <div class="col-md-3">
        <label>Fecha de creacion</label>
        <input type="date"   class="form-control" name="dtFecha" id="dtFecha"  value="0000-00-00"  placeholder="yyyy-MM-dd" required>
        </div>
        <div class="col-md-3">
          <label for="">Suministrantes</label>             
          <select name="sSuministrante" id="sSuministrante" class="form-control" required>
             <option></option>
                 
             <?php
             
          foreach ($this->Suministrantes as $value) {
             ?>      
           <option value="<?=$value['idSuminis_SB']?>" ><?=$value['nom_suminist']?></option>
            <?php
               }
              ?>                                 
        
          </select>
          
         </div>

        


        
         <!-- Tipo de poliza -->
        <input type="hidden" name="txtTipoP" id="txtTipoP" value="1" class="form-control" readonly >
        
    
      
        
         
        <input type="hidden" name="txtEstado" id="txtEstado" value="1" class="form-control" readonly >
        
    
      
       
        </div>
        <div  >
          <!-- <button class="btn btn-info" onclick="Year_c()" name="btnAnio"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;" type="button">Cambiar Año</button> -->
        </div>


<hr>
<h5><i></i>Detalle Poliza</h5>
<hr>
                


                
                    <div class="row">
                        <input type="hidden" id="idPoliza" name="idPoliza" value="0">
                       
                        <div class="col-md-2">
                            
                    <label for="">Unidad Operativa</label>  
                    <select name="sUnidad" id="sUnidad" class="form-control" required>
                        <option></option>
                        <?php
                        foreach ($this->unidad as $value) {
                        ?>      
                        <option value="<?=$value['idUnoperativa']?>" ><?=$value['nom_unoperativa']?></option>
                        <?php
                        }
                        ?>  
                     
                         
                        </select>
                        
                        </div>
                   
                    <div class="col-md-2">
                    <label for="">No Medidor</label>             
                    <select name="sMedidores" id="sMedidores"  class="form-control" required>
                    <option></option>
                  
                                            
        
                    </select>
                   </div>
                    <div class="col-md-2">
                    <label for="">No Documento</label>  
                    <input type="number" id="txtDocumento" name="txtDocumento" class="form-control"  required>
                    </div>
                    <div class="col-md-2">
                    <label for="">Mes</label>  
                    <select name="sMes" id="sMes" class="form-control" required>
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
                    <input type="date" name="dFecha" id="dFecha" value="0000/00/00"  placeholder="yyyy/MM/dd" class="form-control" required>
                        </div>
                    <div class="col-md-2">
                    <label for="">Valor</label>  
                        <input type="number" step="0.01"  class="form-control" id="txtValor" name="txtValor" required>
                        </div>

                                  <div class="col-md-1">
                        <label for="">Acciones</label> 
                        <div class="input-group-append">
                            <button class="btn btn-primary btn-lg"  id="btnAgregar" >
                            <i class="bi bi-plus-lg"></i>
                            </button>
                        </div>
                    
                    </div>
                        </div>
                        
                   
                             
                              
                                <br>
                                <br>
                                <div class="table-responsive">
                <table class="table table-bordered" id="detalle">
               
                    <thead class="thead-dark text-white text-center">
                        <tr>
                        <th  style="display:none;">Id poliza</th>
                        <th  style="display:none;">IdMedidor</th>
                        <th >No Medidor</th>
                        <th >No Documento</th>
                        <th  style="display:none;">IdMes</th>
                        <th >Mes</th>
                        <th >Fecha</th>
                        <th >Valor</th>
                        
                        <th >Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tableProds" >

                       
                  
                    </tbody >
                    
                    
                </table>
                </div>

            <table>

            <div class="col-md-4">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">$</span>
                    </div>
                    <input type="text"  name="txt_total"  id="txt_total" class="form-control" readonly>
                </div>
            </div>
            </table>
                <div class="form-group">
             
<button class="btn btn-primary btn-sm" type="submit" id="btnGuardar"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  name="btnGuardar">Guardar Poliza</button>
<button class="btn btn-secondary btn-sm" type="button" id="btnSalir"  style="-webkit-border-radius:25px;-moz-border-radius:17px;padding:7px 20px;"  name="btnGuardar">Salir</button>

</form>
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

window.onload = function(){
    var fecha = new Date(); //Fecha actual
    var mes = fecha.getMonth()+1; //obteniendo mes
    var dia = fecha.getDate(); //obteniendo dia
    var ano = fecha.getFullYear(); //obteniendo año
    if(dia<10)
      dia='0'+dia; //agrega cero si el menor de 10
    if(mes<10)
      mes='0'+mes //agrega cero si el menor de 10
    document.getElementById('dtFecha').value=ano+"-"+mes+"-"+dia;
  }

    // function Year_c(){


    //      var txtYear = document.getElementById("txtanio");
    //      txtYear.value= parseInt(txtYear.value)+1;
         

    //     $.ajax({
    //         type: "POST",
    //         url: "<?=constant('URL')?>servicioBasico/NumPoliza",
    //         data: {year: txtYear.value},
    //         success: function(result){
    //             $("#txtNumero").val(result);
    //             // $("#txtanio").val(result);
    //         }
    //     })

    // }
</script>

</body>
</html>