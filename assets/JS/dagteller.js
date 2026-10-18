//const today = new Date().getTime();
//const year = new Date(today).getFullYear();
const month = new Date().getMonth();
const months = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];
const dagen = ['zondag', 'maandag', 'dinsdag', 'woensdag', 'donderdag', 'vrijdag', 'zaterdag'];
const schrijfdag = document.getElementById("schrijfdag");
const dagenverschil = document.getElementById("dagenverschil");

const datumkiezer = document.getElementById("datumkiezer");
const maandkiezer = document.getElementById("maandkiezer");
const jaarkiezer = document.getElementById("select_year");
jaarkiezer.value = new Date().getFullYear();

/*
const date = [...Array.from(Array(31), (_, i) => i + 1)];

let seldate = document.createElement("select");
let selmonth = document.createElement("select");
let selyear = document.createElement("select");

date.map(da => {
	let option = document.createElement("option");
	option.value = da;
	option.innerText = da;
	seldate.selectedIndex = (new Date().getDate() - 1);
	seldate.appendChild(option);
	datumkiezer.appendChild(seldate);
})

months.map(maand => {
	let option = document.createElement("option");
	option.value = maand;
	option.innerText = maand;
	selmonth.selectedIndex = new Date().getMonth();
	selmonth.appendChild(option);
	maandkiezer.appendChild(selmonth);
})

document.getElementById('currentyear').innerHTML = `(${year})?`;
*/

// Deel 1: Aantal dagen vanaf feestdag berekenen  

/* 
const feestdagen = [
	{ date: null, disabled: true, text: 'Selecteer feestdag' },
	{ month: 1, date: 1, text: 'Nieuwjaarsdag' },
	{ month: 5, date: 5, class: 'orange', text: 'Bevrijdingsdag' },
	{ month: 11, date: 3, class: 'orange', text: 'Mijn verjaardag' },
	{ month: 12, date: 5, text: 'Sinterklaas' },
	{ month: 12, date: 25, text: 'Kerst' },
	{ month: 12, date: 31, text: 'Oudjaar' }
]

Prinsjesdag 

let Prinsjesdag;
const firstSeptember = new Date(year, 8, 1).getTime();
const diffFirstTuesdaySeptember = (new Date(firstSeptember).getDay() - 2);

(diffFirstTuesdaySeptember > 0) ?
	Prinsjesdag = 22 - diffFirstTuesdaySeptember :
	Prinsjesdag = 15 - diffFirstTuesdaySeptember;
feestdagen.push({ month: 9, date: Prinsjesdag, text: 'Prinsjesdag' });

// Hemelvaart & Pinksteren 
const ascensionDay = (new Date(Easter).getTime() + (39 * 86400000));
const penteCost = (new Date(Easter).getTime() + (49 * 86400000));

feestdagen.push({ month: (new Date(Easter).getMonth() + 1), date: new Date(Easter).getDate(), text: 'Pasen' });
feestdagen.push({ month: (new Date(ascensionDay).getMonth() + 1), date: new Date(ascensionDay).getDate(), text: 'Hemelvaart' });
feestdagen.push({ month: (new Date(penteCost).getMonth() + 1), date: new Date(penteCost).getDate(), text: 'Pinksteren' });
feestdagen.push({ month: 4, date: 27, text: 'Koningsdag' });
*/




					/* sorteer feestdagen naar datum en maak selectievenster 

					feestdagen.sort((a, b) =>
						(a.month > b.month) ? 1 :
							(b.month > a.month) ? -1 : 0).
						map(fd => {

							const newOption = document.createElement('option');
							newOption.label = fd.text;
							newOption.innerText = fd.text;
							if (fd.class) {
								newOption.setAttribute('class', fd.class);
							}
							if (fd.disabled) {
								newOption.setAttribute('disabled', '');
								newOption.setAttribute('selected', '');
							}
							document.getElementById('dagen').appendChild(newOption);

						})
							
				})
		})
}

*/

