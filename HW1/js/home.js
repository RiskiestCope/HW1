
let stringacontenuti = new Array();
let ultimaraccoltascelta;
let pul=0;

function onRespons(response)
{
    document.querySelector("h1").textContent = "Modifica effettuata con successo!";
}

function OnResponse(promise) {
	//console.log(promise.json());
	return promise.json();
}

function hidden() {
	let tab = document.getElementById("Tabella");
	var child = tab.lastElementChild;  
        while (child) { 
            tab.removeChild(child); 
            child = tab.lastElementChild; 
        } 
}

function caricaraccolta(event) {
	let raccolta=event.currentTarget;
	if (raccolta===ultimaraccoltascelta && pul===0){ // se l'ultima volta lo si è visto e si riclicca lo stesso lo cancella
		hidden();                                      
		pul=1;
		titoloracscelta.classList.add('hidden');
		contenitore.classList.remove('hidden');
	}else{
		pul=0;
		titoloracscelta.classList.remove('hidden');
		contenitore.classList.add('hidden');
		raccolta.removeEventListener('click',f_rimuovi);
		raccolta.addEventListener('click',hidden);
		const raccoltascelta = event.currentTarget.getAttribute("value");
		titoloracscelta.textContent="Raccolta: "+raccoltascelta;
		const url="http://localhost/HW1/fetch/collections.php";
		const form_data = new FormData();
		form_data.append("raccolta", raccoltascelta);
		fetch(url, {method: 'post', body: form_data}).then(OnResponse).then(information).catch(function(error) { console.log(error); });
    }
	ultimaraccoltascelta=event.currentTarget;
}

function f_rimuovi(event){
	let user = document.getElementById("user");
	const scelta = event.currentTarget.getAttribute("value");
	console.log(stringacontenuti[scelta]);
	console.log(ultimaraccoltascelta.getAttribute("value"));
	console.log(user.value);
    const url="http://localhost/HW1/rimuovicanzone.php";
    const form_data = new FormData();
    form_data.append("raccolta", ultimaraccoltascelta.getAttribute("value"));
    form_data.append("contenuto", stringacontenuti[scelta]);
	form_data.append("username", user.value);
    fetch(url, {method: 'post', body: form_data}).then(onRespons);
}	

function information(json){ 
            let i;
			let max=json.length; //numero di contenuti inseriti;
			let j=stringacontenuti.length - 1;
			if(max==0){
				contenitore.textContent="Nessun risultato";
				//contenitore.classList.remove('hidden');
			}
			for(let i=0; i<max;i++){
				j++;
				grid=document.getElementById("Tabella");
				const image = document.createElement('img');
				const titoloalbum =document.createElement('div');
				const nomecanzone=document.createElement('div');
				const artista=document.createElement('div');
				const aggiungisong=document.createElement('button');
				const k=document.createElement('div');
				nomecanzone.classList.add('Follower');
				k.classList.add('elemento_grid');
			    let ris=json[i].contenuto.split(';'); //divide il risultato del db;
			    artista.classList.add('Titolo_Artista');
			    nomecanzone.classList.add('Follower');
			    titoloalbum.classList.add('Genere');
			    aggiungisong.classList.add('elimina');
				aggiungisong.value=j;
			    aggiungisong.addEventListener('click',f_rimuovi);
			    image.src = ris[0];
				artista.textContent=ris[2];
				titoloalbum.textContent="Album : "+ris[3];
				nomecanzone.textContent="Titolo : "+ris[1];
                aggiungisong.textContent="Rimuovi";
			    k.appendChild(image);
				k.appendChild(artista);
				k.appendChild(titoloalbum);
				k.appendChild(nomecanzone);
				k.appendChild(aggiungisong);
				grid.appendChild(k);
				stringacontenuti[j]=json[i].contenuto;
			}
}
let contenitore = document.querySelector('.titolo');
let titoloracscelta=document.querySelector('.raccoltascelta');
//contenitore.classList.add('hidden');

const boxes = document.querySelectorAll('.Aggiungi input[type=button]');
for (const box of boxes)
{
  box.addEventListener('click', caricaraccolta);
}