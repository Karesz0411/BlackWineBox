function showPassword(input_reference)
{
    if ( input_reference.type === "password" )
    {
        input_reference.type = 'text';
    }
    else
    {
        input_reference.type = 'password';
    }
}

function forgotPassword()
{
    let  email = prompt("Add meg az email címedet:");

    if ( email != null && email != "" )
    {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "send_email_controller.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function()
        {
            if ( xhr.readyState == 4 && xhr.status == 200 )
            {
                alert(xhr.responseText);
            }
        };

        xhr.send("email=" + encodeURIComponent(email));
    }
    else
    {
        alert("Email not provided or canceled.");
    }
}

function fillUserRegistrationInputFieldsWithRandomInputs()
{
    const userNickNameLength = {'min': 8, 'max': 20};
    const userNickNameCharacters = [...'!"#$%&\'*+-./0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\\]^_`abcdefghijklmnopqrstuvwxyz|~'];
    const userEmailAddressLength = {'min': 8, 'max': 20};
    const userEmailAddressCharacters = [...'abcdefghijklmnopqrstuvwxyz0123456789_-'];
    const userEmailAddressMailTypes = ["mail", "gmail", "freemail", "icloud", "unithe", "yahoo", "hotmail"];
    const userEmailAddressExtensionTypes = ["hu", "com"];
    const userPasswordLength = {'minCapital': 1, 'maxCapital': 3, 'minNonCapital': 5, 'maxNonCapital': 10, 'minNumber': 2, 'maxNumber': 4};
    const userPasswordCharacters = [[...'ABCDEFGHIJKLMNOPQRSTUVWXYZ'], [...'abcdefghijklmnopqrstuvwxyz_-'], [...'0123456789']];

    let userNickName = '', nickNameLength = Math.floor(Math.random() * ( userNickNameLength['max'] - userNickNameLength['min'] ) + userNickNameLength['min']);

    for ( let i = 0; i < nickNameLength; i ++ )
    {
        userNickName += userNickNameCharacters[Math.floor(Math.random() * userNickNameCharacters.length)];
    }

    let userEmailAddress = '', emailAddressLength = Math.floor(Math.random() * ( userEmailAddressLength['max'] - userEmailAddressLength['min'] ) + userEmailAddressLength['min']);

    for ( let i = 0; i < emailAddressLength; i ++ )
    {
        userEmailAddress += userEmailAddressCharacters[Math.floor(Math.random() * userEmailAddressCharacters.length)];
    }

    userEmailAddress += '@' + userEmailAddressMailTypes[Math.floor(Math.random() * userEmailAddressMailTypes.length)] + '.' + userEmailAddressExtensionTypes[Math.floor(Math.random() * userEmailAddressExtensionTypes.length)];

    let userPassword = ''; //User password regex: "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/"
    let passwordCapitalLength = Math.floor(Math.random() * ( userPasswordLength['maxCapital'] - userPasswordLength['minCapital'] ) + userPasswordLength['minCapital']);
    let passwordNonCapitalLength = Math.floor(Math.random() * ( userPasswordLength['maxNonCapital'] - userPasswordLength['minNonCapital'] ) + userPasswordLength['minNonCapital']);
    let passwordNumberLength = Math.floor(Math.random() * ( userPasswordLength['maxNumber'] - userPasswordLength['minNumber'] ) + userPasswordLength['minNumber']);

    for ( let i = 0; i < passwordCapitalLength; i ++ )
    {
        userPassword += userPasswordCharacters[0][Math.floor(Math.random() * userPasswordCharacters[0].length)];
    }

    for ( let i = 0; i < passwordNonCapitalLength; i ++ )
    {
        userPassword += userPasswordCharacters[1][Math.floor(Math.random() * userPasswordCharacters[1].length)];
    }

    for ( let i = 0; i < passwordNumberLength; i ++ )
    {
        userPassword += userPasswordCharacters[2][Math.floor(Math.random() * userPasswordCharacters[2].length)];
    }

    console.log(userNickName);
    console.log(userEmailAddress);
    console.log(userPassword);
    
    document.getElementById('urnn').value = userNickName;
    document.getElementById('urea').value = userEmailAddress;
    document.getElementById('urp').value = userPassword;
    document.getElementById('urpa').value = userPassword;
}