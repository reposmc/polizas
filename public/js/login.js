$(document).ready(function(){

	fInicio()

	
});
function fInicio()
		{
		   loF=document.form1;
		   if (loF.txthacer.value=="2")
		   {
			  $("#entrar").bar({
			color 			 : '#1E90FF',
			background_color : '#FFFFFF',
			removebutton     : false,
			message			 : 'Usuario y/o Contraseña Invalido',
			time			 : 4000
		});   
		   }
		}


		