const faqInit = (element: HTMLElement) => {
    const faqs: NodeListOf<HTMLElement> = element.querySelectorAll('.faq');

    faqs.forEach(faq => {
        let active = false
        const title: HTMLElement = faq.querySelector('.faq__title')!
        const content: HTMLElement = faq.querySelector('.faq__content')!
        const heightTitle: number = title.offsetHeight
        const heightContent: number = content.offsetHeight
        const heightTotal:number = heightContent + heightTitle;        
        const button = faq.querySelector('.faq__button')
        const icon = button?.querySelector('span')

        faq.style.height = heightTitle+'px';

        button!.addEventListener('click', () => {
            icon?.classList.toggle('rotate-180');
            if(active === false) {
                faq.style.height = heightTotal+'px';
                active = true
            } else {
                active = false
                faq.style.height = heightTitle+'px';
            }
        })

    })
}

export default faqInit;