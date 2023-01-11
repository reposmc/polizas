$(document).ready(function(){
    //   console.log('hola')
    $('#usuarios').DataTable();
    $("#btnCancelar").click( function(){
        $(location).attr('href', "../bancos/index" );
    });
    $(".close").click(function(){
        $(location).attr('href', "../bancos/index" );
    });
  
  
  
    
    
    $("#btnModal1").click(function(){
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });

    })
   
        $('#frmBanco').validetta({
            realTime: true,
            bubblePosition: 'bottom',
            bubbleGapTop: 6,
            bubbleGapLeft: -3,
            onValid : function( event ) {
                 event.preventDefault(); // Will prevent the submission of the form
         
                     var form = $("#frmBanco");
                    var action = form.attr('action')
                  var data = form.serialize()
                 
                     
                     $.ajax({
                         type: 'POST',
                         url : action,
                         data : data,
                         
                         success : function(data){
                        // alert(data);
                             if (data) {
    
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'Correcto',
                                     text: 'Registro ingresado correctamente',
                                  
                                 }).then(function() {
                                    window.location = "../bancos/index";})
                               
                              
                                    form[0].reset()
         
                             }else{
         
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Modificado',
                                    text: 'Este dato se ha Modificado',
                                  
                                }).then(function() {
                                    window.location = "../bancos/index";})
                               
         
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
    })


    
    

    function SeleccionarBanco(){
        var contador =0;
        $('#usuarios tbody tr').on('click', function(){
            $("#hId").val($(this).find('td:first').html());
            
            $(this).find('td').each(function(){
                switch (contador) {
                    //posicion 2 seria el id del rol depende de la tabla
                
                    case 1:
                        $("#txtNombre").val($(this).html()); 
                        break;
                    case 2:
                        $("#txtNumero").val($(this).html()); 
                         break;
                        case 3:
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
    