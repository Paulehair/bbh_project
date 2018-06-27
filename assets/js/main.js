const ui = {
  cards: document.querySelectorAll('.Card_slider_ctnr'),
  img: document.querySelector('.Map_img'),
  burger: document.querySelector('.Header_burger'),
  menu: document.querySelector('.Header_nav_box_menu'),
  nav: document.querySelector('.Header_nav'),
  roll: document.querySelector('#roll')
}

const style = {
  boxShad: "0 0 80px rgba(56, 30, 85, 1)"
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

// HEADER
ui.burger.addEventListener('click', () => {
  ui.nav.classList.toggle('flex');
});

ui.roll.addEventListener('click', () => {
    ui.menu.classList.toggle('flexCol');
});

