document.documentElement.classList.add('js-enabled');

const questionsElements = document.querySelectorAll('.faq__question');
const resourcesElements = document.querySelectorAll('.resource__title');





function wrapper(items){
    items.forEach(button => {
        button.addEventListener('click', () => {
            const isOpen = button.classList.contains('active');

            document.querySelectorAll('.faq__question.active').forEach(q => {
                q.classList.remove('active');
            });

            document.querySelectorAll('.resource__title.active').forEach(r => {
                r.classList.remove('active');
            });


            if (!isOpen) {
                button.classList.add('active');
            }
        });
    });
}



wrapper(questionsElements);
wrapper(resourcesElements);
console.log('Je suis la nav');
/*
const navigationContainerElement = document.querySelector('.nav__container');
const menuButton = document.querySelector('.nav__toggle');

menuButton.addEventListener('click', (evt)=>{
    const expandedAttribut = menuButton.getAttribute('aria-expanded');

    if (expandedAttribut==="true"){
        menuButton.setAttribute('aria-expanded', false);
        navigationContainerElement.classList.remove('is-open');
        menuButton.classList.remove('active');
    }else{
        menuButton.setAttribute('aria-expanded', true);
        navigationContainerElement.classList.add('is-open');
        menuButton.classList.add('active');
    }
})*/

document.documentElement.classList.add('js-enabled');


function showAll(itemSelector){
    const sections = document.querySelectorAll('section');
    sections.forEach(section=>{
        const items = section.querySelectorAll(itemSelector);
        const nextButton = section.querySelector('.carousel__next');
        const prevButton = section.querySelector('.carousel__prev');
        let currentItem = 0;
        if (!items.length || !nextButton || !prevButton) return;
        function showItems(index) {
            items.forEach((item, i) => {
                item.classList.toggle('active', i === index);
                item.style.display = i === index ? 'flex' : 'none';
            });
        }
        nextButton.addEventListener('click', () => {
            currentItem = (currentItem + 1) % items.length;
            showItems(currentItem);
        });
        prevButton.addEventListener('click', () => {
            currentItem = (currentItem - 1 + items.length) % items.length;
            showItems(currentItem);
        });

        showItems(currentItem);
    });
}

showAll('.house__article');
showAll('[class^="news__article"]');
showAll('.news__article');
showAll('.mission__article');
showAll('.activity__card');
showAll('.activities__card');
showAll('.project__card');



