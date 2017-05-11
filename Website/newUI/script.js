
$ = function(x){return document.getElementById(x);}


diceTypes = [2,4,6,8,10,12,20];
dices = {};




window.addEventListener('load', function(e) {
createAllDices();


}, false);




function createAllDices(){

var dT=diceTypes;

	//loop through given array of ranges
	for (idx=0;idx<dT.length;idx++){
     row = document.createElement('div');
     row.className="row";
     row.id= "r"+idx;
     document.body.appendChild(row);	
	dice = new Dice(dT[idx]);
/*
instantiate dice obj. for every range
and button with the same id as name of dice accordingly
*/
     console.log(dT[idx]);
	var dbtn = document.createElement('button');
	dbtn.id = dice.name;
	dbtn.value = dice.name;
     dbtn.innerHTML = dice.name;//in case we want to use divs later and animate / style into dice shape


     dbtn.className = "diceButton"
/*puts a dice into a parent object as a property with name of dice */
	dices[dice.name]=dice;
	$(row.id).appendChild(dbtn);	
     //alert($(dbtn.id))

/*attach click event listener to each button*/
	$(dbtn.id).addEventListener('click',

(function (e){ 
/*e is an dipatched event, we get DOM object that fired it (obviously a button)*/

let btn = e.target;
let outp = btn.nextElementSibling
let orig = btn.className;
let origOutp = outp.className;

btn.className += " roll once";

setTimeout(()=>{
     btn.className = orig;
     outp.innerHTML +=   dices[btn.id].roll()+", ";
     outp.className += " pop once";

     },400);

setTimeout(()=>{
    outp.className = "results";
    },100)


console.log(btn.id)
/*assigns to div next to button outcome of dice.roll() method, dice object we want to roll from dices collection is identified by the according button name  */

})
     

,false);


/*per each button we create a div element , our roll output, later you can use its content to save whole roll series once. later i have to just assign CSS className to elements instead of wasting code space */

	var resultOutput = document.createElement('div');
     resultOutput.innerHTML= ""
     resultOutput.className = "results";
     resultOutput.id = dice.name+"Output";
      
$(row.id).appendChild(resultOutput);
	




	}
asd(dices,console.log);

}


function Dice(range){
/* this lines initiate the object instances*/
this.name = "k"+range;
this.range = range;

}

//kazda instancja Dice moze uzyc tej metody i nie ma jej na wlasnosc(shadowing, jeśli nadpiszesz)

Dice.prototype.roll = function roll(){
max= this.range+1;// bo random nie zwraca max
min= 1;
wynik= Math.floor(Math.random() * (max - min)) + min;
/*
alert('you pressed '+this.name+" \n wynik: " + wynik);
*/
return wynik;
}






//my tool to scan objects when i am debugging


function asd(thing,outf) 
{
let log ="";
 for(var propname in thing)
  {
   if (true)//(thing.hasOwnProperty(propname))
   {log += propname + ":" + thing[propname] + "<br>" ;}
  }

if (!outf){loginhtml(log);}else{outf(log);}
log="";
}

function asdalert(thing,out) 
{
 for(var propname in thing)
  {
   if (true)//(thing.hasOwnProperty(propname))
   {log += propname + ":" + thing[propname] + "<br>" ;}
  }

alert(log);
log="";
}

