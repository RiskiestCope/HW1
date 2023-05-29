// Riferimento al form
const form = document.forms['login'];
// Aggiunge listener
form.addEventListener('submit',validazione);

function validazione(event)
{
	sectionerror.classList.remove('hidden');
	//let new_p = document.querySelector('p');
	const casella= document.querySelector('.error p');
    //stringerror.classList.add('hidden');
    // Verifica se tutti i campi sono riempiti
    if(form.username.value.length==0 || form.password.value.length == 0) {
        // Avvisa utente
		//console.log("Hai dimenticato qualcosa");
	    casella.textContent="Hai dimenticato qualcosa";
		sectionerror.classList.remove('hidden');
        // Blocca l'invio del form
        event.preventDefault();
    }
        
}
let sectionerror = document.querySelector('.error p');
sectionerror.classList.add('hidden');