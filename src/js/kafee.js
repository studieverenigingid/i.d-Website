let minuteInSecs = 60 * 1000,
  hourInSecs = 60 * minuteInSecs,
  dayInSecs = 24 * hourInSecs;


function hourDiff(u) {
  return Math.floor( (u % dayInSecs) / hourInSecs * 1);
}

function minuteDiff(m) {
  return Math.floor( ( (m % dayInSecs) % hourInSecs) / minuteInSecs * 1);
}

function secondDiff(s) {
  return Math.floor( ( ( (s % dayInSecs) % hourInSecs) % minuteInSecs) / 1000 * 1);
}


function aftellen() {

	let wrapper = document.getElementById('isitkafee'),
		yesOrNo = document.getElementById('yesorno'),
		countdownEl = document.getElementById('countdown');

  wrapper.classList.add("isitkafee--no");
  yesOrNo.innerText = "NO";

  /* hoe laat is het nu?*/
  let momenteel = new Date(),
    jaarnu = momenteel.getYear(),
    mndnu = momenteel.getMonth(),
    dagnu = momenteel.getDate(),
    dedag = momenteel.getDay(),
    uurnu = momenteel.getHours(),
    minnu = momenteel.getMinutes(),
    secnu = momenteel.getSeconds();

  /* correcties */
  if (jaarnu < 1000) jaarnu += 1900;
  let mndcor = [ "Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec" ];

  /* data */
  let datum = dagnu + " " + mndcor[mndnu] + ", " + jaarnu,
    moment = datum + " " + uurnu + ":" + minnu + ":" + secnu,
    kafeebegin = datum + " 17:00:00",
    kafeeeind = datum + " 21:30:00",
    einddag = datum + " 23:59:59";

  /* hoeveel dagen nog? */
  let dagen = (dedag > 3) ? 10 - dedag : 3 - dedag;

  /* verschil tot 17 uur */
  verschil = Date.parse(kafeebegin) - Date.parse(moment);
  let duur = hourDiff(verschil),
    dmin = minuteDiff(verschil),
    dsec = secondDiff(verschil);


  if (dedag == 3) { /* als het woensdag is */
    if (verschil > 0) { /* aftellen tot het 17 uur is */
      yesOrNo.innerText = "ALMOST";
      countdownEl.innerText = "only " + duur + " hours, " + dmin + " minutes and " + dsec + " seconds left.";
    } else { /* het is 17 uur geweest! */
      verschil = Date.parse(kafeeeind) - Date.parse(moment);
      let duur = hourDiff(verschil),
        dmin = minuteDiff(verschil),
        dsec = secondDiff(verschil);


      if (verschil >= 0) { /* het is kafee!*/
        yesOrNo.innerText = "JA!";
        wrapper.classList.add("isitkafee--yes");
        countdownEl.innerText = "Enjoy!";

      } else { /* kafee is over :( begin teller tot de volgende */
        verschil = Date.parse(einddag) - Date.parse(moment);
        let duur = hourDiff(verschil),
          dmin = minuteDiff(verschil),
          dsec = secondDiff(verschil);

        yesOrNo.innerText = "NIET MEER";
        countdownEl.innerText = "ID Kafee is over :( See you next week!";

      }
    }
  } else { /* het is geen woensdag */
    if (verschil > 0) { /* aftellen tot het 17 uur is */
      /* eventjes grammaticaal correct wezen */
      dagen += (dagen == 1) ? " day" : " days";
      countdownEl.innerText = "only " + dagen + ", " + duur + " hours, " + dmin + " minutes and " + dsec + " seconds left.";
    } else { /* het is 17 uur geweest, nu aftellen tot de volgende 17 uur */
      verschil = Date.parse(einddag) - Date.parse(moment);
      let duur = hourDiff(verschil),
        dmin = minuteDiff(verschil),
        dsec = secondDiff(verschil);
      dagen = dagen - 1;
      /* eventjes grammaticaal correct wezen */
      dagen += (dagen == 1) ? " day" : " days";
      countdownEl.innerText = "only " + dagen + ", " + (17 + duur) + " hours, " + dmin + " minutes and " + dsec + "  seconds left.";
    }
  }

  /* we gaan elke seconde verversen */
  setTimeout("aftellen()", 1000)
}
