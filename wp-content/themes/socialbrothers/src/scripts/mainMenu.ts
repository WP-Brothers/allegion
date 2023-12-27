const mainMenu = (menu: HTMLElement) => {
  const dropdowns = menu.querySelectorAll('.menu__item--has-children');

  dropdowns.forEach((dropdown) => {
    const link = dropdown.querySelector('a');

    link?.addEventListener('click', (e) => {
      e.preventDefault();
      dropdown.classList.toggle('show');
    });
  });

  document.addEventListener('scroll', () => {
    dropdowns.forEach((dropdown) => {
      dropdown.classList.remove('show');
    });
  });
};

export default mainMenu;
