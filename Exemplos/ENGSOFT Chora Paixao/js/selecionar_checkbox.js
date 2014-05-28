function selecionar_checkbox(){

	var boxes = document.getElementsByTagName("input");
	
	for (var x=0;x<boxes.length;x++)
	{
		
		var obj = boxes[x];
		
		if (obj.type == "checkbox")
		{
			if (obj.name == "servicoParaImprimir[]")
			{
				obj.checked = !obj.checked;
			}
		}
	}
}
