function busca_magica_focus()
{

	var x=document.getElementById("busca_magica");
	x.value="";
}

function busca_magica_blur()
{

	var x=document.getElementById("busca_magica");
	if(x.value.trim() == "")
	{
		x.value= "Busca Mágica";
	}
}

function busca_magica_form_submit()
{

	var x=document.getElementById("busca_magica");
	if(x.value.trim() == "Busca Mágica")
	{
		x.value = "";
	}

	return true;
	
}

