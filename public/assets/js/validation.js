"use strict";
const form = document.querySelector("form");
const allInput = document.querySelectorAll("input");
const btnSubmit = document.querySelector(".wrap__validate");
let firstNameSpan = document.querySelector(".firstName");
let lastNameSpan = document.querySelector(".lastName");
let emailSpan = document.querySelector(".email");
let creditSpan = document.querySelector(".credits");
let passwordSpan = document.querySelector(".password");
let productNameSpan = document.querySelector(".name");
let priceSpan = document.querySelector(".price");
let quantitySpan = document.querySelector(".quantity");
let imageSpan = document.querySelector(".image");

const regex = {
  firstName: /^[A-Za-zéèïë]{2,13}(?:[-'][A-Za-z]+)*$/,
  lastName: /^[A-Za-z]+(?:[-'][A-Za-z]+)*$/,
  email: /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/,
  credits: /^\d{1,2}$/,
  password: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/,
  name: /^[a-zA-Z\s]{3,25}$/,
  price: /^(\d{1,2}|\d{1,2}\.\d{1,2})$/,
  quantity: /^\d{1,2}$/,
  image:
    /^\.\/assets\/img\/(?:[a-zA-Z]+\.(?:jpg|jpeg|png))?$|^\.\/assets\/img\/$/,
};

allInput.forEach((input) => {
  input.addEventListener("input", verifyInputs);
});

// FUNCTION VERIFY INPUTS FORM
function verifyInputs() {
  let isEmpty = true;
  for (let i = 0; i < allInput.length; i++) {
    const input = allInput[i];
    const name = input.name;
    const value = input.value;

    switch (name) {
      case "email":
        if (!regex.email.test(value) || value.trim() === "") {
          displayErrorMessage(emailSpan, "Please enter a valid email");
          isEmpty = false;
        } else {
          displaySuccessMessage(emailSpan, "Correct");
        }
        break;

      case "first_name":
        if (!regex.firstName.test(value) || value.trim() === "") {
          displayErrorMessage(firstNameSpan, "Please enter a valid first name");
          isEmpty = false;
        } else {
          displaySuccessMessage(firstNameSpan, "Correct");
        }
        break;

      case "last_name":
        if (!regex.lastName.test(value) || value.trim() === "") {
          displayErrorMessage(lastNameSpan, "Please enter a valid last name");
          isEmpty = false;
        } else {
          displaySuccessMessage(lastNameSpan, "Correct");
        }
        break;

      case "credits":
        if (!regex.credits.test(value) || value.trim() === "") {
          displayErrorMessage(
            creditSpan,
            "Please enter min 1 number max 2 numbers >= 0"
          );
          isEmpty = false;
        } else {
          displaySuccessMessage(creditSpan, "Correct");
        }
        break;

      case "password":
        if (!regex.password.test(value) || value.trim() === "") {
          displayErrorMessage(
            passwordSpan,
            "Min 8 characters, at least 1 letter, 1 number and 1 special character (@$!%*#?&)"
          );
          isEmpty = false;
        } else {
          displaySuccessMessage(passwordSpan, "Correct");
        }
        break;

      case "name":
        if (!regex.name.test(value) || value.trim() === "") {
          displayErrorMessage(productNameSpan, "Please enter a valid name");
          isEmpty = false;
        } else {
          displaySuccessMessage(productNameSpan, "Correct");
        }
        break;

      case "price":
        if (!regex.price.test(value) || value.trim() === "") {
          displayErrorMessage(priceSpan, "Please enter a valid price");
          isEmpty = false;
        } else {
          displaySuccessMessage(priceSpan, "Correct");
        }
        break;

      case "quantity":
        if (!regex.quantity.test(value) || value.trim() === "") {
          displayErrorMessage(quantitySpan, "Please enter a valid quantity");
          isEmpty = false;
        } else {
          displaySuccessMessage(quantitySpan, "Correct");
        }
        break;

      case "image":
        if (!regex.image.test(value) || value.trim() === "") {
          displayErrorMessage(
            imageSpan,
            "Please enter a valid file or ./assets/img/"
          );
          isEmpty = false;
        } else {
          displaySuccessMessage(imageSpan, "Correct");
        }
        break;

      default:
        break;
    }
  }
  btnSubmit.disabled = !isEmpty;
  if(btnSubmit.disabled){
    btnSubmit.style.backgroundColor = "#e4e4e4c6";
  } else {
    btnSubmit.style.backgroundColor = "#1AB76C";
  }

  // DISPLAY ERROR MESSAGE
  function displayErrorMessage(element, message) {
    element.textContent = message;
    element.style.color = "#FF3333";
  }

  // DISPLAY SUCCESS MESSAGE
  function displaySuccessMessage(element, message) {
    element.textContent = message;
    element.style.color = "#1AB76C";
  }
}

form.addEventListener("submit", (e) => {
  if (btnSubmit.disabled) {
    e.preventDefault();
  }
});
