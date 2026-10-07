function trim(stringToTrim) {
	return stringToTrim.replace(/^\s+|\s+$/g,"");
}

function validar() {
	alerta="";
	i=0;
	/* Valida Folio */
	txt=window.document.getElementById('codigocorto').value; txt=trim(txt);	if(txt.length<1) {i=1;alerta+='Por favor, ingrese Código Corto del Producto\n';}
	txt=window.document.getElementById('producto').value;	 txt=trim(txt);	if(txt.length<1) {i=1;alerta+='Por favor, ingrese Descripción del Producto. \n';}
	/* Verifica si hay errores para mandar alerta */	
	if(i==0){
		window.document.getElementById('AltaProducto').submit();
	}  else {
		alert(alerta);	
	}
}

