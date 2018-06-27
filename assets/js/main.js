const ui = {
  planets: document.querySelectorAll('.t'),
  cards: document.querySelectorAll('.Card_ctnr'),
  card: document.querySelectorAll('.Card')
}

const style = {
  boxShad: "0 0 80px rgba(56, 30, 85, 1)"
}

TweenMax.to(ui.planets, 4, {
  y: 20,
  yoyo: true,
  repeat: -1
});

// Map
for (let i = 0; i < ui.cards.length; i++) {
  ui.cards[i].addEventListener('click', () => {
    for (let a = 0; a < ui.planets.length; a++) {
      if (ui.cards[i].dataset.planet ===  ui.planets[a].dataset.planet) {

        ui.planets[a].style.boxShadow = style.boxShad;
        ui.planets[a].style.width = "4em";
        ui.planets[a].style.height = "4em";

      } else if (ui.planets[a].style.boxShadow = style.boxShad) {

        ui.planets[a].style.boxShadow = "";
        ui.planets[a].style.width = "3em";
        ui.planets[a].style.height = "3em";
        
      }
    }
  });
}
