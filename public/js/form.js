
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("registrationForm");
    const fieldsID = ["name", "user_name", "email", "phone_number", "address", "password", "confirm_password", "Birth"];
    fieldsID.forEach(fieldID => {
        const field = document.getElementById(fieldID);
        field.addEventListener("blur", function () {
            validation(field);
        });
    });

    form.addEventListener("submit", function (event) {
        event.preventDefault();
        const formData = new FormData(form);
        const xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                const response = JSON.parse(xhr.responseText);

                if (xhr.status === 200) {
                    if (response.success) {
                        showAlert(response.message, "success");
                        form.reset();

                       document.getElementById("uploadedImage").src = "../assets/upload.png";

                    }
                } else {
                    if (response.errors) {
                        for (const field in response.errors) {
                            if (response.errors.hasOwnProperty(field)) {
                                showAlert(response.errors[field][0], "danger");
                                return;
                            }
                        }
                    } else {
                        console.error("Unknown error occurred");
                    }
                }
            }
        };

        xhr.open("POST", form.action, true);
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
        xhr.send(formData);
    });

    document.getElementById("dob-btn").addEventListener("click", function () {
        getActorsByDOB();
    });

    // $('#Birth').datepicker({
    //     language: 'ar',
    //     autoclose: true
    // });
    // trying to change the calendar into arabic

});




function displayError(inputField, messageKey, language) {
    const parent = inputField.parentElement;
    const errorElement = parent.querySelector(".error-message");
    if (errorElement) {
        errorElement.textContent = errorMessages[language][messageKey];
    } else {
        const errorMessage = document.createElement("span");
        errorMessage.className = "error-message";
        errorMessage.textContent = errorMessages[language][messageKey];
        errorMessage.style.color = "red";
        errorMessage.style.display = "block";
        parent.appendChild(errorMessage);
    }
}

function showAlert(message, type) {
    var alertDiv = document.createElement("div");
    alertDiv.className = "alert alert-" + type;
    alertDiv.setAttribute("role", "alert");
    alertDiv.innerHTML = message;
    document.getElementById("alertContainer").appendChild(alertDiv);
    setTimeout(function () {
        alertDiv.remove();
    }, 3000);
}


function validation(inputField) {
    const fieldid = inputField.id;
    const value = inputField.value.trim();
    const parent = inputField.parentElement;
    const errorElement = parent.querySelector(".error-message");

    if (errorElement) {
        errorElement.remove();
    }
    if (value === "") {
        displayError(inputField, "required_field", lang);
        return false;
    }

    switch (fieldid) {
        case "name":
            if (value.split(" ").length < 2 || !/^[\u0600-\u06FF\s]+$|^[a-zA-Z\s]+$/.test(value)) {
                displayError(inputField, "full_name", lang);
            }
            break;
        case "email":
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(value)) {
                displayError(inputField, "invalid_email", lang);
            }
            break;
        case "Birth":
            const today = new Date();
            const birthDateTime = new Date(value);
            if (birthDateTime >= today) {
                displayError(inputField, "invalid_dob", lang);
            }
            break;
        case "password":
            const passwordRegex = /^(?=.*[A-Z])(?=.*[0-9])(?=.*[\W_])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            if (!passwordRegex.test(value)) {
                displayError(inputField, 'pass_error', lang);
            }
            break;
        case "confirm_password":
            const password = document.getElementById("password").value.trim();
            if (value !== password) {
                displayError(inputField, "pass_match", lang);
            }
            break;
        default:
            break;
    }
}


