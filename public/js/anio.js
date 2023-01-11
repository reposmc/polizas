$(document).ready(function(){
    //   console.log('hola')
    $('#anio').DataTable();
    $("#btnCancelar").click( function(){
        $(location).attr('href', "../anio/index" );
    });
    $(".close").click(function(){
        $(location).attr('href', "../anio/index" );
    });
   
    $("#btnModal1").click(function(){
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });

    })
        $('#frmAnio').validetta({
            realTime: true,
            bubblePosition: 'bottom',
            bubbleGapTop: 6,
            bubbleGapLeft: -3,
            onValid : function( event ) {
                 event.preventDefault(); // Will prevent the submission of the form
                 let form = event.target;

                 swal.fire({
                     title: '¿Estas seguro que quieres cambiar año?',
                     type: 'warning',
                     showCancelButton: true,
                     confirmButtonColor: '#3085d6',
                     cancelButtonColor: '#d33',
                     cancelButtonText: 'No',
                     confirmButtonText: '¡Si, cambiar año!'
                 }).then((result) => {
                 if (result.value) {
                    // form.submit();
                     var form = $("#frmAnio");
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
                                window.location = "../anio/index";})
                           
                          
                                form[0].reset()
                        }else{
                           Swal.fire({
                               icon: 'success',
                               title: 'Modificado',
                               text: 'Este dato se ha Modificado',
                               
                           }).then(function() {
                            window.location = "../anio/index";})
    
                        }
                    } 
                    
                })
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

    $("#txtAnio").keyup(function(e){
    
        consulta = $("#txtAnio").val();
       $("#estado").delay(1000).queue(function(n) {  
        $.ajax({
        url: url+'anio/anio',
        data:'anio='+consulta,
        method: "POST",
        success:function(respuesta){
            $("#estado").html(respuesta);
            n();
        },
        error:function (){
            alerta("no existe");
        }
        });
    });
    });


    function SeleccionarDireccion(){
        var contador =0;
        $('#anio tbody tr').on('click', function(){
            $("#hId").val($(this).find('td:first').html());
            
            $(this).find('td').each(function(){
                switch (contador) {
                
                    case 1:
                        $("#txtAnio").val($(this).html()); 
                        break;
                default:
                    break;
            }
            
            contador=contador+1;
        });
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });
           
          });
    }
    