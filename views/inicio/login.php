
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../public/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>
<body  style="background-color: #9DB3E8; font-family:  sans-serif;">
    <div class="container">
        <div class="row align-items-center justify-content-center vh-100">
            <div class="col-lg-5 col-md-8 col-sm-8 card">
                <div class="card-body">
               
                    <div class="text-center">
                    <img src="../public/img/footer.png"  style=" width: 130px; height: 75px;">
                    </div>
                    <h5 style="text-align:center;">Ingresa tus datos para iniciar</h5>
                    <form action="<?=constant('URL')?>inicio/index" method="POST">
                    <div class="form-group">
                        
                        <input type="text" class="form-control" placeholder="Username" name="txtUsername">
                    </div>
                   <div class="form-group">
                   <input type="password" class="form-control" placeholder="Contraseña" name="txtContrasena">
                       
                   </div>
                       
                         <button class="btn btn-primary mt-2 btn-block btn-sm"  style=" -webkit-border-radius:25px;-moz-border-radius:17px;padding:8px 20px;" id="entrar">ENTRAR</button>
                    </form>
                </div>                               
            </div> 
        </div>
    </div>
    <script>
        var url = "<?=constant('URL')?>";
    </script>.
<script src="<?=constant('URL')?>public/js/login.js"></script>
<script src="../public/datajs/jquery-3.3.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="../public/datajs/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>
</html>