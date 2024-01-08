const scrollToTopInit = () => {
    const body = document.querySelector('body')!;
    const button = document.createElement('button');

    button.classList.add('scroll-to-top');
    body.appendChild(button);

    const checkButton = () => {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            button.style.display = "block";
        } else {
            button.style.display = "none";
        }
    }

    checkButton()
    window.onscroll = () => {
        checkButton()
    }

    button.addEventListener('click', () => {
        document.body.scrollTop = 0; 
        document.documentElement.scrollTop = 0;
    });
}
export default scrollToTopInit;