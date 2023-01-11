<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #313945;">
    <a class="navbar-brand" href="#">
    <img src="../public/img/MinisterioCultura.png" width="170" height="70">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">  
            <a class="nav-link" href="<?=constant('URL')?>inicio/index">Inicio</a>
            
          
            <?php
                    if($_SESSION['idRoles']==1|| $_SESSION['idRoles']==2 ||  $_SESSION['idRoles']==3 ){
                ?>
            <a class="nav-link" href="<?=constant('URL')?>servicioBasico/index">Poliza</a>
            <a class="nav-link" href="<?=constant('URL')?>pagoReintegro/index">Registro de Pago</a>
            <?php        
                    }
                ?>
            <?php
                    if($_SESSION['idRoles']==1 || $_SESSION['idRoles']==2){
                ?>
            <div class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown">
                  Mantenimientos                  
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #313945;">
            <a class="nav-link" href="<?=constant('URL')?>tipoSuministrante/index">Tipo de Suministrante         </a>
            <a class="nav-link" href="<?=constant('URL')?>suministrante/index">Suministrante                     </a>
            <a class="nav-link" href="<?=constant('URL')?>direccionNacional/index">Direcciones Nacionales        </a>
            <a class="nav-link" href="<?=constant('URL')?>departamento/index">Departamentos   </a>
            <a class="nav-link" href="<?=constant('URL')?>unidadesOperativas/index">Unidades Operativas </a>
            <a class="nav-link" href="<?=constant('URL')?>medidores/index">Medidores          </a> 
            <a class="nav-link" href="<?=constant('URL')?>bancos/index">Bancos          </a>
           
          
            <?php        
                    }
                ?>
                 <?php
                    if($_SESSION['idRoles']==1){
                ?>
            <a class="nav-link" href="<?=constant('URL')?>dependencia/index">Dependencia         </a>
            <a class="nav-link" href="<?=constant('URL')?>tipoTransaccion/index">Tipo de transaccion       </a>
            <a class="nav-link" href="<?=constant('URL')?>meses/index">Meses          </a>
                
            <a class="nav-link" href="<?=constant('URL')?>roles/index">Roles            </a>
                
            <a class="nav-link" href="<?=constant('URL')?>usuarios/index">Usuario           </a> 
            <a class="nav-link" href="<?=constant('URL')?>anio/index">Ejercicio Fiscal          </a>
            <?php        
                    }
                ?>
          
            </div>
           
            </div>
           
            <div class="nav-item dropdown">
                <a class="nav-link text-white dropdown-toggle" role="button" data-toggle="dropdown">
                 Reportes                                                   
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown" style="background-color: #313945;">
            <a class="nav-link text-white" href="<?=constant('URL')?>reportes/pdfPago">Informe Mensual de Pagos por Unidad Operativa</a>
            <a class="nav-link text-white" href="<?=constant('URL')?>reportes/pdfMedidor">Reporte por Numero de Medidor</a>
            <a class="nav-link text-white" href="<?=constant('URL')?>reportes/pdfTipo">Reporte Anual por Tipo de Suministrantes</a>
            <a class="nav-link text-white" href="<?=constant('URL')?>reportePago/pdfReportePago">Reporte de Registro de pago</a>

            </div>
           
            </div>
           
            <a class="nav-link text-white" href="<?=constant('URL')?>inicio/manual">Manual         </a>
            <a class="nav-link text-white" href="<?=constant('URL')?>inicio/salir">salir</a>
    </div>
</nav>