/*
function bepaalFeestdag(sel) {

	let d = document.getElementById("dagen").value;

	if (d === "Prinsjesdag") {
		calculatePrinsjesdag()
	}

	if (d === "Ramadan") {
		calculateRamadan()
	}
	else {

		/* 
		opmaak met slash is relevant voor iOS 
		(zie https://neilsteventon.wordpress.com/2014/11/17/javascript-new-date-nan-on-iphone/ 
		*/

	/*	for (let i = 0; i < feestdagen.length; i++) {

			if (feestdagen[i].text === sel.options[sel.selectedIndex].text) {

				let nieuwedag = new Date(feestdagen[i].month + '/' + feestdagen[i].date + '/' + year).getTime();
				let bepaaldag = new Date(feestdagen[i].month + '/' + feestdagen[i].date + '/' + year).getDay();

				let dagteller = ((nieuwedag - today) / 86400000);

				//vandaag
				if (dagteller > -1 && dagteller < 0) {
					schrijfdag.innerHTML = `${sel.options[sel.selectedIndex].text} is vandaag, ofwel ${Math.floor(dagteller + 1)} nachtjes slapen :)`;
				}

				//gisteren
				else if (dagteller > -2 && dagteller < -1) {
					schrijfdag.innerHTML = `${sel.options[sel.selectedIndex].text} was gisteren.`;
				}
				// en duurt nog ${Math.floor(dagtellerjl+1)} dagen (in ${jaar+1}).`}

				//dag al geweest in lopende jaar 
				/*
				else if (dagteller < -2) {

					for (let i = 0; i < feestdagen.length; i++) {

						if (feestdagen[i].text === sel.options[sel.selectedIndex].text) {
							const monthToSelection = feestdagen[i].month;
							const dateToSelection = feestdagen[i].date

							schrijfdag.innerHTML = `${sel.options[sel.selectedIndex].text} (${dateToSelection} ${months[monthToSelection - 1]}) was ${Math.floor(dagteller + 1) * -1} dagen geleden en viel op ${dagen[bepaaldag]}.`;
						}
					}
				}

				/*morgen
				else if (dagteller < 1 && dagteller > 0) {
					schrijfdag.innerHTML = `${sel.options[sel.selectedIndex].text} is morgen ofwel nog ${Math.floor(dagteller + 1)} nachtje slapen.`;
				}

				else {

					for (let i = 0; i < feestdagen.length; i++) {

						if (feestdagen[i].text === sel.options[sel.selectedIndex].text) {
							const monthToSelection = feestdagen[i].month;
							const dateToSelection = feestdagen[i].date


							schrijfdag.innerHTML =
								`${sel.options[sel.selectedIndex].text} (${dateToSelection} ${months[monthToSelection - 1]}) is nog <strong> ${Math.floor(dagteller + 1)} nachtjes</strong> slapen en valt op <strong>${dagen[bepaaldag]}.</strong>`;
							//	showButtonCountDown(); setInterval stopt niet na selectie andere datum

						}
					}
				}
			}
		}
	}
	*/

	
/*
	function calculatePrinsjesdag() {

		const datePrinsjesdag = new Date(year, 8, Prinsjesdag).getTime();

		const textPrinsjesdag = `Prinsjesdag (de derde dinsdag in september) valt op 
		<strong> ${Prinsjesdag} september </strong> en`

		if ((datePrinsjesdag - today) > -86400000 && datePrinsjesdag - today < 0) {
			schrijfdag.innerHTML = textPrinsjesdag + ' is vandaag.';
		}

		else if ((datePrinsjesdag - today) <= -86400000 && (datePrinsjesdag - today) > 2 * -86400000) {
			schrijfdag.innerHTML = `Prinsjesdag (de derde dinsdag in september) viel op <strong> ${Prinsjesdag} september </strong>
		en was gisteren.`
		}

		else if ((datePrinsjesdag - today) < (2 * -86400000)) {
			schrijfdag.innerHTML = `Prinsjesdag (de derde dinsdag in september) viel op <strong> ${Prinsjesdag} september </strong>
			en is ${Math.floor((datePrinsjesdag - today) / -86400000)} dagen geleden.`
		}

		else if ((datePrinsjesdag - today) <= 86400000 && (datePrinsjesdag - today) > 0) {
			schrijfdag.innerHTML = textPrinsjesdag + ' is morgen.'
		}
		else if ((datePrinsjesdag - today) > 86400000) {
			schrijfdag.innerHTML = textPrinsjesdag + ` is nog ${Math.floor((datePrinsjesdag - today) / 86400000)} nachtjes slapen.`
		}
	}
*/


// Deel 2: dag achterhalen en historische gebeurtenissen 

