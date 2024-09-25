document.querySelectorAll('.faq--dropdown__question').forEach(question => {
    question.addEventListener('click', () => {
        const dropdown = question.parentElement;
        const answer = dropdown.querySelector('.faq--dropdown__answer');

        if (dropdown.classList.contains('open')) {
            answer.style.height = `${answer.scrollHeight}px`;
            setTimeout(() => {
                answer.style.height = '0';
            }, 10);
        } else {
            answer.style.height = `${answer.scrollHeight}px`;
        }

        dropdown.classList.toggle('open');
    });
});
