document.addEventListener("DOMContentLoaded", () => {
    const form = document.querySelector('#pointForm');
    const postcodeInput = document.querySelector('#point_postcode');
    const cityInput = document.querySelector('#point_city');
    const streetInput = document.querySelector('#point_street');
    const nameInput = document.querySelector('#point_name');
    const nameDiv = document.querySelector('#name-input');

    form.addEventListener('submit', (event) => {
        if (
            postcodeInput.value.trim() !== ""
            && cityInput.value.trim() === ""
            && streetInput.value.trim() === ""
            && nameInput.value.trim() === ""
        ) {
            event.preventDefault();

            nameDiv.style.display = 'block';
        }
    });

});