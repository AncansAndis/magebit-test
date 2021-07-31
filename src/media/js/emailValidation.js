let notificationIds = ['emailNotFound', 'emailWrongCountry', 'emailNotValid', 'termsDenied'];

window.addEventListener('load', function () {
    let inputField = document.querySelector('#email-input-field');
    let checkMark = document.querySelector('#terms-accept');
    let button = document.querySelector('#email-submit-button');
    let isEmailValid = false;
    let isCheckmarkTrue = false;

    inputField.addEventListener('input', function () {
        if (inputField.value === "") {
            printNotification(notificationIds[0], "Email address is required");
        } else {
            if (validateEmail(inputField.value)) {
                if (!validateEmailColumbia(inputField.value)) {
                    removeExistingNotificationsIfExist();
                    isEmailValid = true;
                    if (isCheckmarkTrue) {
                        button.removeAttribute('disabled');
                    } else {
                        printNotification(notificationIds[3], "You must accept the terms and conditions");
                    }
                } else {
                    printNotification(notificationIds[1], "We are not accepting subscriptions from Colombia emails");
                }
            } else {
                printNotification(notificationIds[2], "Please provide a valid e-mail address");
            }
        }
    });

    checkMark.addEventListener('input', function () {
        if (checkMark.checked) {
            removeExistingNotificationsIfExist();
            isCheckmarkTrue = true;
            if (isEmailValid) {
                button.removeAttribute('disabled');
            }
        } else {
            printNotification(notificationIds[3], "You must accept the terms and conditions");
        }
    });
});

function validateEmail(email) {
    let re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function validateEmailColumbia(email) {
    let re = /\S+@\S+\.+[c]+[o]$/;
    return re.test(email);
}

function removeExistingNotificationsIfExist() {
    notificationIds.forEach(function (element) {
        let notification = document.querySelector("#" + element);
        if (notification !== null) {
            notification.remove();
        }
    })
}

function printNotification(messageId, message) {
    removeExistingNotificationsIfExist();

    let notification = document.createElement('h3');
    notification.setAttribute('id', messageId);
    notification.setAttribute('class', 'validation-error')
    notification.innerHTML = message;
    let inputField = document.querySelector('#subscribe-form');
    inputField.parentNode.insertBefore(notification, inputField);
}