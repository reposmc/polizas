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
<body style="font-family:  sans-serif;">

<header>
<?php
        require_once 'views/header.php';
  
    ?>
</header>
<br>
<br>
<div style="display: flex;

	height: 300px;
	justify-content: center;
	align-items: center;
	" > <a><img  class="img-responsive center-block" style=" width:200px; height: 200px;" src="../public/img/servicio.png" alt=""></a>

<a>  <img  class="img-responsive center-block" style=" width:200px; height: 200px;" src="../public/img/fondo.png" alt=""></a>

  
</div>
   
<br> <br> <br> <br>
    <?php
        require_once 'views/footer.php';
    ?>
    <script src="../public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../public/datajs/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>