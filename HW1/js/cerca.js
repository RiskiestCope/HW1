let CanzoneInserita;
let stringacontenuti = new Array();

function GestioneClick(event)
{
	const bottone = event.currentTarget;
	let new_h1 = document.querySelector('.GestioneRisultati h1');
	var flag=0;
	contenitore.classList.remove('hidden');
	CanzoneInserita=document.querySelector('.Aggiungi input[type=text]');
	if(CanzoneInserita.value.length == 0){
		new_h1.textContent="Inserisci il titolo della canzone o il nome dell'artista";
		flag=1;
	}else{ 
	        new_h1.textContent="Risultati...";
			fetchdata();
    }
}


function OnResponse(promise) {
	return promise.json();
}


function fetchdata() {
	link="http://localhost/HW1/fetch/do_search.php?Cerca="+CanzoneInserita.value;
	fetch(link).then(OnResponse).then(information).catch(function(error) { console.log(error); });

}
function onText(text)
{
    document.querySelector("h1").textContent = text;
}

function onRespons(response)
{
    document.querySelector("h1").textContent = "";
    return response.text();
}


function f_aggiungi (event){
	const scelta = event.currentTarget.getAttribute("value");
    //event.currentTarget.removeEventListener('click',f_aggiungi);
    raccolta= document.getElementById("raccolta"); // playlist selezionata;
	user = document.getElementById("user"); // tramite input hidden recupera l'username
    const url="http://localhost/HW1/fetch/inserimentocontenuti.php";
    const form_data = new FormData();
    form_data.append("content", stringacontenuti[scelta]);
    form_data.append("username", user.value);
	form_data.append("raccolta", raccolta.value);
    fetch(url, {method: 'post', body: form_data}).then(onRespons).then(onText);
}


function information(json){ 
			document.querySelector("#Tabella").innerHTML="";
			const max=json.tracks.total;
			let i;
			//funziona
			let j=stringacontenuti.length - 1;
			if(max==0){
				new_h1.textContent="Nessun risultato";
				contenitore.classList.remove('hidden');
			}
		    for(i=0; i<max; i++){
				j++;
				grid=document.getElementById("Tabella");
				const image = document.createElement('img');
				const titoloalbum =document.createElement('div');
				const nomecanzone=document.createElement('div');
				const artista=document.createElement('div');
				const aggiungisong=document.createElement('button');
				const k= document.createElement('div');
				nomecanzone.classList.add('Follower');
				k.classList.add('elemento_grid');
				artista.textContent=json.tracks.items[i].artists[0].name;
				artista.classList.add('Titolo_Artista');
				nomecanzone.textContent= json.tracks.items[i].name;
				nomecanzone.classList.add('Follower');
				titoloalbum.textContent="Album : "+ json.tracks.items[i].album.name;
				titoloalbum.classList.add('Genere');
				aggiungisong.textContent="Aggiungi";
				aggiungisong.value=j;
				aggiungisong.classList.add('elimina');
				aggiungisong.addEventListener('click',f_aggiungi);
				image.src = json.tracks.items[i].album.images[0].url;
				k.appendChild(image);
				k.appendChild(artista);
				k.appendChild(titoloalbum);
				k.appendChild(nomecanzone);
				k.appendChild(aggiungisong);
				grid.appendChild(k);
                stringacontenuti[j]=json.tracks.items[i].album.images[0].url +";"+json.tracks.items[i].name +";" +json.tracks.items[i].artists[0].name +";"+ json.tracks.items[i].album.name; 
			    //console.log(stringacontenuti[i]);
			}
}

function Error() {
	console.log("Siamo spiacenti, si e' verificato un errore!");
}


let contenitore = document.querySelector('.GestioneRisultati');
contenitore.classList.add('hidden');
const bottone = document.querySelector('.Aggiungi input[type=button]');
bottone.addEventListener('click', GestioneClick);
