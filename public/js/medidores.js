$(document).ready(function(){
    //   console.log('hola')
    $('#medidores').DataTable();
    $("#btnCancelar").click( function(){
        $(location).attr('href', "../medidores/index" );
    });
    $(".close").click(function(){
        $(location).attr('href', "../medidores/index" );
    });
 
    $("#sDepto").change(function(){
     
        selectUnidades($(this).val())}
        );

    $("#btnModal1").click(function(){
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });

    })
    

    // $("#modificar").click(function(){
    //     selectModal($(this).val())

    // })
        $('#frmMedidores').validetta({
            realTime: true,
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -3,
            onValid : function( event ) {
                 event.preventDefault(); // Will prevent the submission of the form
         
                 
                     var form = $("#frmMedidores");
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
                                    window.location = "../medidores/index";})
                             
                                 form[0].reset()
         
                             }else{
         
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Modificado',
                                    text: 'Este dato se ha Modificado',
                                   
                                }).then(function() {
                                    window.location = "../medidores/index";})
        
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
  

        
        $("#txtNumeroMedidor").keyup(function(e){
    
            consulta = $("#txtNumeroMedidor").val();
           $("#estado").delay(1000).queue(function(n) {  
            $.ajax({
            url: url+'medidores/medidor',
            data:'txtNumeroMedidor='+consulta,
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
   

    function SeleccionarMedidores(){
    
        var contador =0;
        $('#medidores tbody tr').on('click', function(){
            $("#hId").val($(this).find('td:first').html());
           
            
            $(this).find('td').each(function(){
                
                switch (contador) {
                    case 1:
                    
             $("#txtNumeroMedidor").val($(this).html());
                        break; 
                case 2:
                    $("#txtDepto").val($(this).html());
                    $("#sDepto").val($(this).html());
                    
                    break;
                    case 4:
                    
                        $("#sUnidades").val($(this).html());
                        
                        break;
                    
                    case 6:
                    $("#sSuministrantes").val($(this).html()); 
                    break;
               
                default:
                    break;
            }
            
            contador=contador+1;
        });
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });
           
          });


        
    }
    