/*
datumkiezer.addEventListener('change', () => berekendag())
maandkiezer.addEventListener('change', () => berekendag());
jaarkiezer.addEventListener('change', () => berekendag());

const specialDates = [
	{
		date: '1-2-1953', event: 'Watersnoodramp', link: 'Watersnood_van_1953', sound: 'Watersnoodramp',
		image: './images/Watersnoodramp.jpg'
	},
	{
		date: '22-2-1944', event: 'Bombardement op Nijmegen', link: 'Bombardement_op_Nijmegen',
		image: 'bombardement_nijmegen.jpeg'
	},
	{ date: '6-5-2002', event: 'Moord op Pim Fortuyn', link: 'Pim_Fortuyn', image: './images/PimFortuyn.jpg' },
	{
		date: '11-9-2001', event: 'Aanslag op World Trade Center', link: 'World_Trade_Center_(1973-2001)',
		image: './images/WTC.jpg'
	},
	{
		date: '9-11-1938', event: 'Reichskristallnacht', link: 'Kristallnacht',
		image: './images/kristallnacht.jpg'
	},
	{ date: '9-11-1989', event: 'Val van de Berlijnse Muur', link: 'Berlijnse_Muur', image: './images/BerlinWall.jpg' },
	{ date: '30-1-1972', event: 'Bloody Sunday', link: 'Bloody_Sunday_(1972)' },
	{
		date: '14-4-1912', event: 'Ramp met de Titanic', link: 'Titanic_(schip,_1912)', image:
			'./images/Titanic.jpg'
	},
	{
		date: '10-5-1940', event: 'Nazi-Duitsland valt Nederland binnen', link: 'Nederland_in_de_Tweede_Wereldoorlog', image:
			'./images/Inval.jpg',
		sound: '10mei1940'
	},
	{
		date: '20-7-1969', event: 'Neil Armstrong zet voet op de Maan', link: 'Maanlanding', sound: 'Moonlanding',
		image:
			'./images/moonlanding.jpg'
	}

]


function berekendag() {
	//document.getElementById('onthisday').style.display = 'none';
	document.getElementById('specialdates').innerHTML = '';

	let datum = seldate.selectedIndex + 1;
	let maand = selmonth.selectedIndex + 1;
	let thisyear = jaarkiezer.value;

	if (thisyear < 1900) {
		alert('Het jaartal mag niet onder 1900 liggen.');
	} else if ((maand === 2 || maand === 4 || maand === 6 || maand === 9 || maand === 11) && datum === 31) {
		alert('Ongeldige datum');
	} else if (maand === 2 && datum === 30 || (year % 4 != 0 && maand === 2 & datum === 29)) {
		alert('Ongeldige datum');
	} else {


		let ingevoerdedatum = new Date(`${maand}/${datum}/${thisyear}`).getTime();

		let dag = new Date(ingevoerdedatum).getDay();

		ingevoerdedatum - today <= -86400000 ?
			document.getElementById("toondag").innerHTML = `${datum} ${months[maand - 1]} ${thisyear} viel op <b>${dagen[dag]}</b>` :
			document.getElementById("toondag").innerHTML = `${datum} ${months[maand - 1]} ${thisyear} valt op <b>${dagen[dag]}</b>`;

		jaarkiezer.value == new Date().getFullYear() ?

			(ingevoerdedatum - today > -86400000 && ingevoerdedatum - today < 0) ?
				dagenverschil.innerHTML = '(is vandaag).' :

				(ingevoerdedatum - today > -2 * 86400000 && ingevoerdedatum - today < -86400000) ?
					dagenverschil.innerHTML = '(was gisteren).' :

					(ingevoerdedatum - today < 86400000 && ingevoerdedatum - today > 0) ?
						dagenverschil.innerHTML = '(is morgen).' :

						(ingevoerdedatum - today <= -86400000 ?
							dagenverschil.innerHTML = `(${Math.floor((ingevoerdedatum - today) / -86400000)} dagen geleden)` :
							dagenverschil.innerHTML = `(over ${Math.floor((ingevoerdedatum - today) / 86400000) + 1} dagen).`)


			: dagenverschil.innerHTML = '';

	

	}
}
		*/

	// getEventsOnDate();

document.addEventListener('DOMContentLoaded', getEventsOnDate);

function getEventsOnDate() {
	// document.querySelector('.color2').style.height = '33vh';
	const filterSpecialDates = specialDates.filter(sd => sd.date.split('-')[0] == seldate.selectedIndex + 1 &&
		sd.date.split('-')[1] == selmonth.selectedIndex + 1)
	if (filterSpecialDates.length > 0) {
		document.getElementById('onthisday').style.display = 'block';
		document.querySelector('.color2').style.height = 'auto';


		filterSpecialDates.forEach(fsd => {
			const div = document.createElement('div');
			div.setAttribute('class', 'container');
			div.innerHTML +=
				`${fsd.date.split('-')[2]} (${new Date(today).getFullYear() - fsd.date.split('-')[2]} jaar geleden): <br> 
					<a target = "blank" href= 'https://nl.wikipedia.org/wiki/${fsd.link}'> ${fsd.event}</a> <p>
					<img id="playstop">
					<img src= ${fsd.image}>`;

			document.getElementById('specialdates').append(div);

			const playStop = document.getElementById('playstop')

			playStop.style.visibility = 'hidden';

			if (!fsd.sound) {
				playStop.style.width = '0px';
				playStop.style.height = '0px';
				playStop.src = '';
			}

			else {
				playStop.style.visibility = 'visible';
				playStop.src = './play_white.png';
				playStop.addEventListener('click', function () {

					if (playStop.src = './play_white1.png') {
						document.getElementById('sound').src = `./sound/${fsd.sound}.mp3`;
						document.getElementById('sound').play();
					}

				})

			}

		})

		let blinkOnThisDay = setInterval(showBlinking, 300);

		function showBlinking() {
			document.getElementById('onthisday').classList.toggle('unvisible');
			document.getElementById('onthisday').style.display = 'block';
		}

		setTimeout(stopBlinking, 2450);

		function stopBlinking() {
			clearInterval(blinkOnThisDay);
		}

	}
}



