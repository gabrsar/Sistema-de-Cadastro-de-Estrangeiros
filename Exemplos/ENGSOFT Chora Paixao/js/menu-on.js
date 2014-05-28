var path = location.pathname;

var regexInicio  = /inicio/;
var regexServico = /Servico/;
var regexImovel  = /Imovel/;
var regexUsuario = /Usuario/;

var tipo="";

if(regexInicio.test(path))
{
	tipo="menu_inicio";
}

if(regexServico.test(path))
{
	tipo="menu_servico";
}

if(regexImovel.test(path))
{
	tipo="menu_imovel";
}

if(regexUsuario.test(path))
{
	tipo="menu_usuario";
}


var elemento = document.getElementById(tipo);

elemento.className+= "on";


