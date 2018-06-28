const ui = {
  cards: document.querySelectorAll('.Card_slider_ctnr'),
  img: document.querySelector('.Map_img')
}

// FLOAT ANIM
TweenMax.to(ui.img, 4, {
  y: 30,
  yoyo: true,
  repeat: -1
});

// MAP
for (let i = 0; i < ui.cards.length; i++) {
  ui.cards[i].addEventListener('click', () => {
    ui.img.setAttribute("src", "assets/img/p" + i + ".png");
  });
}

