
function checkInput(password, email) {
    var errors = []; //creates array 
    if (password.length < 6) { //if password length is less than 6 characters
        errors.push("Your password must be at least 6 characters");
    }
    if (password.search(/[a-z]/i) < 0) { //if password does not conain any letters
        errors.push("Your password must contain at least one letter.");
    }
    if (password.search(/[0-9]/) < 0) { //if password does not contain any digigts
        errors.push("Your password must contain at least one digit.");
    }
    if (email.trim().length < 1) { //checks if email field contains characters.
        errors.push("Email field is empty");
    }
    if (!email.includes("@") && !email.includes(".")) { //checks valid email
        errors.push("Email is not valid");
    }
    if (errors.length > 0) { //adds all errors together and prints them out to the user.
        $('#result').html(errors.join("<br>"));
        return false; //returns false to not keep going and submitting the form
    }
    return true;
}


function sendAjax(destination, data) { //sends data to the given destination and print out and returns result
    $.post(destination, data, function (result) {
        console.log(result);
        $('#result').html(result);
        return result;
    });
}


