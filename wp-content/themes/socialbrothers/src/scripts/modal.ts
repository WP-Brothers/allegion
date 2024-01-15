const modalInit = (modalWrapper: HTMLElement) => {

    const modal:HTMLDialogElement = modalWrapper.querySelector('[data-modal="modal"]')!
    const open = modalWrapper.querySelector('[data-modal-open="modal-open"]')!
    const close = modal.querySelector('.modal__close')!

    open.addEventListener('click', () => {
        modal.showModal();
    })
    
    close.addEventListener('click', () => {
        modal.close();
    })
}

export default modalInit;