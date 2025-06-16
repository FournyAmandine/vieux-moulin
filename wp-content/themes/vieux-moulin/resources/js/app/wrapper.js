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