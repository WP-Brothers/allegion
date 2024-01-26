const scriptsInit = () => {
  const sliders = document.querySelectorAll('.slider');
  if (sliders.length) {
    sliders?.forEach((slider) =>
      import('./scripts/swiper').then((module) =>
        module.default(slider as HTMLElement)
      )
    );
  }

  const inputs = document.querySelectorAll('input');
  if (inputs.length) {
    inputs?.forEach((input) =>
      import('./scripts/input').then((module) =>
        module.default(input as HTMLInputElement)
      )
    );
  }

  const faqs = document.querySelectorAll('.faqs');
  if (faqs.length) {
    faqs?.forEach((faq) =>
      import('./scripts/faq').then((module) =>
        module.default(faq as HTMLElement)
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

  const modals = document.querySelectorAll('.contains-modal');
  if (modals.length) {
    modals?.forEach((modal) =>
      import('./scripts/modal').then((module) =>
        module.default(modal as HTMLElement)
      )
    );
  }

  const tableDropdowns = document.querySelectorAll('.table-dropdown');
  if (tableDropdowns.length) {
    tableDropdowns?.forEach((table) =>
      import('./scripts/tableDropdown').then((module) =>
        module.default(table as HTMLElement)
      )
    );
  }


  const imageSelector = document.getElementById('image-selector');
  if (imageSelector) {
      import('./scripts/imageSelector').then((module) =>
        module.default(imageSelector as HTMLElement)
      )
  }

  const modalSlider = document.querySelector('[data-modal="modal-swiper"]');
  if(modalSlider) {
    import('./scripts/modalSlider').then((module) =>
    module.default(modalSlider as HTMLElement)
    )
  }
  import('./scripts/scrollToTop').then((module) => module.default());
};

export default scriptsInit;
