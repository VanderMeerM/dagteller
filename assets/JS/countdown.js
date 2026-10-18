
// Deel 3: countdown tot eerstvolgende testalarm op 1e maandag van de maand 12 uur Nederlandse tijd 

const today = new Date().getTime();
const months = ['januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december'];
const year = new Date(today).getFullYear();

function firstMondayinMonth() {

	let nextMonth = (new Date().getMonth()) + 1;
	let nextYear = year + 1;

	if (nextMonth > 11) { nextMonth == 0; year == nextYear; }

	const dayOfFirstDayInMonth = new Date(year, new Date().getMonth(), 1).getDay()
	const diffFirstDayInMonthToMonday = dayOfFirstDayInMonth - 1;

	let firstMondayInMonth = 7 - diffFirstDayInMonthToMonday + 1
	if (firstMondayInMonth > 7) {
		firstMondayInMonth -= 7
	}

	const dayOfFirstDayInNextMonth = new Date(year, nextMonth, 1).getDay()
	const diffFirstDayInNextMonthToMonday = dayOfFirstDayInNextMonth - 1;
	let firstMondayInMonthNextMonth = 7 - diffFirstDayInNextMonthToMonday + 1
	if (firstMondayInMonthNextMonth > 7) {
		firstMondayInMonthNextMonth -= 7
	}

	async function getTimeAmsterdam() {
		let apiUrl = `https://time.now/developer/api/timezone/Europe/Amsterdam`;

		try {
			const res = await fetch(apiUrl, { method: 'GET' });
			const data = await res.json()
			const hourAmsterdam = parseInt(data.datetime.split('T')[1].slice(0, 2));

			(data.dst) ?
				hourTestalarm = 10 + (new Date().getTimezoneOffset(hourAmsterdam) / -60) :
				hourTestalarm = 11 + (new Date().getTimezoneOffset(hourAmsterdam) / -60)

			let testAlarm = new Date(year, (new Date().getMonth()), firstMondayInMonth, hourTestalarm);
			let testAlarmNextMonth = new Date(year, nextMonth, firstMondayInMonthNextMonth, hourTestalarm);
			let testAlarmJanNextYear = new Date((year + 1), 0, firstMondayInMonthNextMonth, hourTestalarm);

			((testAlarm.getTime() + 86000) > today) ? sirene = testAlarm :
				sirene = testAlarmNextMonth;

			if (sirene.getTime() + 86000 - today < 0) {
				sirene = testAlarmJanNextYear;
			}

			let time = (sirene - today) / 1000;

			function showCountDown() {
				let days = Math.floor(time / (3600 * 24));
				let restday = time % (3600 * 24);
				let hours = Math.floor(restday / 3600);
				let resthour = restday % 3600;
				let minutes = Math.floor(resthour / 60);
				if (minutes < 10) {
					minutes = '0' + Math.floor(resthour / 60);
				}

				let seconds = Math.floor(resthour - minutes * 60).toFixed(0);
				if (seconds < 10) {
					seconds = '0' + Math.floor(resthour % 60);
				}

				let text =
					time <= 0 ?
						`Alarm gaat af...` :
						(days === 0) ?
							`${hours}:${minutes}:${seconds}` :
							(days === 1) ?
								`${days} dag ${hours}:${minutes}:${seconds}` :
								`${days} dagen ${hours}:${minutes}:${seconds}`

				document.getElementById('countdown').textContent = `(${sirene.getDate()} ${months[sirene.getMonth()]} ${year})`
				document.getElementById('nextFirstMondayinMonth').innerHTML = `<strong>${text}</strong>`;
				time--
			}

			showCountDown();

			let runCountdown = setInterval(() => {
				showCountDown();

				if (time <= -86) {
					clearInterval(runCountdown);
					firstMondayinMonth();
				}

			}
				, 1000)

		}

		catch (error) { console.log(error) }

	}

	getTimeAmsterdam()

}

firstMondayinMonth();