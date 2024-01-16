const imageSelectorInit = (imageSelector: HTMLElement) => {
    const arrow = document.getElementById('image-selector__arrow');
    const highlightedImages = imageSelector.querySelectorAll('#image-selector__highlighted-images .image-selector__highlighted-image')
    
    const removeActive = () => {
        const activeImage = imageSelector.querySelector('#image-selector__highlighted-images .image-selector__highlighted-image.active');
        if(activeImage) {
            activeImage.classList.remove('active');
        }
    }

    const moveArrow = () => {
        const activeImage = imageSelector.querySelector('#image-selector__highlighted-images .image-selector__highlighted-image.active');

        if(activeImage && arrow) {
            const wrapperPosition = imageSelector.getBoundingClientRect().left;
            const activeImagePosition = activeImage.getBoundingClientRect().left;
            const newArrowLocation = activeImagePosition - wrapperPosition
            arrow.style.left = newArrowLocation + 'px';
        }   
    }

    const changeActiveDisplayImage = () => {
        const displayImage:HTMLImageElement = document.querySelector('.product-single__display-image')!;
        const activeImage:HTMLImageElement = imageSelector.querySelector('#image-selector__highlighted-images .image-selector__highlighted-image.active img')!;
        const activeSrc = activeImage.src;

        displayImage.src = activeSrc;
        displayImage.srcset = activeImage.srcset;
    }

    highlightedImages[0].classList.add('active');

    highlightedImages.forEach((image) => {
        image.addEventListener('click', () => {
            removeActive();
            image.classList.add('active');
            moveArrow();
            changeActiveDisplayImage();
        })
    });

    const modal:HTMLDialogElement = document.querySelector('[data-modal="modal-swiper"]')!
    const open = imageSelector.querySelector('[data-modal-open="modal-open"]')!
    const close = modal.querySelector('.modal__close')!

    if(open) {

        open.addEventListener('click', () => {
            modal.showModal();
        })
        
        close.addEventListener('click', () => {
            modal.close();
        })
    }
}

export default imageSelectorInit;