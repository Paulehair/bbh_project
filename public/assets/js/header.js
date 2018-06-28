const ui = {
  burger: document.querySelector('.Header_burger'),
  menu: document.querySelector('.Header_nav_box_menu'),
  nav: document.querySelector('.Header_nav'),
  roll: document.querySelector('#roll')
}

// HEADER
ui.burger.addEventListener('click', () => {
  ui.nav.classList.toggle('flex');
});

ui.roll.addEventListener('click', () => {
  ui.menu.classList.toggle('flexCol');
});