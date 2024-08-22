document.addEventListener('DOMContentLoaded', function() {
    // Initialize your pop-ups here
    const popUpButtons = document.querySelectorAll('.pop-up-button');
    const popUps = document.querySelectorAll('.pop-up');

    popUpButtons.forEach(button => {
        button.addEventListener('click', function() {
            const popUpId = this.getAttribute('data-pop-up');
            const popUp = document.getElementById(popUpId);
            if (popUp) {
                popUp.style.display = 'block';
            }
        });
    });

    popUps.forEach(popUp => {
        const closeButton = popUp.querySelector('.close-button');
        if (closeButton) {
            closeButton.addEventListener('click', function() {
                popUp.style.display = 'none';
            });
        }
    });
});
