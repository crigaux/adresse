// ##############################################################
// ##########      Vérification des mots de passe      ##########
// ##############################################################

// Emplacement des deux champs mot de passe
let password = document.querySelector('#password');
let confirmPassword = document.querySelector('#confirmPassword');

// Popup qui affiche les caractères qui doivent figurer dans le mot de passe
let passwordMessage = document.querySelector('.passwordRequires');

// Les quatres lignes qui doivent s'afficher en rouge si le mot de passe ne respecte pas aux Regex
let passwordUpper = document.querySelector('.passwordUpper');
let passwordSpecial = document.querySelector('.passwordSpecial');
let passwordLength = document.querySelector('.passwordLength');
let passwordNumber = document.querySelector('.passwordNumber');

// Les quatres Regex que le mot de passe doit respecter :

// Le mot de passe contient au moins une majuscule
let testPasswordUpper = new RegExp('^(?=.*[A-Z])');
// Le mot de passe contient au moins un caractère spécial
let testPasswordSpecial = new RegExp('^(?=.*[!@#$&*,;:?./§ù%*µ^¨£$€])');
// Le mot de passe contient au moins 8 caractères
let testPasswordLength = new RegExp('^.{8,}$');
// Le mot de passe contient au moins un nombre
let testPasswordNumber = new RegExp('^(?=.*[0-9])');

// Fonction qui test si la valeur de l'input correspond à l'expression Regex, si oui, affiche le message correspondant en vert
function regexTest(value, regex, errorMessage){
    if(regex.test(value)){
        errorMessage.style='color: green';
        return true;
    } else {
        errorMessage.style='color: red';
        return false;
    }
}

// Affiche le popup d'aide pour le mot de passe et désactive le bouton si le mot de passe n'est pas valide
function test(password, confirmPassword){
    if(testPasswordUpper.test(password.value)
        && testPasswordSpecial.test(password.value)
        && testPasswordLength.test(password.value)
        && testPasswordNumber.test(password.value)
        && password.value != ''
        && password.value == confirmPassword.value) {
            document.querySelector('form button').removeAttribute('disabled');
            passwordMessage.style='display:none';
    } else {
            document.querySelector('form button').setAttribute('disabled', true);
            passwordMessage.style='display:block';
    }

    regexTest(password.value, testPasswordUpper, passwordUpper);
    regexTest(password.value, testPasswordSpecial, passwordSpecial);
    regexTest(password.value, testPasswordNumber, passwordNumber);
    regexTest(password.value, testPasswordLength, passwordLength);
}

// Function qui test si le mot de passe est conforme aux Regex et si les deux mots de passe sont identiques
function passwordTest(password, confirmPassword){

    // Permet de tester si le mot de passe est valide à chaque caractère entré ou effacé
    password.addEventListener('input', () => {
        test(password, confirmPassword)
    })

    // Permet de tester si le mot de passe est valide au focus
    password.addEventListener('focus', () => {
        test(password, confirmPassword)
    })

    // Stop l'affichage du message d'aide du mot de passe si le focus est perdu
    password.addEventListener('focusout', () => {
        passwordMessage.style='display:none';
    })
}

passwordTest(password, confirmPassword);
passwordTest(confirmPassword, password);