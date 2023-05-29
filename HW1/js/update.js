function Controlla(event) {
	count++;
    var esito = (new RegExp('@')).test(form.email.value);
	p.classList.remove('hidden');
	if (form.nome.value.length == 0 ||
        form.cognome.value.length == 0 ||
        form.email.value.length == 0 ||
        form.password.value.length == 0) {
		p.textContent="Compilare tutti i campi!";
        event.preventDefault();
		if(count>10)  alert("Continui a non capire! Compilare tutti i campi!!");
    } else if (!esito) {
		form.email.style.backgroundColor="red";
        p.textContent="Email Non valida!";
        event.preventDefault();
		if(count>10)  alert("Email Non valida!");
    } else if (!(form.password.value === form.cpassword.value)) {
        p.textContent="Password non corrispondenti!";
		event.preventDefault();
		if(count>10)  alert("Password non corrispondenti!");    
	} else if (form.password.value.length < 4 || form.password.value.length >24){
		p.textContent="Password non valida!";
		event.preventDefault();
	}
	if (form.password.value.indexOf(space) > -1) {
     p.textContent="La password non può includere spazi";
}     


if (!(form.password.value.match(/\d/))) {
     p.textContent="La password deve includere almeno un numero";
	 event.preventDefault();
}
    
if (!(form.password.value.match(/^[a-zA-Z]+/))) {
     p.textContent="La password deve iniziare con almeno una lettera";
	 event.preventDefault();
}
    
if (!(form.password.value.match(/[A-Z]/))) {
     p.textContent="La password deve includere una o più lettere maiuscole";
	 event.preventDefault();
}

if (!(form.password.value.match(/[a-z]/))) {
     p.textContent="La password deve includere una o più lettere minuscole";
	 event.preventDefault();
}

if (!(form.password.value.match(/\W+/))) {
    p.textContent="La password deve includere almeno un carattere speciale - #,@,%,!";
    event.preventDefault();
   }	
}


let form = document.forms['modifica'];
form.addEventListener('submit', Controlla);
let count=0;
let flag=0;
let p = document.querySelector('.windowerror');
p.classList.add('hidden');

/*CaricamentoInformazioniutente();

function CaricamentoInformazioniutente() {
	link="http://localhost/HW1/fetch/downloadinfo.php?key="+form.nick.value;
	console.log(link);
    fetch(link).then(onResponse).then(useJson).catch(Errore);
}

function Errore(){
    console.log("Errore nella fetch");
}

function onResponse(response){
    return response.json();
}

function useJson(json){
  console.log(json);
  for(let j of json){
        form.nome.value=j.nome;
	    form.cognome.value=j.cognome;
	    form.email.value=j.email;
  }
}
*/
