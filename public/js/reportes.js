$(document).ready(function(){
    $("#sDependencia").change(function(){
     
        selectDependencia($(this).val())}
       
        );

        $("#sDependencias").change(function(){
     
            selectMedidor($(this).val())}
           
            );
});
function selectDependencia(idDependencia) {

  
   
      $.ajax({
       
          url: url+'reportes/dependencia',
          method: "POST",
          data: {
              "idDependencia":idDependencia
      
          },
          success: function(respuesta){
     console.log(url);
              $("#sUnidad").attr("disabled", false);
              $("#sUnidad").html(respuesta);
        // console.log(respuesta);
        
        
          },
      error:function(error){
          alert(error);
      },
      })
  }
  

  function selectMedidor(idDependencia) {

  
    
       $.ajax({
        
           url: url+'reportes/medidor',
           method: "POST",
           data: {
               "idDependencia":idDependencia
       
           },
           success: function(respuesta){
      console.log(url);
               $("#sMedidor").attr("disabled", false);
               $("#sMedidor").html(respuesta);
         // console.log(respuesta);
         
         
           },
       error:function(error){
           alert(error);
       },
       })
   }
   