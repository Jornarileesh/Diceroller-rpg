
$ = function(x){return document.getElementById(x);}

window.addEventListener('load', function(e) {

diceApp.init();
diceApp.createAllDicesIn($("ramka"));

}, false);













var diceApp = {


init: function(){

     let DATA = diceApp.diceData;

	DATA.diceTypes = Object.assign(DATA.defaultDiceTypes, DATA.customDiceTypes);
	myScan(DATA.diceTypes);
	diceApp.dicesCollection = {};
	
	
	diceApp.Dice.prototype.roll = function roll(output){ 
		this.timesRolled++
		max= this.range+1;// bo random nie zwraca max
		min= 1;
		wynik= Math.floor(Math.random() * (max - min)) + min;
		let comment = 
			this.range === 0 ? //potem sprawdź czy "0" moze powodować problemy 
			 	(wynik="nieskończoność","- Popsułeś Wszechświat :P") : this.range === 1 ?
				 	"- No a czego się spodziewałeś, rzucałeś kiedyś piłką? Na którą ściankę upadła?" : 						this.isSpecial ?
							 " Tu Cię mam :)": this.isNum ? 0:"";
 
		result = this.isNum ? wynik+comment : this.values[wynik-1]+comment;

		if (output){
				
			this.isComplicated ? 
				output.innerHTML += result : 
				output.innerText += result + this.suffix; 
			
			
		}else{

		return result + this.suffix;
		}
		};




	console.log('diceApp initialised');
	
	},






/*---------------------------------------Properties---------------------------------------------------------------*/






diceData : {
	defaultDiceTypes: {2:2,4:4,6:6,8:8,10:10,12:12,20:20},
	customDiceTypes: {

		Moneta:["orzeł","reszka"],
		
		Kobieta:[
			"głowa mnie boli",
			"mam okres",
			"rób jak chcesz.",
			"...",
			"...nic.",
			"A ty, jak myślisz?",
			"dobrze.\n .!!!",
			],

		Mężczyzna:["Noo...",
				"Noo... \n ...Co?!",
				"Powiedziałem Ci, że to zrobię, nie musisz mi przypominać co pół roku",
				"Jeszcze chwila, tylko zasejwuję...",
				"Jeszcze jeden level",
				"Same się wyniosą, jak wystarczająco długo poczekam",
				"Ale robiłem to w zeszłym miesiącu..."
				],
		element:[
			"<body></body>",
			"<button class='dicebutton'></button>",
			"<img src='http://vignette2.wikia.nocookie.net/joke-battles/images/2/29/Catpixelated.jpg/revision/latest?cb=20160103222950' width=50>",
			"<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAAV0lEQVR4nGP5//8/AxzcZIRw1P8zwoRYkCV//58HZrKCFEIVIRTgAHAF0nYOQHIRlOfA8PQluhWETHhwMI5BwX4RnI2hgFUjEeioRf8RbCxWPHt1AMMKAHQrGyvJvmcxAAAAAElFTkSuQmCC'>",

"<img src='http://static.hotukdeals.com/images/avatars/low-res/avatar33367_1.jpg'>"
			],
		1 : 1,
		0 : 0,
		"ujemne -100" : -100,
		},
	},





/*--------------------------------------Constructors-----------------------------------------------------------------*/

Dice: function (rangeOrSetofValues,nameOfDice){
	
	let thing= rangeOrSetofValues;
	let isNum = (typeof thing === "number");
     this.isMoreComplicated = (typeof thing !== "object") && !isNum;
     this.isMoreComplicated ? 
	alert("There's something going on, and you put some weird sh... into me, however weird it sounds"):false; 
	this.isComplicated = /<[a-z][\s\S]*>/i.test(thing[0]);

	this.isNum = isNum;
	this.name = nameOfDice;
	this.range = !isNum ? Object.keys(thing).length : thing; 
	this.values = thing;
	this.timesRolled = 0;
	this.isSpecial = (this.range < 2) ? true: (this.range % 1 === 0) ? false: true;
	this.suffix = this.isSpecial ? "\n": isNum ? ", " : "\n";
	},







/*----------------------------------------Methods-------------------------------------------------------------------*/






createAllDicesIn: function (here){

	var dTOb = diceApp.diceData.diceTypes;
	 
	here = here ? here : document.body; //if place to create rows(for buttons and fields) is not specified use body 
     dT = Object.keys(dTOb)
	//loop through given array of ranges
	
	for (let idx=0;idx<dT.length;idx++){
     
		let row = document.createElement('div');
	     row.className="row";
	     row.id= "r"+idx;
	     here.appendChild(row);	

		/*instantiate dice obj. for every range, and button with the same id as name of dice accordingly */
     		let dice = new diceApp.Dice(dTOb[dT[idx]],dT[idx]);//passes both the key (dT[idx]) and the value of property behind it , so key can be both a string and a number

		console.log(dT[idx]);
		var dbtn = document.createElement('button');
		dbtn.id = dice.name;
		dbtn.value = dice.name;
	     dbtn.innerText = dice.name;
	
		//in case we want to use divs later and animate / style into dice shape
	
	
	     dbtn.className = "diceButton"
		
		/*puts a dice into a parent collection object as a property with name of dice */
		
		diceApp.dicesCollection[dice.name]=dice;
		$(row.id).appendChild(dbtn);	
	     
		//alert($(dbtn.id))
		
		/*per each button we create a div element , our roll output, later you can use its content to save whole roll 
		series once. later i have to just assign CSS className to elements instead of wasting code space */

		var resultOutput = document.createElement('div');
		resultOutput.className = "results";
		resultOutput.id = dice.name+"Output";
		$(row.id).appendChild(resultOutput);
	

		/*attach click event listener to each button*/
		
		$(dbtn.id).addEventListener('click',(function (e){ 
			
			/*(e is in this case click event) we get target DOM object that fired it (obviously a button)*/
			e.preventDefault();
			let btn = e.target;

			let outp = btn.nextElementSibling
			
			/* MUST ENCLOSE THIS IN A SEPARATE FUNCTION THAT CAN BE FIRED NOT ONLY FROM CLICK*/
	
				let orig = btn.className;
				let origOutp = outp.className;
	
				btn.className += " roll once";

				/*assigns to div next to button outcome of dice.roll() method, 
				dice object we want to roll from dices 
				collection is identified by the according button name  */


				setTimeout(()=>{
				     btn.className = orig;
				  diceApp.dicesCollection[btn.id].roll(outp);
				     outp.className += " pop once";
				     },600);

				setTimeout(()=>{
					outp.className = "results";
					},1);


				console.log(btn.id)

			/* MUST ENCLOSE THIS IN A SEPARATE FUNCTION THAT CAN BE FIRED NOT ONLY FROM CLICK*/

			})	//end of event IIFE

		,true); //end of addEventListener parameters

		} //end of looping through DiceTypes array

	/* scans dices object */
	myScan(diceApp.dicesCollection,console.log);

	} // end of creatAllDices() method

 




}


























//my tool to scan objects when i am debugging


function myScan(thing,outf) 
{
let log ="";
 for(var propname in thing)
  {
   if (true)//(thing.hasOwnProperty(propname))
   {log += propname + ":" + thing[propname] + "<br>" ;}
  }

if (!outf)
	{console.warn("asd output destination not specified! Output:"+log)}
else
	{outf(log);}

log="";
}

