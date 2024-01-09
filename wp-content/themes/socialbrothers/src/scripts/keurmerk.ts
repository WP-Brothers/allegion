const keurmerkInit = (keurmerk: HTMLElement) => {
    const modal = keurmerk.querySelector('dialog')!
    const open = keurmerk.querySelector('.keurmerk__open')!
    const close = modal.querySelector('.keurmerk__close')!

    open.addEventListener('click', () => {
        modal.showModal();
    })
    
    close.addEventListener('click', () => {
        modal.close();
    })
}

export default keurmerkInit;