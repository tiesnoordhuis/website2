/*
comments

12-sept-2016
geschreven door Ties Noordhuis

*/
/*variable*/
var galerijType = "lijst";
var plaatjeNummer = 1;
var plaatjeNaam = "leeg";
var plaatjeNaamLengte = 0;
var totaalPlaatjes = 22;

function galerijLijst(){
	
	return
}
/* 	maakt een array "lengthExtensie"
	[0] waarde is de lengte van de totale string van het pad van het plaatje
	[1] waarde is de positie van de punt "." als scheiding naar de extensie en dus ook de lengte tot de extensie
	[2] waarde is de lengte van de extensie + de punt   b.v. plaatje.jpg geeft als waarde 4
	[3] waarde is het laatste nummer voor de punt   b.v. plaatje3.jpeg geeft als waarde 3
	[4] waarde is de lengte van het volgnummer van het plaatje
*/
function getImgPad(){
	var lengthExtensie = [document.getElementById("plaatjeFrame").src.toString().length , document.getElementById("plaatjeFrame").src.toString().search(/\u002E/),0,0,1];
	lengthExtensie[2] = lengthExtensie[0] - lengthExtensie[1];
	var isNumber = [document.getElementById("plaatjeFrame").src.charAt(lengthExtensie[1]-1) , document.getElementById("plaatjeFrame").src.charAt(lengthExtensie[1]-2)]
	if (isNaN(isNumber[0])){
		document.getElementById("testGalerij").innerHTML = "0 nummer" + isNumber;
		throw "geen genummerde plaatjes"
	}
	else if (isNaN(isNumber[1])){
		document.getElementById("testGalerij").innerHTML = "1 nummer" + isNumber;
		lengthExtensie[4] = 1;
	}
	else{
		document.getElementById("testGalerij").innerHTML = "2 nummer" + isNumber;
		lengthExtensie[4] = 2;
	}
	lengthExtensie[3] = document.getElementById("plaatjeFrame").src.toString().slice(lengthExtensie[1] - lengthExtensie[4] , lengthExtensie[1])
	return lengthExtensie
}
/*
	maakt de naam van het plaatje bestand, door het samen te voegen van het nieuwe volgnummer met de oude naam string
*/
function setPlaatjeNaam(lengthExtensie,plaatjeNummer){
	plaatjeNaamLengte = lengthExtensie[1] - lengthExtensie[4];
	plaatjeNaam = document.getElementById("plaatjeFrame").src.toString().substr(0,plaatjeNaamLengte);
	document.getElementById("plaatjeFrame").src = plaatjeNaam + plaatjeNummer + ".jpg";
	return
}
/*
	verandert het plaatje naar het plaatje met 1 LAGER volgnummer
*/
function galerijLinks(){
	lengthExtensie = getImgPad();
	if (Number(lengthExtensie[3]) > 1){
		plaatjeNummer = Number(lengthExtensie[3]) - 1;
	}
	else{
		plaatjeNummer = totaalPlaatjes;
	}
	setPlaatjeNaam(lengthExtensie,plaatjeNummer);
	return
}
/*
	verandert het plaatje naar het plaatje met 1 HOGER volgnummer
*/
function galerijRechts(){
	lengthExtensie = getImgPad();
	if (Number(lengthExtensie[3]) < totaalPlaatjes){
		plaatjeNummer = Number(lengthExtensie[3]) + 1;
	}
	else{
		plaatjeNummer = 1;
	}
	setPlaatjeNaam(lengthExtensie,plaatjeNummer);
	return
}