
/* Zmienne dla surowców */

// Drewno:
var drewno_l = 0; // wartość licznika
var drewno_wl = 0; // wyświetlana wartość licznika
var drewno_z = 0; // zapisany stan wyświetlanego licznika
var drewno_c = true; // true = licznik działa / false = licznik nie działa
var drewno_p = 0.2; // współczynnik wzrostu dla licznika
var drewno_lvl = 1; // poziom szybkości produkcji w kopalni
var drewno_bust_cost = 10; // koszt za zwiększenie szybkości produkcji
var drewno_bust_cost2 = 10;
var drewno_tartak = 1; // liczba tartaków
var drewno_tartak_cost = 20; // koszt pojedynczego tartaka 

// Kamień:
var kamien_l = 0; // wartość licznika
var kamien_wl = 0; // wyświetlana wartość licznika
var kamien_z = 0; // zapisany stan wyświetlanego licznika
var kamien_c = false; // true = licznik działa / false = licznik nie działa
var kamien_p = 0.2; // współczynnik wzrostu dla licznika
var kamien_lvl = 1; // poziom szybkości produkcji w kopalni
var kamien_bust_cost = 50; // koszt za zwiększenie szybkości produkcji
var kamien_bust_cost2 = 100;
var kamien_kamieniolom = 0; // liczba kamieniołomów
var kamien_kamieniolom_cost = 50; // koszt pojedynczego kamieniołomu 

/* -------------------- */

// funkcje kopalni - drewno ----------------------------------------------------------
function drewno_counter() {
	if (drewno_c == true){
	drewno_l = drewno_l + drewno_p;
	drewno_wl = Math.round(drewno_l);
	}
	document.getElementById("licznik_drewno").innerHTML = drewno_wl;

	// wyświetlenie parametrów dla obiektów (dla kontroli)
	document.getElementById("drewno_speed").innerHTML = drewno_p;
	document.getElementById("kamien_speed").innerHTML = kamien_p;
};

function drewno_start(){
	drewno_c = true;
	drewno_wl = drewno_z;
	setInterval(function(){drewno_counter()},1000);
};

function drewno_stop(){
	drewno_c = false;
	drewno_z = drewno_wl;
	document.getElementById("zapis_1").innerHTML = drewno_z;
};

function drewno_tartak_buy() {
	if(drewno_wl >= drewno_tartak_cost) {
		var stara;
		var nowa;
		var wzrost;
		stara = drewno_tartak;
		drewno_l = drewno_l - drewno_tartak_cost; // dokonujemy zakupu
		drewno_tartak = drewno_tartak + 1; // zwiększamy liczbę obiketów
		nowa = drewno_tartak;
		wzrost = nowa/stara - 1;
		drewno_p = drewno_p + (drewno_p * wzrost);
	}
	document.getElementById("drewno_tartak").innerHTML = drewno_tartak;
}

// -----------------------------------------------------------------------------------

// funkcje kopalni - kamień ----------------------------------------------------------
function kamien_counter() {
	if (kamien_c == true){
	kamien_l = kamien_l + kamien_p;
	kamien_wl = Math.round(kamien_l);
	}
	document.getElementById("licznik_kamien").innerHTML = kamien_wl;
};

function kamien_start(){
	kamien_c = true;
	kamien_wl = kamien_z;
	setInterval(function(){kamien_counter()},1000);
};

function kamien_stop(){
	kamien_c = false;
	kamien_z = kamien_wl;
	document.getElementById("zapis_1").innerHTML = kamien_z;
};

function kamien_kamieniolom_buy() {
	if(drewno_wl >= kamien_kamieniolom_cost) {
		var stara;
		var nowa;
		var wzrost;
		if(kamien_kamieniolom > 0){
			stara = kamien_kamieniolom;
			drewno_l = drewno_l - kamien_kamieniolom_cost; // dokonujemy zakupu
			kamien_kamieniolom = kamien_kamieniolom + 1; // zwiększamy liczbę obiketów
			nowa = kamien_kamieniolom;
			wzrost = nowa/stara - 1;
			kamien_p = kamien_p + (kamien_p * wzrost);

			if (kamien_c == false) {
				kamien_start();
			};
		}
		else{
			drewno_l = drewno_l - kamien_kamieniolom_cost; // dokonujemy zakupu
			kamien_kamieniolom = 1;

			if (kamien_c == false) {
				kamien_start();
			};
		}
		
	}

	document.getElementById("kamien_kamieniolom").innerHTML = kamien_kamieniolom;
}

// -----------------------------------------------------------------------------------

// funkcje wynalazków - drewno -------------------------------------------------------

function drewno_bust() {
	if (drewno_lvl >= 3) {
		if (drewno_wl >= drewno_bust_cost && kamien_wl >= drewno_bust_cost2){
			drewno_l = drewno_l - drewno_bust_cost; // dokonujemy zakupu
			kamien_l = kamien_l - drewno_bust_cost2; // dokonujemy zakupu
			drewno_lvl = drewno_lvl + 1; // zwiększamy wartość wynalazku
			drewno_p = drewno_p * 2;
			drewno_bust_cost = drewno_bust_cost * 2;
			drewno_bust_cost2 = drewno_bust_cost2 * 2;
		}
	}
	else {
		if (drewno_wl >= drewno_bust_cost){
			drewno_l = drewno_l - drewno_bust_cost; // dokonujemy zakupu
			drewno_lvl = drewno_lvl + 1; // zwiększamy wartość wynalazku
			drewno_p = drewno_p * 2;
			drewno_bust_cost = drewno_bust_cost * 2;
		}
	};

	document.getElementById("drewno_poziom").innerHTML = drewno_lvl;
	document.getElementById("tartak_drewno_koszt").innerHTML = drewno_bust_cost;
	document.getElementById("tartak_kamien_koszt").innerHTML = drewno_bust_cost2;
};

// -----------------------------------------------------------------------------------

// funkcje wynalazków - kamień -------------------------------------------------------

function kamien_bust() {
	if (kamien_lvl >= 3) {
		if (drewno_wl >= kamien_bust_cost && kamien_wl >= kamien_bust_cost2){
			drewno_l = drewno_l - kamien_bust_cost; // dokonujemy zakupu
			kamien_l = kamien_l - kamien_bust_cost2; // dokonujemy zakupu
			kamien_lvl = kamien_lvl + 1; // zwiększamy wartość wynalazku
			kamien_p = kamien_p *2;
			kamien_bust_cost = kamien_bust_cost * 3;
			kamien_bust_cost2 = kamien_bust_cost2 * 3;
		}
	}
	else {
		if (drewno_wl >= kamien_bust_cost){
			drewno_l = drewno_l - kamien_bust_cost; // dokonujemy zakupu
			kamien_lvl = kamien_lvl + 1; // zwiększamy wartość wynalazku
			kamien_p = kamien_p *2;
			kamien_bust_cost = kamien_bust_cost * 3;

		}
	};

	document.getElementById("kamien_poziom").innerHTML = kamien_lvl;
	document.getElementById("kamieniolom_drewno_koszt").innerHTML = kamien_bust_cost;
	document.getElementById("kamieniolom_kamien_koszt").innerHTML = kamien_bust_cost2;
};

// -----------------------------------------------------------------------------------