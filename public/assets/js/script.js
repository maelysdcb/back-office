const profileBtn = document.getElementById('profile');
const dropdownProfile = document.getElementById('dropdownProfile');

profileBtn.addEventListener('click', () => {
    dropdownProfile.classList.toggle('hidden');
})

window.addEventListener('click', (event) => {
    if(event.target !== profileBtn && !dropdownProfile.contains(event.target)) {
        dropdownProfile.classList.add('hidden');
    }
})