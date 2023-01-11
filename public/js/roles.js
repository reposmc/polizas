$(document).ready(function(){
    mostrarRoles()
    
})
function mostrarRoles(){
    $.ajax({
        type: 'POST',
        url : url+'roles/mostrarRoles',
        success: function(response){
        //  console.log(response)
         $("#roles tbody").html(response)
        },
        error : function(){
                console.log('error')
        }
    })
} 