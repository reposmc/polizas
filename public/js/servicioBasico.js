var conta=0;
$(document).ready(function(){

 
  calcTotal();

 
   
  $("#btnSalir").click( function(){
    $(location).attr('href', "../servicioBasico/index" );
});
  
      $("#sUnidad,#sSuministrante").change(function(){
     
        selectMedidores($(this).val())}
       
        );
        
      $("#sDependencia").change(function(){
     
        selectUnidad($(this).val())}
       
        );
      

      $(document).on('click', '#btnGuardarEdit', function () {
        // num()

           var form = $("#frmEncabezados");
           var action = form.attr('action')
           var data = form.serialize()
           console.log(data);
             
             $.ajax({
                 type: 'POST',
                   url : action,
                 data : data,
                 
                 success : function(response){
 
                  
                 }, error : function(){
                  alert('error')
          }
                 
             })
             $(location).attr('href', "../servicioBasico/index" );
      
      });

    
$("#btnAprobar").click(function(e){
        e.preventDefault()
       
        var form = $('#cambio')
        var method = form.attr('method')
        var action = form.attr('action')
        var data = form.serialize()
        
        $.ajax({
            type : method,
            url : action,
            data: data,
           
            success : function(response){
             
              
               location.reload();
            form[0].reset()

              
            }, 
            error : function(response){
                alert('Error en el ajax')
            }
        })
      //  }
    
      
    })
  
    $('#frmdetalle').validetta({
      realTime: true,
      display : 'inline',
      errorTemplateClass : 'validetta-inline',
      onValid : function( event ) {
           event.preventDefault()


           var form = $("#frmdetalle");
           var action = form.attr('action')
         var data = form.serialize()
        
                   $.ajax({
                       type: 'POST',
                       url : action,
                       data : data,
        
      
           
            success : function(response){
              // alert(data)
              location.reload();
              form[0].reset()
              
            }, 
            error : function(response){
                alert('Error en el ajax')
            }
        })
        
    }
  })
     



     
     



      $(document).on('click', '#btnGuardar', function () {
         

        var form = $("#frmEncabezado");
           var action = form.attr('action')
          var data = form.serialize()
   
             
             $.ajax({
                 type: 'POST',
                   url : action,
                 data : data,
                 
                 success : function(response){
                   
                 
                $(location).attr('href', "../servicioBasico/index" );
                  
                 }, error : function(){
                  console.log('error')
          }
                 
             })
            
      
      });

     
   
      //POLIZA

      $(document).on('click', '#btnAgregar', function () {
      
          conta++;
          var medidor = $("#sMedidores option:selected").text();
          var idMedidor = $("#sMedidores option:selected").val();
          var txtDocumento=document.getElementById("txtDocumento").value;
          var mes = $("#sMes option:selected").text();
          var idMes = $("#sMes option:selected").val();
          var dFecha=document.getElementById("dFecha").value;
          var txtValor=document.getElementById("txtValor").value;
         
  
          if ( (medidor=="") || (txtDocumento=="") ||(mes=="") || (dFecha=="") || (txtValor=="")){
           
          
        }
         else {
         
       
          var html = `<tr class="text-center">
        <td id="${conta}" name="id" hidden></td>
        <td>
            ${medidor}
            <input type="text" value="${idMedidor}" name="medidor[]" id="medidor" hidden>
        </td>
        <td>
            ${txtDocumento}
            <input type="text" value="${txtDocumento}" name="documento[]" id="documento" hidden>
        </td>
        <td>
            ${mes}
            <input type="text" value="${idMes}" name="mes[]" id="mes" hidden>
        </td>
        <td>
         ${dFecha}
        <input type="text" value="${dFecha}" name="fecha[]" id="fecha" hidden>
        </td>
        <td>
        ${txtValor}
        
        <input type="text"  value="${txtValor}" name="valor[]" hidden>
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm btnDelPol"   id="${conta}">X</button>
           
        </td>
    </tr>`;
    limpiar();
   
   }
    $("#tableProds").append(html);
       

calcTotal();
     
      
      
    });

    
    function limpiar(){
      $("#sMedidores").val('');
      $("#sUnidad").val('');
      $("#txtDocumento").val('');
      $("#sMes").val('');
      $("#dFecha").val('');
      $("#txtValor").val('');

    }

    $(document).on('click', '.btnDelPol', function () {
      var id = $(this).attr("id");
   

      $("#tableProds").find('td[id=' + id + ']').each(function () {
          $(this).parents("tr").remove();
      });
      calcTotal();
  });

  function calcTotal() {
      var precio = $("input[name='valor[]']").map(function () {
          return $(this).val();
      }).get();

      var total = 0;
      for (var i = 0; i < precio.length; i++) {
          total += parseFloat(precio[i]);
      }
      $("#txt_total").val(total);
      $("#txttotal").val(total);
  }
 
  

  $('body').on('click', '#btnEliminar', function(e){
    e.preventDefault();
   
    var href = $(this).attr('href')
    // console.log(href)
    $.ajax({
        type : 'GET',
        url : href,
        success : function(response){
          // var mensaje = (response)?'eliminado':'Error al eliminar';
          // alert(mensaje)
          location.reload();
        }
        ,
            error : function(){
                alert('Error en el ajax')
            }
    })
})


  
     
   });


    
function selectMedidores() {
  var Unoperativa = $("#sUnidad").val();
  var idSuminis_SB = $("#sSuministrante").val();

//  alert(Unoperativa);
	$.ajax({
		url: url+'servicioBasico/medidor',
		method: "POST",
		data: {
			Unoperativa:Unoperativa,
      idSuminis_SB:idSuminis_SB
    
		},
		success: function(respuesta){
      console.log(respuesta);
			$("#sMedidores").attr("disabled", false);
			$("#sMedidores").html(respuesta);
      // console.log(respuesta);
      
      
		},
    error:function(error){
        alert(error);
    },
	})
}
var contador =0;
function Poliza(){

  $('#encabezado tbody tr').on('click', function(){
    
    $("#txtId").val($(this).find('td:first').html());
     
      $(this).find('td').each(function(){
        
          switch (contador) {
          case 1:
           
              $("#Nombre").val($(this).html());
              break;
      }
  
      contador=contador+1;
  });
  
  //$("#cambio").append(html);


    });
   
//     // mostrarDetalle();

}

// function selectUnidad(idDependencia) {


// alert(idDependencia);
// 	$.ajax({
// 		url: url+'servicioBasico/unidad',
// 		method: "POST",
// 		data: {
			
//       idDependencia:idDependencia
    
// 		},
// 		success: function(respuesta){
//       console.log(respuesta);
// 			$("#sUnidad").attr("disabled", false);
// 			$("#sUnidad").html(respuesta);
//       // console.log(respuesta);
      
      
// 		},
//     error:function(error){
//         alert(error);
//     },
// 	})
// }
 