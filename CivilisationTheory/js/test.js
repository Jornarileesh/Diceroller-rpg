
//var v = 400;
var l = 0; // wartość licznika licznika
var wl = 0; // wyświetlana wartość licznika
var z = 0; // zapisany stan wyświetlanego licznika
var c = true; // true = licznik działa / false = licznik nie działa
var p = 0.1; // współczynnik wzrostu dla licznika

// funkcje licznika ---------------------------------------------------------------
function counter() {
	if (c == true){
	l = l + p;
	wl = Math.round(l);
	}
	document.getElementById("licznik_1").innerHTML = wl;
};

function start(){
	c = true;
	wl = z;
	setInterval(function(){counter()},1000);
};

function stop(){
	c = false;
	z = wl;
	document.getElementById("zapis_1").innerHTML = z;
};

// --------------------------------------------------------------------------------

// funkcje współczynnika wzrostu  -------------------------------------------------

function counter_up(){
	p = p*2;
}

// --------------------------------------------------------------------------------
