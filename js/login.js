const toggleSignup = document.querySelector(".toggle-signup");

const loginForm = document.querySelector(".login-wrapper");
const signupForm = document.querySelector(".signup-wrapper");


let hasLoginFocus = true;
function switchForm() {
    if(hasLoginFocus === false) {
        loginForm.style.display = "none";
        signupForm.style.display = "block";

        toggleSignup.innerHTML = "Terug naar inloggen";

        hasLoginFocus = true;

    }else{
        loginForm.style.display = "block";
        signupForm.style.display = "none";

        toggleSignup.innerHTML = "Nog geen account? Registreer hier";

        hasLoginFocus = false;
    }
}

switchForm();

toggleSignup.addEventListener("click", function(event) {
    switchForm();
});    




const loginBtn = document.getElementById("login-btn");
const signupBtn = document.getElementById("signup-btn");

signupBtn.addEventListener("click", function(event) {
    // Find the form element and serialize its data
    const form = document.getElementById("signup-form"); 
    let formData = new FormData(form);


    //make a XHR request with the form data
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'inc/signUpSubmit.php', true);
    xhr.onload = function(){

        let response = this.response;
        response = JSON.parse(response);
        console.log(response);

        if(response[0] == 0){
            Swal.fire({
                title: 'Error!',
                text: response[1],
                icon: 'error',
                confirmButtonText: 'probeer opnieuw'
            });
        }else{
            Swal.fire({
                title: 'Succes!',
                text: response[1],
                icon: 'success',
                confirmButtonText: 'Cool'
            });
            switchform();
        }
    }

    xhr.send(formData);
});


loginBtn.addEventListener("click", function(event) {
    // Find the form element and serialize its data
    let form = document.getElementById("login-form"); // Replace with your form's actual ID
    let formData = new FormData(form);


    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'inc/loginSubmit.php', true);
    xhr.onload = function(){
        Swal.fire({
            title: 'Succes!',
            text: this.response,
            icon: 'success',
            confirmButtonText: 'Cool'
        });

        if(this.response == "U bent succesvol ingelogd!") {
            window.location.replace("home.php");
        }
    }

    xhr.send(formData);
});