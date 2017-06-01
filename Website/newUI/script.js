

eFind= function(x){return document.getElementById(x);}

window.addEventListener('load', function(e) {



diceApp.init({options:{language:"pl"}});
diceApp.mergeInCustomData();
diceApp.createDicesIn(eFind("sramka"))//,diceApp.diceData.default);
//myScan(eFind("sramka"))
}, false);