// function showAlert(message, type) {
//     var alertDiv = document.createElement("div");
//     alertDiv.className = "alert alert-" + type;
//     alertDiv.setAttribute("role", "alert");
//     alertDiv.innerHTML = message;
//     document.getElementById("alertContainer").appendChild(alertDiv);
//     setTimeout(function () {
//         alertDiv.remove();
//     }, 4000);
// }
function handleImageUpload(event) {
    const file = event.target.files[0];
    const validFormats = ['image/jpeg', 'image/png', 'image/gif'];
    const maxSize = 5 * 1024 * 1024;

    if (file) {
        if (!validFormats.includes(file.type)) {
            showAlert("Invalid image format. Please select a JPEG, PNG, or GIF file.", 'danger');
            return;
        }

        if (file.size > maxSize) {
            showAlert("File size exceeds the maximum limit of 5MB.", 'danger');
            return;
        }

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = new Image();
            img.onload = function() {
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                const diameter = 100;
                canvas.width = diameter;
                canvas.height = diameter;

                ctx.clearRect(0, 0, diameter, diameter);

                ctx.beginPath();
                ctx.arc(diameter / 2, diameter / 2, diameter / 2, 0, Math.PI * 2);
                ctx.closePath();
                ctx.clip();

                const aspectRatio = img.width / img.height;
                let newWidth, newHeight, x, y;
                if (aspectRatio > 1) {
                    newWidth = diameter;
                    newHeight = diameter / aspectRatio;
                    x = 0;
                    y = (diameter - newHeight) / 2;
                } else {
                    newWidth = diameter * aspectRatio;
                    newHeight = diameter;
                    x = (diameter - newWidth) / 2;
                    y = 0;
                }

                ctx.drawImage(img, x, y, newWidth, newHeight);

                document.getElementById('uploadedImage').src = canvas.toDataURL('image/png');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
}


const actorsModal = new bootstrap.Modal(document.getElementById("actorsModal"));

function getActorsByDOB() {

    actorsModal.hide();

    var dobButton = document.getElementById("dobButton");
    var spinner = document.getElementById("spinner");
    var loading = document.getElementById("loading");

    dobButton.style.display = "none";
    spinner.style.display = "inline-block";
    loading.style.display = "inline-block";


    const dateOfBirth = document.getElementById("Birth").value.substring(5);
    document.getElementById("actorsList").innerHTML = "";

    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {

        if (xhr.readyState === 4 && xhr.status === 200) {

            var response = JSON.parse(xhr.responseText);
            for (var i = 0; i < response.length; i++){
                document.getElementById("actorsList").innerHTML += `<li class='list-group-item'>${response[i]}</li>`;
            }

            actorsModal.show();

            dobButton.style.display = "inline-block";
            spinner.style.display = "none";
            loading.style.display = "none";
        }
    }
    var routeUrl = document.getElementById("actorsModal").dataset.routeUrl;

    xhr.open("GET", routeUrl + "?today=" + dateOfBirth);
    xhr.send();


}

const errorMessages = {
    'EN ': {
        required_field: 'This field is required.',
        pass_error: 'Password must be at least 8 characters long and contain at least one number and one special character.',
        full_name: "Write the full name.",
        invalid_email: "Invalid email address.",
        invalid_dob: "Invalid Date of Birth.",
        pass_match: "Passwords do not match.",
    },
    'الإنجليزية ':{
        required_field: 'هذا الحقل مطلوب',
        pass_error: 'يجب أن يحتوي الرقم السري على 8 خانات، تتضمن: أحرف، 1 رقم، 1 رمز مميز على الأقل',
        full_name: "أكتب الاسم ثنائي",
        invalid_email: "البريد الإلكتروني غير صحيح",
        invalid_dob: "تاريخ الميلاد غير صحيح",
        pass_match: "الرقم السري غير متطابق",
    },
    'العربية ': {
        required_field: 'هذا الحقل مطلوب',
        pass_error: 'يجب أن يحتوي الرقم السري على 8 خانات، تتضمن: أحرف، 1 رقم، 1 رمز مميز على الأقل',
        full_name: "أكتب الاسم ثنائي",
        invalid_email: "البريد الإلكتروني غير صحيح",
        invalid_dob: "تاريخ الميلاد غير صحيح",
        pass_match: "الرقم السري غير متطابق",
    }
};

var lang = document.getElementById('dropdownMenuButton').innerText;

