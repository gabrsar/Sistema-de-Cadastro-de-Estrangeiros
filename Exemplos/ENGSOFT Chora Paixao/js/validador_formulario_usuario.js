function rws(str)
{
	return (str.replace(/\s+/g,''));
}

function irParaCampo(campo)
{
	campo.focus();
	window.scrollBy(0,-100);
}

function soNumeros(v){
    return v.replace(/\D/g,"");
}
function execmascara(){
    v_obj.value=v_fun(v_obj.value);
}

function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1);
} 

function validarFormulario()
{
    var campo;

	campo = document.getElementsByName("login")[0];
	if(campo.value <= 0 )
	{
		alert("O campo Login não possui um valor válido.");
		irParaCampo(campo);
		return;
	}

	campo = document.getElementsByName("senha")[0];
	if(!rws(campo.value))
	{
		alert("O campo Senha não está preenchido!");
		irParaCampo(campo);
		return;
	}

	campo = document.getElementsByName("nome")[0];
	if(!rws(campo.value))
	{
		alert("O campo Nome não está preenchido!");
		irParaCampo(campo);
		return;
	}

	permissao = document.getElementsByName("permissao")[0]; 

	setor =     document.getElementsByName("setor")[0]; 



	if(permissao.value != 2)
	{
		setor.value=0;
	}
	else if(permissao.value == 2)
	{
		if(setor.value == 0)
		{
			alert("Para usuários da Imobiliaria o setor deve ser Aluga ou Venda");

			return;
		}
	}

	document.cadastrarUsuario.submit();
}
