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