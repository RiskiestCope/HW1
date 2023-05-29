let form = document.forms['registrazione'];
form.addEventListener('submit', Controlla);
form.nick.addEventListener('blur',verificanomeUtente, true);
let count=0;
let flag=0;
let p = document.querySelector('.error p');

function Controlla(event) {
	var space  = " ";
	count++;
    var esito = (new RegExp('@')).test(form.email.value);
	contenitorerrore.classList.remove('hidden');
	//CONTROLLA NUOVAMENTE L'USERNAME INSERITO
	if (form.nome.value.length == 0 ||
        form.cognome.value.length == 0 ||
        form.email.value.length == 0 ||
        form.nick.value.length == 0 ||
        form.password.value.length == 0) {
		p.textContent="Compilare tutti i campi!";
        event.preventDefault();
		if(count>10)  alert(" Compilare tutti i campi!!");
    } else if (!esito) {
        p.textContent="Email Non valida!";
        event.preventDefault();
		if(count>10)  alert(" Email Non valida!");
    } else if (!(form.password.value == form.cpassword.value)) {
        p.textContent="Password non corrispondenti!";
		event.preventDefault();
		if(count>10)  alert("Password non corrispondenti!");    
	} else if (form.password.value.length < 4 || form.password.value.length >24){
		p.textContent="Password non valida!";
		event.preventDefault();
	}
	if (form.password.value.indexOf(space) > -1) { p.textContent="La password non può includere spazi"; event.preventDefault();}     
    if (!(form.password.value.match(/\d/))) { p.textContent="La password deve includere almeno un numero"; event.preventDefault(); }
    if (!(form.password.value.match(/^[a-zA-Z]+/))) { p.textContent="La password deve iniziare con almeno una lettera"; event.preventDefault(); }
    if (!(form.password.value.match(/[A-Z]/))) { p.textContent="La password deve includere una o più lettere maiuscole"; event.preventDefault();}
    if (!(form.password.value.match(/[a-z]/))) { p.textContent="La password deve includere una o più lettere minuscole"; event.preventDefault();}
    if (!(form.password.value.match(/\W+/))) { p.textContent="La password deve includere almeno un carattere speciale - #,@,%,!"; event.preventDefault(); }	
	verificanomeUtente();
	if(flag==1) event.preventDefault();
}

function verificanomeUtente() {
	link="http://localhost/HW1/fetch/queryName.php?key="+form.nick.value;
    fetch(link).then(onResponse).then(useJson).catch(Errore);
}

function onResponse(promise){
    return promise.json();
}

function useJson(json){
  let flagnew;
  for(j of json){
	if(j.righe>0) {
	   contenitorerrore.classList.remove('hidden');
       p.textContent="Nome utente già in uso";
	   flagnew=1;
	}else{
	   flagnew=0;
	   //p.textContent="";
	}
	if (flagnew==0 && flag==1) {contenitorerrore.classList.add('hidden');}
	flag=flagnew;
  }
}

function Errore(){
    console.log("Errore nella fetch");
}
let contenitorerrore = document.querySelector('.error');
contenitorerrore.classList.add('hidden');
