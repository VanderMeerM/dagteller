
//Ramadan 


function GetRamadanAndSortSelection() {
	fetch(`https://api.aladhan.com/v1/gToH/${new Date().getDate()}-${new Date().getMonth() + 1}-${new Date().getFullYear()}`)
		.then((res) => res.json())
		.then((data) => {

			const IslYear = parseInt(data.data.hijri.year);

			fetch(`https://api.aladhan.com/v1/hToG/01-09-${IslYear}`)
				.then((res => res.json()))
				.then((data) => {
					feestdagen.push({ month: parseInt(data.data.gregorian.month.number), date: parseInt(data.data.gregorian.day), text: 'Ramadan' });

					fetch(`https://api.aladhan.com/v1/hToG/01-09-${IslYear + 1}`)
						.then((res => res.json()))
						.then((data) => {

							if (parseInt(data.data.gregorian.year) == year) {
								feestdagen.push({ month: parseInt(data.data.gregorian.month.number), date: parseInt(data.data.gregorian.day), text: 'Ramadan' });

							}
						})

                        					
				})
		})
}

GetRamadanAndSortSelection()

function calculateRamadan() {
		const month = new Date().getMonth() + 1;

		fetch(`https://api.aladhan.com/v1/gToH/${new Date().getDate()}-${month}-${year}`)
			.then((res) => res.json())
			.then((data) => {

				const IslYear = parseInt(data.data.hijri.year);
				const IslMonth = parseInt(data.data.hijri.month.number);

				fetch(`https://api.aladhan.com/v1/hToG/01-09-${IslYear}`)
					.then((res => res.json()))
					.then((data) => {

						const countDaysTillRamadan = Math.ceil((new Date(year, data.data.gregorian.month.number - 1, parseInt(data.data.gregorian.day)) - today) / 86400000);
						// schrijfdag.innerHTML+= `Ramadan begint op ${parseInt(data.data.gregorian.day)} ${months[data.data.gregorian.month.number-1]} (over ${countDaysTillRamadan} dagen) `;


						fetch(`https://api.aladhan.com/v1/hToG/01-10-${IslYear}`)
							.then((res => res.json()))
							.then((datas) => {

								if (IslMonth == 9) {
									schrijfdag.innerHTML = `Het is nu Ramadan (begonnen op ${parseInt(data.data.gregorian.day)} ${months[data.data.gregorian.month.number - 1]}; 
		eindigt op ${parseInt(datas.data.gregorian.day - 1)} ${months[datas.data.gregorian.month.number - 1]} (Suikerfeest).`;
								}


								else if (new Date(year, data.data.gregorian.month.number - 1, parseInt(data.data.gregorian.day)).getTime() - today > 0) {

									schrijfdag.innerHTML =
										`Ramadan begint op ${parseInt(data.data.gregorian.day)} ${months[data.data.gregorian.month.number - 1]} (over ${countDaysTillRamadan} dagen)
	en eindigt op ${parseInt(datas.data.gregorian.day - 1)} ${months[datas.data.gregorian.month.number - 1]} (Suikerfeest).<br>`;
								}

								else if (new Date(year, datas.data.gregorian.month.number - 1, parseInt(datas.data.gregorian.day)).getTime() - today < 0) {

									schrijfdag.innerHTML = `Ramadan was van ${parseInt(data.data.gregorian.day)} ${months[data.data.gregorian.month.number - 1]} tot
		${parseInt(datas.data.gregorian.day - 1)} ${months[datas.data.gregorian.month.number - 1]}.`;
								}
							}

							)
					})

				fetch(`https://api.aladhan.com/v1/hToG/01-09-${IslYear + 1}`)
					.then((res => res.json()))
					.then((data) => {

						if (parseInt(data.data.gregorian.year) == year) {
							schrijfdag.innerHTML += `Daarnaast in dit jaar op ${parseInt(data.data.gregorian.day)} ${months[data.data.gregorian.month.number - 1]}; `;

							fetch(`https://api.aladhan.com/v1/hToG/01-10-${IslYear + 1}`)
								.then((res => res.json()))
								.then((data) => {
									schrijfdag.innerHTML += `einde op ${parseInt(data.data.gregorian.day - 1)} ${months[data.data.gregorian.month.number - 1]}.<br>`;
								})
						}


					})

			});
	}


