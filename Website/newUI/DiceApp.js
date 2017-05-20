
eFind= function(x){return document.getElementById(x);}

window.addEventListener('load', function(e) {
preferredLanguage = window.navigator.languages
    ? navigator.languages[0]
    : (navigator.language || navigator.userLanguage)



diceApp.init({language:preferredLanguage});
diceApp.mergeInCustomData();
diceApp.createDicesIn(eFind("sramka"))//,diceApp.diceData.default);
//myScan(eFind("sramka"))
}, false);














var diceApp = {

init: function(options){
	let initLog = "";

    	diceApp.usrLng = !options.language ? 
		diceApp.languageData.defaultLanguage:
		options.language;
		
	//Twice because we want to gather info who is visiting us
	//it can be done better if browser Navigator language recognition would be incorporated into App itself
	
	lng = diceApp.languageData.supportedLanguages[diceApp.usrLng] ?
		diceApp.usrLng:
		diceApp.languageData.defaultLanguage;
	


	initLog += "\nchosen language:"+lng;
	
	diceApp.usrLng = lng;
	diceApp.labels = diceApp.languageData.labels[lng];
	diceApp.dicePrfx = diceApp.languageData.dicePrfx[lng]
	
	//tu dodać opcję customowego ustawiania adresatów requestów
	  

	diceApp.dicesCollection = {};
	
     diceApp.Dice.prototype.rollTimes = function(output,times){
                  if (times){
                  for (r=0;r<times;r++){
                  this.roll(output);
                  }}
                  else{
                  console.error("error_ no times declared");}
             myScan(this,console.log);
		this.sendMe();
           }
	
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
          

		
          //alert(this.suma);
		result = this.isNum ? wynik+comment : this.values[wynik-1]+comment;
          
		
		this.allResults.push(wynik);
		this.lastResult = wynik;//żeby był numeryczny
		this.suma+= wynik;

		if (output){
				this.isHTML ? 
				output.innerHTML += result : 
				(output.innerText += result + this.suffix , 
				output.nextElementSibling.innerText=this.suma);
			}



		
		return result + this.suffix;
		};

	diceApp.Dice.prototype.sendMe = function(){
			aboutMe = {
				plus:0,

				oczka:this.range,

				mnoznik:1,

				rzuty:this.timesRolled,

				komentarz:"diceApp.js" 
					+ "\nlng:" + diceApp.usrLng
					+ "\nNazwa:" + this.name 
					+ "\nTyp:" + this.type
					+ "\nIle Rzutów:" + this.timesRolled
					+ "\nWyniki:" + this.allResults
					+ "\nSuma:" + this.suma
					+ "\nOstatni:" + this.lastResult
					+ "\nOczka:"+this.range,
					
 
				ostatni:this.lastResult,
				nazwa:this.name,
				ileRzutow:this.timesRolled,
				//jeśli POST przy każdym rzucie ta zmienna bedzie ++ co rzut
				wyniki:this.allResults,
				typ:this.type
				
				}; // end of aboutMe object 

			aboutMe_As_URI = diceApp.ajax.prepare(aboutMe);
			diceApp.ajax.connect(diceApp.server.rollHandlerURL,aboutMe_As_URI);
		
			} // end of sendMe prototypal method 




	
	

	console.log('diceApp initialised'+initLog);
	
	}, // end of diceApp.init method 



/*--------------------------------------Constructors-----------------------------------------------------------------*/

Dice: function (rangeOrSetofValues,nameOfDice){
	
	let thing= rangeOrSetofValues;
	let isNum = (typeof thing === "number");

     this.isMoreComplicated = (typeof thing !== "object") && !isNum && (typeof thing !== "string");
     this.isMoreComplicated ? 
	alert("There's something going on, and you put some weird sh... into me, however weird it sounds"):false; 
	this.isHTML = /<[a-z][\s\S]*>/i.test(JSON.stringify(thing));
     
     
	this.allResults = [],
	this.timesRolled = 0;
	this.suma =0;
	this.type = typeof thing;
	this.isNum = isNum;
	this.name = typeof nameOfDice === "number" ?
		diceApp.dicePrfx + nameOfDice :
		nameOfDice;
	this.range = isNum ? thing : thing.set ?Object.keys(thing.set).length : Object.keys(thing).length
	this.values = thing.set ? thing.set : thing;
	this.isSpecial = (this.range < 2) ? true: (this.range % 1 === 0) ? false: true;
	this.suffix = thing.suffix? thing.suffix : this.isSpecial ? "\n": isNum ? ", " : "\n";
     if (thing.suffix) {
		this.suffix = (thing.suffix="no-suffix") ? 
			"" : 
			this.suffix;
		}

	

	}, // end of Dice constructor









