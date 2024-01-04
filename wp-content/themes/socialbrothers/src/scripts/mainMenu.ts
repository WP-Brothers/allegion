
const mainMenu = (menu: HTMLElement) => {
  const dropdowns = menu.querySelectorAll('.menu__item--has-children');

  const closeAll = () => {
    dropdowns.forEach((dropdown) => {
      dropdown.classList.remove('show');
    });
  }

  dropdowns.forEach((dropdown) => {
    const link = dropdown.querySelector('a');

    link?.addEventListener('click', (e) => {
      e.preventDefault();
      closeAll()
      dropdown.classList.toggle('show');
    });
  });

  document.addEventListener('scroll', () => {
    closeAll()
  });
};

export default mainMenu;
