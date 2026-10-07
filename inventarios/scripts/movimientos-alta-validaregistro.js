function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function ValidaRegistro(form) {
	alerta="";
	i=0;
	/* Valida Folio */
	txt=window.document.getElementById('cantidad').value; txt=trim(txt);	if(txt.length<1) {i=1;alerta+='Por favor, ingrese cantidad\n';}
	txt=window.document.getElementById('codigo').value;	 txt=trim(txt);	if(txt.length<1) {i=1;alerta+='Por favor, ingrese código corto o código de barras del producto\n';}
	/* Verifica si hay errores para mandar alerta */	
	if(i==0){
		AgregaRegistro(form);
	}  else {
		alert(alerta);	
	}
}

