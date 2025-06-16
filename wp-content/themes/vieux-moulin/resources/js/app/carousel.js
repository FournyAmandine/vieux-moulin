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



