let testoinserito;
let count=0;

function Inserimento(event)
{
	const bottone = event.currentTarget;
	let new_h1 = document.querySelector('.GestioneRisultati h1');
	contenitore.classList.remove('hidden');
	testoinserito=document.querySelector('.Aggiungig input[type=text]');
	if(testoinserito.value.length == 0){
		new_h1.textContent="Inserisci Nome Raccolta!!";
		event.preventDefault();
	}
}

function Cancella()
{
	count++;
	if(count<2){
		contenitore.classList.remove('hidden');
		new_h1.textContent="Sei proprio sicuro?";
		event.preventDefault();
	}
}


let new_h1 = document.querySelector('.GestioneRisultati h1');
let contenitore = document.querySelector('.GestioneRisultati');
contenitore.classList.add('hidden');
/*
const canc = document.querySelector('.Aggiungig input[type=button]');
canc.addEventListener('click', Cancella);
*/
let form = document.forms['crea'];
form.addEventListener('submit', Inserimento);
let canc = document.forms['elimina'];
canc.addEventListener('submit', Cancella);