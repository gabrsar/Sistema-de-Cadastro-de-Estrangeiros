/* Autor: Victor Hugo Cândido de Oliveira
 * Script que valida imagem quando o elemento é modificado
 */

$(document).ready(function() {
	var input = document.getElementById('foto');

	input.onchange = function () {
		if(validate()==false) {
			this.value = null;
		}
	};
});

function validate() {
	//check whether browser fully supports all File API
	if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		/*if( !$('#foto').val()) //check empty input filed
		{
			$("#register-form_foto_errorloc").html("Are you kidding me?");
			return false;
		}*/

		var fsize = $('#foto')[0].files[0].size; // gets file size
		var ftype = $('#foto')[0].files[0].type; // gets file type
		var fname = $('#foto')[0].files[0].name; // gets file name
		var maxSize = getMaxSize(); // Allowed file size is less than max size;

		//allow only valid image file types
		switch(ftype)
		{
			case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg': case 'image/bmp':
				var name = fname.split(".");
				if(name[0] + '.' + name[name.length-1] != fname) {
					$("#register-form_foto_errorloc").html("Tipo de arquivo não suportado. Por favor, selecione uma imagem.");
					return false;
				}
				break;
			default:
				$("#register-form_foto_errorloc").html("Tipo de arquivo não suportado. Por favor, selecione uma imagem.");
				return false;
		}
		
		if(fsize>maxSize)
		{
			$("#register-form_foto_errorloc").html(bytesToSize(fsize) +"Arquivo muito grande. Por favor, reduza o tamanho da imagem.<br>Máximo de "+ bytesToSize(maxSize));
			return false;
		}

		$("#register-form_foto_errorloc").html("");
	}
	else
	{
		//Output error to older browsers that do not support HTML5 File API
		$("#register-form_foto_errorloc").html("Alguns itens que precisamos estão faltando. Por favor, atualize o seu browser.");
		return false;
	}
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
	var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
	if (bytes == 0) return '0 Bytes';
	var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
	return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}

function getMaxSize() {
	var maxSize = 5242880;
	return maxSize;
}