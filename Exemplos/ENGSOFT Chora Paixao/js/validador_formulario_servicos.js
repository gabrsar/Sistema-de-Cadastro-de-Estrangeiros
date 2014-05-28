function validar_formulario()
{
	
	var placa		= document.getElementsByName("servico_placa")[0];
	var chave		= document.getElementsByName("separar_chave")[0];
	var foto		= document.getElementsByName("fotos")[0];
	var vistoria	= document.getElementsByName("vistoria")[0];

	if( placa.value == 0 && chave.value == 0 && foto.value == 0 && vistoria.value == 0 )
	{
		alert("Você não selecionou o tipo de serviço desejado. Escolha pelo menos um entre:\nServiços de Placa,\nSeparar Chaves,\nFotos e\nVistoria");
	}
	else
	{
       document.cadastrarServico.submit();

	}


}