/*---------------------------------------Properties-and-data-----------------------------------------------------------*/



server:{
	serverAddress:"http://diceroller-rpg.com",
	rollHandlerURL:"http://diceroller-rpg.com/kostka.php",
	searchHandlerURL:"http://diceroller-rpg.com/select.php"
},



languageData:{

	defaultLanguage:"en-GB",

	supportedLanguages:{
		"en-GB":true,
		"en-US":true,
		"pl":true,
	},

	labels:{

		"pl":[
			"Przycisk",
			"Rzuty",
			"Suma rzutów",
		],

		"en-GB":[
			"Button",
			"Results",
			"Total Sum",
		],
		
		"en-US":[
			"Button",
			"Results",
			"Total Sum",
		]
	},
	dicePrfx:{

		"pl":"k",

		"en-GB":"D",
		
		"en-US":"D"
	}
},

diceData : {
	imageSources:{
4:"Images/IMG_5446.PNG",
6:"Images/IMG_5445.PNG",
8:"Images/IMG_5444.PNG",
10:"Images/IMG_5442.PNG",
12:"Images/IMG_5439.PNG",
20:"Images/IMG_5437.PNG",},
	
     AlternativeImageSources:{
4:"http://imageshack.com/a/img924/3282/qISZVu.png",
6:"http://imageshack.com/a/img923/2889/ggtIe5.png",
8:"http://imageshack.com/a/img924/9493/gHQmV7.png",
10:"http://imageshack.com/a/img923/5215/bsc2dq.png",
12:"http://imageshack.com/a/img922/3519/4aBhEo.png",
20:"http://imageshack.com/a/img922/4097/gcK2iL.png"},
	default: {4:4,6:6,8:8,10:10,12:12,20:20},
	custom: {
		Szatan:666,
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
			'<button class="diceButtonImage" style="width:50px;height:50px;"></button>',
			"<img src='http://vignette2.wikia.nocookie.net/joke-battles/images/2/29/Catpixelated.jpg/revision/latest?cb=20160103222950' width=50>",
			"<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAgAAAAICAYAAADED76LAAAAV0lEQVR4nGP5//8/AxzcZIRw1P8zwoRYkCV//58HZrKCFEIVIRTgAHAF0nYOQHIRlOfA8PQluhWETHhwMI5BwX4RnI2hgFUjEeioRf8RbCxWPHt1AMMKAHQrGyvJvmcxAAAAAElFTkSuQmCC'>",

"<img src='http://static.hotukdeals.com/images/avatars/low-res/avatar33367_1.jpg'>"
			],
		"ujemne -100" : -100,
           "haslo":{
                    set:"!#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_`abcdefghijklmnopqrstuvwxyz{|}",
                    suffix:"no-suffix"
                    }
		},
	},




/*----------------------------------------Methods-------------------------------------------------------------------*/

mergeInCustomData: function(){ 

     let DATA = diceApp.diceData;

	DATA.diceTypes = Object.assign(DATA.default,     
     DATA.custom);
     },



