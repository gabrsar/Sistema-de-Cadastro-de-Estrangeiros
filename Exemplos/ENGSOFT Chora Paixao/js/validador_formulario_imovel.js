function rws(str)
{
	return (str.replace(/\s+/g,''));
}

function irParaCampo(campo)
{
	campo.focus();
	window.scrollBy(0,-100);
}

function validarFormulario()
{
    var campo;

	campo = document.getElementsByName("idm")[0];
	if(Number(campo.value) != NaN && Number(campo.value) <= 0 )
	{
		alert("O campo IDM não possui um valor válido.");
		irParaCampo(campo);
		return;
	}

	campo = document.getElementsByName("corretor")[0];
	if(!rws(campo.value))
	{
		alert("O campo CORRETOR não está preenchido!");
		irParaCampo(campo);
		return;
	}

	campo = document.getElementsByName("logradouro")[0];
	if(!rws(campo.value))
	{
		alert("O campo LOGRADOURO não está preenchido!");
		irParaCampo(campo);
		return;
	}


	n	= document.getElementsByName("numero")[0];
	q   = document.getElementsByName("quadra")[0];
	l	= document.getElementsByName("lote")[0];
	lc  = document.getElementsByName("localizacao")[0];


	if(!(rws(n.value) || rws(q.value) || rws(l.value) || rws(lc.value) ) )
	{
		alert("Os campos NÚMERO, QUADRA, LOTE e LOCALIZAÇÃO não possuem valor. Ao menos um deles deve ser preenchido!");
		irParaCampo(n);
		return;
	}

	

	document.cadastrarImovel.submit();
}
