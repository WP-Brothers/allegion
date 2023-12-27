const header = (header: HTMLElement) => {
  const toggleNavButton = header.querySelector('#toggle-header-nav');
  const nav = header.querySelector('#header-nav');

  const toggleSearchButton = header.querySelector('#toggle-header-search');
  const search = header.querySelector('#header-search');

  toggleNavButton?.addEventListener('click', () => {
    toggleNavButton.classList.toggle('active');
    nav?.classList.toggle('hidden');
    nav?.classList.toggle('grid');
    header.classList.toggle('fixed');
    header.classList.toggle('sticky');
    document.body.classList.toggle('pt-20');

    if (toggleNavButton.classList.contains('active')) {
      document.body.style.maxHeight = '100vh';
      document.body.style.overflow = 'hidden';
      document.body.classList.remove('after:hidden');
    } else {
      document.body.style.maxHeight = 'unset';
      document.body.style.overflow = 'unset';
      document.body.classList.add('after:hidden');
    }
  });

  toggleSearchButton?.addEventListener('click', () => {
    search?.classList.toggle('hidden');
  });
};

export default header;
