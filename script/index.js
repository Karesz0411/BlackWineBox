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