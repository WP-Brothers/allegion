const formComplextInit = (formComplex: HTMLElement) => {
  const formTop = formComplex.querySelector('.form-top');
  const formBottom = formComplex.querySelector('.form-bottom') as HTMLElement;
  const form = formComplex.querySelector('.form-card') as HTMLElement;

  function resizeFooter(e: Array<ResizeObserverEntry>) {
    if (formTop) {
      const headerHeight = formTop.clientHeight - 160;
      const formHeight = e[0].contentRect.height;
      if (formHeight > headerHeight) {
        formBottom.style.minHeight = `${formHeight - headerHeight + 40}px`;
      }
    }
  }

  new ResizeObserver(resizeFooter).observe(form);
};

export default formComplextInit;
