const ui = {
  cards: document.querySelectorAll('.Card_slider_ctnr'),
  menu: document.querySelector('.Header_nav_box_menu'),
  img: document.querySelector('.Map_img')
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
