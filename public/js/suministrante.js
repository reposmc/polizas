$(document).ready(function(){
     $('#suministrante').DataTable();
    //   console.log('hola')
    //alert()
    $("#btnCancelar").click( function(){
        $(location).attr('href', "../suministrante/index" );
    });
    $(".close").click(function(){
        $(location).attr('href', "../suministrante/index" );
    });

//  setTimeout(function(){
//     SeleccionarSuministrante();

//  },1000)
    $("#btnModal1").click(function(){
        $("#exampleModal").modal({ backdrop: 'static', keyboard: false });

    })
        $('#frmSuministrante').validetta({
            realTime: true,
            bubblePosition: 'bottom',
            bubbleGapTop: 10,
            bubbleGapLeft: -3,
            onValid : function( event ) {
                 event.preventDefault(); // Will prevent the submission of the form
         
                var form = $("#frmSuministrante");
                   var action = form.attr('action')
                  var data = form.serialize()
            //   console.log(data);
                     
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
                                    window.location = "../suministrante/index";})
                                 
                                 form[0].reset()
         
                             }else{
                                
                                 Swal.fire({
                                     icon: 'success',
                                     title: 'Modificado',
                                     text: 'Este dato se ha Modificado',
                                    
                                 }).then(function() {
                                    window.location = "../suministrante/index";})
         
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



// ]var suma=0;
function SeleccionarSuministrante(){
    // $('#suministrante tr:gt(0)').each(function(){
    //     console.log($('td:first', $(this)).html());
    //     suma=suma + parseFloat($('td:first', $(this)).html()) ;
    //   ;
    // });
    // console.log("____________________")
    // console.log(suma)
    var contador =0;
    $('#suministrante tbody tr').on('click', function(){
        $("#hId").val($(this).find('td:first').html());
        
        $(this).find('td').each(function(){
            switch (contador) {
            case 1:
                $("#txtNombre").val($(this).html());
                break;
                case 2:
                    $("#sTipos").val($(this).html()); //change por si al caso
                    break;
           
            default:
                break;
        }
        
        contador=contador+1;
    });
    $("#exampleModal").modal({ backdrop: 'static', keyboard: false });
       
      });
}
