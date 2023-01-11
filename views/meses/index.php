<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?=constant('URL')?>public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="<?=constant('URL')?>public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    
    <title>Meses</title>
 

</head>
<body  style="font-family:  sans-serif;">
<?php
        require_once 'views/header.php';
    ?>

<div class="container">

<hr>
<h5>Meses</h5>
<hr>
</br >
<div class="table-responsive">
<table class="table table-bordered" id="datatable" >
                    <thead class="text-white " style="background-color: #313945;">
                   
                    
                    <tr>
                      
                        <th scope="col" style="display:none;">IdMes</th>
                        <th scope="col" >mes</th>

                        </tr>
                
                    </thead>
                    <tbody>
                    <?php
                    
                    foreach ($this->meses as $value){

                       
            
                ?> 
                 <tr  class="">
                <td style="display:none;"><?php echo $value['idMes']; ?></td>
                <td><?php echo $value['mes']; ?></td>
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
                            <br>
                            <br>
                            <br>
<?php
        require_once 'views/footer.php';
    ?>                     

<script>
        var url = "<?=constant('URL')?>";
    </script>

<script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
    <script src="<?=constant('URL')?>public/js/meses.js"></script> 
 
    <script src="<?=constant('URL')?>public/datajs//bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
 <link href="<?=constant('URL')?>public/css/jquery.dataTables.min.css" rel="stylesheet">
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/js/jquery.dataTables.min.js"></script>
</body>
</html>