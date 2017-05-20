
var url = "zapisz.php";// twoj skrypt przyjmujacy dane juz bez losowania


//function przygotujParametryDoWysłania

PrzygotujDoWyslania = function(obj, prefix) {
  var str = [], p;
  for(p in obj) {
    if (obj.hasOwnProperty(p)) {
      var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
      str.push((v !== PrzygotujDoWyslania && typeof v === "object") ?
        PrzygotujDoWyslania(v, k) :
        encodeURIComponent(k) + "=" + encodeURIComponent(v));
    }
  }
  return str.join("&");
}


//function przygotujParametryDoWysłania







var stringdanych = "test";

function wyslij(url,stringDanych){
var zadanie = new XMLHttpRequest();
zadanie.open("POST", url, true);

//Send the proper header information along with the request
zadanie.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

zadanie.onreadystatechange = function() {//wzywa funkcje gdy stan zadania sie zmienia
    if(zadanie.readyState == 4 && zadanie.status == 200) {
        wyswietl(zadanie.responseText);
    }
}
zadanie.send(stringDanych);
}
