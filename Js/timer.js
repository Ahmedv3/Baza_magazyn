function zegar() {

		var data = new Date();

		var godzina = data.getHours();
		if (godzina <10) godzina = "0"+godzina;
		var minuta = data.getMinutes();
		if (minuta <10) minuta = "0"+minuta;
		var sekunda = data.getSeconds();
		if (sekunda <10) sekunda = "0"+sekunda;

		document.getElementById('clock').innerHTML = godzina+":"+minuta+":"+sekunda;

		setTimeout("zegar()",1000);

}


