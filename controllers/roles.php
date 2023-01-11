<?php

class Roles extends Controller{
    public function __construct(){
        parent ::__construct();
 }
 public function index(){
    if(isset($_SESSION['idDependencia'])){
     $pagina = 'roles/index';
     $this->getView()->loadView($pagina);
    }else {
        $pagina = 'inicio/login';
        $this->getView()->loadView($pagina);
    }

}

public function mostrarRoles(){
    // // echo 'Función desde controlador';
    //     // Consulta a base de datos
        $datos = $this->getModel()->listadoRoles();
        // print_r($datos);
        $tr = '';
        foreach ($datos as $value) {
            
           
            $tr .= '<tr class="text-center">
                <td style="display:none;">'.$value['idRoles'].'</td>
                <td>'.$value['roles'].'</td>
                <td class="text-center">                             
                    <div class="btn-group">
                  
                        
                         
                    </div>
                </td>
            </tr>';
        }
        echo $tr;
    }
}

?>