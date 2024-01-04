
const mainMenu = (menu: HTMLElement) => {
  const dropdowns = menu.querySelectorAll('.menu__item--has-children');

  const closeAll = (currentdropdown?: Element) => {
    if(currentdropdown) {
      dropdowns.forEach((dropdown) => {
        if(currentdropdown.id !== dropdown.id) {
          dropdown.classList.remove('show');
        }
      });
    } else {

      dropdowns.forEach((dropdown) => {
        dropdown.classList.remove('show');
      });
    }
  }

  dropdowns.forEach((dropdown) => {
    const link = dropdown.querySelector('a');

    link?.addEventListener('click', (e) => {
      e.preventDefault();
      closeAll(dropdown)
      dropdown.classList.toggle('show');
    });
  });

  document.addEventListener('scroll', () => {
    closeAll()
  });
};

export default mainMenu;
