

eFind= function(x){return document.getElementById(x);}

window.addEventListener('load', function(e) {



diceApp.init();
diceApp.mergeInCustomData();
diceApp.createDicesIn(eFind("sramka"))//,diceApp.diceData.default);
//myScan(eFind("sramka"))
}, false);

