$(document).ready(function(){
    //   console.log('hola')
    $('#unidad').DataTable();
    $("#btnCancelar").click( function(){
        $(location).attr('href', "../unidadesOperativas/index" );
    });
    $(".close").click(function(){
        $(location).attr('href', "../unidadesOperativas/index" );
    });
  
    $("#btnModal1").click(function(){
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });

    })
        $('#frmUnidades').validetta({
            realTime: true,
            bubblePosition: 'bottom',
            bubbleGapTop: 10,
            bubbleGapLeft: -3,
            onValid : function( event ) {
                 event.preventDefault(); // Will prevent the submission of the form
         
                     var form = $("#frmUnidades");
                    var action = form.attr('action')
                  var data = form.serialize()
                 
                     
                     $.ajax({
                         type: 'POST',
                         url : action,
                         data : data,
                        
                         success : function(response){
         
                             if (response) {
         
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'Correcto',
                                     text: 'Registro ingresado correctamente',
                                    
                                 }).then(function() {
                                    window.location = "../unidadesOperativas/index";})
                             
                                 form[0].reset()
         
                             }else{
         
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Modificado',
                                    text: 'Este dato se ha Modificado',
                                   
                                }).then(function() {
                                    window.location = "../unidadesOperativas/index";})
        
                             }
                         } 
                         
                     })
         
               },
               onError : function( event ){
                 Swal.fire({
                     icon: 'error',
                     title: 'Error',
                     text: 'Por favor completa todos los campos del formulario',
                    
                 })
               }
             })
          //MODIFICAR 
          
        
      
    })
  
    function SeleccionarUnidades(){
    
        var contador =0;
        $('#unidad tbody tr').on('click', function(){
            $("#hId").val($(this).find('td:first').html());
            
            $(this).find('td').each(function(){
                
                switch (contador) {
                case 1:
                    
                    $("#txtNombre").val($(this).html());
                    break;
                    case 2:
                    $("#sDepartamento").val($(this).html());
                        break;
                        case 4:
                    $("#sDnac").val($(this).html());
                        break;
                case 6:
                $("#sDependencia").val($(this).html());
                                break;
                default:
                    break;
            }
            
            contador=contador+1;
        });
        
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });
           
          });
    }
    