/* =========================
   RESTRO JAVASCRIPT
========================= */


/* =========================
   RESERVATION VALIDATION
========================= */

function validateReservation() {

    let phone = document.querySelector(
        'input[name="phone"]'
    ).value;

    let guests = document.querySelector(
        'input[name="guests"]'
    ).value;

    let phonePattern = /^[0-9]{10}$/;

    if (!phonePattern.test(phone)) {

        alert(
            "Please enter a valid 10-digit phone number."
        );

        return false;
    }

    if (guests < 1 || guests > 50) {

        alert(
            "Number of guests must be between 1 and 50."
        );

        return false;
    }

    return true;
}


/* =========================
   FEEDBACK VALIDATION
========================= */

function validateFeedback() {

    let email = document.querySelector(
        'input[name="email"]'
    ).value;

    if (!email.includes("@")) {

        alert(
            "Please enter a valid email address."
        );

        return false;
    }

    return true;
}


/* =========================
   PAGE LOADED MESSAGE
========================= */

document.addEventListener(
    "DOMContentLoaded",
    function () {

        console.log(
            "Welcome to Restro Restaurant!"
        );

    }
);