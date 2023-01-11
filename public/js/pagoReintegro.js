$(document).ready(function(){
  //  ]   total()
 $('#pagoR').DataTable();
  $("#btnCancelar").click( function(){
    $(location).attr('href', "../pagoReintegro/index" );
});
$(".close").click(function(){
    $(location).attr('href', "../pagoReintegro/index" );
});

$("#sDependencia").change(function(){
    
  selectPoliza($(this).val());
  selectBanco($(this).val());
}
    );
    $("#btnModal1").click(function(){
      $("#exampleModal").modal({ backdrop: 'static', keyboard: false });

  })
// SeleccionarPago();
    $("#sPoliza").change(function(){
      total($(this).val())}
      );

      $("#sBanco").change(function(){
        cuenta($(this).val())}
        );
      $('#frmPago').validetta({
        realTime: true,
        bubblePosition: 'bottom',
        bubbleGapTop: 10,
        bubbleGapLeft: -3,
        onValid : function( event ) {
             event.preventDefault(); // Will prevent the submission of the form
     
            var form = $("#frmPago");
               var action = form.attr('action')
              var data = form.serialize()
        //   console.log(data);
                 
                 $.ajax({
                     type: 'POST',
                       url : action,
                     data : data,
                     success : function(response){
                      //  console.log(response)
                         if (response) {
     
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Correcto',
                                 text: 'Registro ingresado correctamente',
                             }).then(function() {
                              window.location = "../pagoReintegro/index";})
                            
                             form[0].reset()
     
                         }else{
                            
                             Swal.fire({
                                 icon: 'success',
                                 title: 'Modificad0',
                                 text: 'Este dato ha sido Modificado',
                                
                             }).then(function() {
                              window.location = "../pagoReintegro/index";})
     
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
  

         
function total(){

  var total = $("#sPoliza option:selected").attr("data-id").split(',')[0];
  // document.getElementById("txtTotal").value=total;  
  

$("#txtTotal").val(total);

   
}

function cuenta(){

  var cuenta = $("#sBanco option:selected").attr("data-id").split(',')[0];
  // document.getElementById("txtTotal").value=total;  
  

$("#txtNumeroDocumento").val(cuenta);

   
}
  function SeleccionarPago(){
    var contador =0;
    $('#pagoR tbody tr').on('click', function(){
        $("#hId").val($(this).find('td:first').html());
        
        $(this).find('td').each(function(){
            switch (contador) {
            case 1:
                $("#sPoliza").val($(this).html());
                break;
              case 3:
                $("#dFechaPago").val($(this).html()); //change por si al caso
                break;
            case 4:
              $("#dFechaActual").val($(this).html()); //change por si al caso
              break;
              case 5:
                    $("#txtTotal").val($(this).html()); //change por si al caso
                    break;
              case 6:
                $("#txtNumeroDocumento").val($(this).html()); //change por si al caso
                break;
              case 8:
                $("#sTipo").val($(this).html()); //change por si al caso
                break;
                case 10:
                $("#sBanco").val($(this).html()); //change por si al caso
                break;
                case 12:
                  $("#sDependencia").val($(this).html()); //change por si al caso
                  break;
            default:
                break;
        }
        
        contador=contador+1;
    });
    $("#exampleModal").modal({ backdrop: 'static', keyboard: false });
       
      });
    } 
	
    function selectPoliza(idDependencia) {


      
        $.ajax({
          url: url+'pagoReintegro/poliza',
          method: "POST",
          data: {
            "idDependencia":idDependencia
          
          },
          success: function(respuesta){
            //console.log(respuesta);
            
            $("#sPoliza").attr("disabled", false);
            $("#sPoliza").html(respuesta);
            // console.log(respuesta);
            
            
          },
          error:function(error){
              alert(error);
          },
        })
      }
      function selectBanco(idDependencia) {


      
        $.ajax({
          url: url+'pagoReintegro/banco',
          method: "POST",
          data: {
            "idDependencia":idDependencia
          
          },
          success: function(respuesta){
            //console.log(respuesta);
           
            $("#sBanco").attr("disabled", false);
            $("#sBanco").html(respuesta);
            // console.log(respuesta);
            
            
          },
          error:function(error){
              alert(error);
          },
        })
      }
 
 