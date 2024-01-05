
const mainMenu = (menu: HTMLElement) => {
  const dropdowns = menu.querySelectorAll('.menu__item--has-children');
  const megamenu = document.querySelector('.megamenu-element');

  const closeAll = (currentdropdown?: Element) => {
    if(currentdropdown) {
      dropdowns.forEach((dropdown) => {
        if(currentdropdown.id !== dropdown.id) {
          dropdown.classList.remove('show');
        }
      });
    } else {

      dropdowns.forEach((dropdown) => {
        dropdown.classList.remove('show');
      });
    }
  }

    if(window.innerWidth > 767) {
      dropdowns.forEach((dropdown) => {

        if(dropdown.classList.contains('megamenu')) {
            const linkList = megamenu?.querySelectorAll('li.megamenu li')
            const linkWrapper:HTMLElement = megamenu?.querySelector('.megamenu-element__list-wrapper')!
            linkWrapper.innerHTML = '';
            linkList?.forEach(link => {
              linkWrapper.appendChild(link)
            })
        }
    
    
        const link = dropdown.querySelector('a');
    
        link?.addEventListener('click', (e) => {
          e.preventDefault();
          closeAll(dropdown)
          if(!dropdown.classList.contains('megamenu')) {
            dropdown.classList.toggle('show');
          } else {
            megamenu!.classList.toggle('show');
            dropdown!.classList.toggle('show');
          }
        });
      });
    } else {
      console.log(dropdowns);
      dropdowns.forEach(dropdown => {
        const submenuLinks:NodeListOf<HTMLLIElement> = dropdown.querySelectorAll('.submenu li')!;
        const title = dropdown.querySelector('a')!.innerText
        const headerNav = document.querySelector('#header-nav');
        const link = dropdown.querySelector('a');

        console.log(link)


        const newSubmenuClasses = [
          'mobile-submenu',
          'hidden'
        ]
        const newSubmenu = document.createElement('div');
        const newSubmenuHeadingWrapper = document.createElement('div');

        const newSubmenuBack = document.createElement('span');
        const newSubmenuTitle = document.createElement('span');
        const newSubmenuPlaceholder = document.createElement('div');

        newSubmenuBack.classList.add('mobile-submenu__back');
        newSubmenuBack.innerHTML = 'chevron_left';
        
        newSubmenuTitle.classList.add('mobile-submenu__title');
        newSubmenuTitle.innerHTML = title;

        newSubmenuHeadingWrapper.classList.add('mobile-submenu__heading-wrapper');

        newSubmenuHeadingWrapper.appendChild(newSubmenuBack)
        newSubmenuHeadingWrapper.appendChild(newSubmenuTitle)
        newSubmenuHeadingWrapper.appendChild(newSubmenuPlaceholder)

        newSubmenuClasses.forEach(cssClass => {
          newSubmenu.classList.add(cssClass)
        })

        newSubmenu.appendChild(newSubmenuHeadingWrapper)
        
        submenuLinks.forEach(link => {
          newSubmenu.appendChild(link)
        })

        headerNav?.appendChild(newSubmenu)

        link?.addEventListener('click', (e) => {
          e.preventDefault();

            newSubmenu!.classList.remove('hidden');
          });
          
          newSubmenuBack.addEventListener('click', () => {
            
            newSubmenu!.classList.add('hidden');
        })
      })
    }

  

  document.addEventListener('scroll', () => {
    closeAll()
  });
};

export default mainMenu;
