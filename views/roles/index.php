<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roles</title>
    <link rel="stylesheet" href="<?=constant('URL')?>public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="<?=constant('URL')?>public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  </head>
<body  style="font-family:  sans-serif;">
<?php
        require_once 'views/header.php';
    ?>
<div class="container">

<hr>
<h5>Roles</h5>
<hr>
</br >

<div class="row">
<div class="table-responsive">
<table class="table table-bordered" id="roles">
                    <thead class="text-white text-center" style="background-color: #313945;">
                        <tr>
                      
                        <th scope="col" style="display:none;">IdRoles</th>
                        <th scope="col">Roles</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    
                </table>
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
                            
<?php
        require_once 'views/footer.php';
    ?>                     

<script>
        var url = "<?=constant('URL')?>";
    </script>.
 <script src="<?=constant('URL')?>public/js/roles.js"></script>   
 <script type="text/javascript" src="<?=constant('URL')?>public/datajs/jquery-latest.min.js"></script>
 <script src="<?=constant('URL')?>public/datajs//bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </body>
</html>