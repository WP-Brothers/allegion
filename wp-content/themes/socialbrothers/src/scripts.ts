const scriptsInit = () => {
  const sliders = document.querySelectorAll('.slider');
  if (sliders.length) {
    sliders?.forEach((slider) =>
      import('./scripts/swiper').then((module) =>
        module.default(slider as HTMLElement)
      )
    );
  }

  const formsComplex = document.querySelectorAll('.form-complex');
  if (formsComplex.length) {
    formsComplex?.forEach((formComplex) =>
      import('./scripts/formComplex').then((module) =>
        module.default(formComplex as HTMLElement)
      )
    );
  }

  const headers = document.querySelectorAll('#header');
  if (headers.length) {
    headers?.forEach((header) =>
      import('./scripts/header').then((module) =>
        module.default(header as HTMLElement)
      )
    );
  }

  const menuMains = document.querySelectorAll(
    '.menu-main:not(.menu-main--hover)'
  );
  if (menuMains.length) {
    menuMains?.forEach((menuMain) =>
      import('./scripts/mainMenu').then((module) =>
        module.default(menuMain as HTMLElement)
      )
    );
  }


      import('./scripts/scrollToTop').then((module) => module.default());
};

export default scriptsInit;
