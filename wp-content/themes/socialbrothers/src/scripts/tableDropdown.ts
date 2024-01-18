const tableDropdownInit = (tableElement: HTMLElement) => {
    const open:HTMLButtonElement = tableElement.querySelector('button')!;
    const openIcon:HTMLSpanElement = open.querySelector('span')!;
    const tableWrapper:HTMLDivElement = tableElement.querySelector('.table-dropdown__wrapper')!
    const table:HTMLTableElement = tableElement.querySelector('.table-dropdown__table')!
    const tableHeight = table.offsetHeight

    open?.addEventListener('click', () => {
        openIcon.classList.toggle('rotate-180');

        tableWrapper.classList.toggle('h-0')
        tableWrapper.classList.toggle('h-['+tableHeight+'px]')
    });
}
export default tableDropdownInit;