createDicesIn: function (here,what){

/* dTOb dicetypesobject*/
	dTOb = what ? what : diceApp.diceData.default;
	 
	here = here ? here : document.body; //if place to create rows(for buttons and fields) is not specified use body 
     dT = Object.keys(dTOb)
	//loop through given array of ranges
	
	/*labels on the top (language dependent)*/

     let row1st = document.createElement('div')
	     row1st.className="myrow";
	     row1st.id= "dicelabels";
		for(var labidx = 0; labidx<diceApp.labels.length;labidx++){
			let label = document.createElement('div');
			label.innerText = diceApp.labels[labidx];
			label.className = "results";
			row1st.appendChild(label);
		}
	here.appendChild(row1st);





	for (let idx=0;idx<dT.length;idx++){
     	
		let row = document.createElement('div');
	     row.className="myrow";
	     row.id= "r"+idx;
	  	

		/*instantiate dice obj. for every range, and button with the same id as name of dice accordingly */
     		let dice = new diceApp.Dice(dTOb[dT[idx]],dT[idx]);//passes both the key (dT[idx]) and the value of property behind it , so key can be both a string and a number

		console.log(dT[idx]);
		var dbtn = document.createElement('button');
		dbtn.id = dice.name;
		
		//in case we want to use divs later and animate / style into dice shape
	     
	     src = diceApp.diceData.imageSources[dT[idx]];
          
	     if (!src){
dbtn.className = "diceButton";
dbtn.value = dice.name;
	     dbtn.innerText = dice.name;
}
          else{
dbtn.className ="diceButtonImage";
dbtn.style.backgroundImage = "url('" + src + "')";
}
          
		
		/*puts a dice into a parent collection object as a property with name of dice */
		
		diceApp.dicesCollection[dice.name]=dice;
		row.appendChild(dbtn);	
	     
		//alert(eFind(dbtn.id))
		
		/*per each button we create a div element , our roll output, later you can use its content to save whole roll 
		series once. later i have to just assign CSS className to elements instead of wasting code space */

		var resultOutput = document.createElement('div');
		resultOutput.className = "results niceField";
		resultOutput.id = dice.name+"Output";
		row.appendChild(resultOutput);
	
          var sumaOutput = document.createElement('div');
		sumaOutput.className = "suma results niceField";
		sumaOutput.id = dice.name+"sumaOutput";
		row.appendChild(sumaOutput);
	

		/*attach click event listener to each button*/
		
		dbtn.addEventListener('click',(function (e){ 
			
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
				  diceApp.dicesCollection[btn.id].rollTimes(outp,5);
				
				     outp.className += " pop once";
				     },600);

				setTimeout(()=>{
					outp.className = "results niceField";
					},1);


				console.log(btn.id)

			/* MUST ENCLOSE THIS IN A SEPARATE FUNCTION THAT CAN BE FIRED NOT ONLY FROM CLICK*/

			})	//end of event IIFE

		,true); //end of addEventListener parameters

          here.appendChild(row);

		} //end of looping through DiceTypes array

	/* scans dices object */
	myScan(diceApp.dicesCollection,console.log);

	}, // end of creatAllDices() method



/*--------------------------------------------Server-Communication-AJAX--------------------------------------------*/ 


ajax:{

	prepare: function(obj, prefix) {
  		var str = [], p;
  		for(p in obj) {
    			if (obj.hasOwnProperty(p)) {
      			var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
      			str.push((v !== diceApp.ajax.prepare && typeof v === "object") ?
        				diceApp.ajax.prepare(v, k) :
        				encodeURIComponent(k) + "=" + encodeURIComponent(v));
    			}
		}
	return str.join("&");
	},


	connect: function(url,URIfrmStr) {
		var req = new XMLHttpRequest();
		req.open("POST", url, true);
		req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		diceApp.ajax.report(req);
		
		//wzywa funkcje gdy stan requestu sie zmienia
		req.onreadystatechange = function() { 
				if (true) //(req.readyState == 4 && req.status == 200) 
					{
					diceApp.ajax.report(req);
					diceApp.ajax.handleServerResponse(req.responseText);
					}
				}
		req.send(URIfrmStr);
		diceApp.ajax.report(req);
	},

	

	report: function(rqst) {

		console.log( "readyState:" + rqst.readyState
				+ " status: " + rqst.status
				+ " headers:" + rqst.getAllResponseHeaders().toLowerCase());
	},



	
	handleServerResponse: function(response) {
	console.log(response)
	}

} // end of diceApp.ajax module




} // end of diceApp Object


























//my tool to scan objects when i am debugging


function myScan(thing,outf,htmlformat) 
{
let nl= htmlformat? "<br>":"\n";
let log ="";
 for(var propname in thing)
  {
     if (thing.hasOwnProperty(propname))
        {log += propname + ":" + thing[propname] + nl }
     else
        {log += propname + ":" + "has(NOT)OwnProperty " + nl;}
}
if (!outf)
	{console.warn("asd output destination not specified! Output:"+log)}
else
	{outf(log);}

log="";
}

