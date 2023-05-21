'use strict';

const profileBtn = document.getElementById("profile");
const dropdownProfile = document.getElementById("dropdownProfile");

// DISPLAY LOG OUT DROPDOWN
profileBtn.addEventListener("click", () => {
  dropdownProfile.classList.toggle("hidden");
});

// CLOSE DROPDOWN BY CLICKING ON WINDOW
window.addEventListener("click", (event) => {
  if (event.target !== profileBtn && !dropdownProfile.contains(event.target)) {
    dropdownProfile.classList.add("hidden");
  }
});
