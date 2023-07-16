$(document).ready(function (){

    // ########################################################################
    // ########################################################################
    // LOGIN/REGISTER 
    // ########################################################################
    // ########################################################################

    // Register button
    $('#register').on('click', function (event) {
        event.preventDefault();
        window.open('/movie_project/register/register_form.html');
    });

    // Login button
    $('#login').on('click', function (event) {
        url = '/movie_project/login/login_processor.php?mode=login';
        let inputUsername = $('#input_username').val();
        let inputPassword= $('#input_password').val();

        executeLoginRegister('POST',inputUsername,inputPassword,url);
        clearAll();

    });

});

 // ########################################################################
    // LOGIN PAGE BUTTON CLICKS
    function executeLoginRegister(type,username,password,url) {
        $('#login_form').on('submit', function (event) {
       
            // event.stopImmediatePropagation();
            event.preventDefault();
            
            $.ajax({
                crossOrigin: true,
                url:url,
                type: type,
                dataType: 'JSON',
                async: false,
                data: {
                    username:username,
                    password:password,
                },
                success: function (response) {
                   if(response == 'success')
                   {
                        window.location.href = '/movie_project/index.php';
                   }

                }
            });
        });
    }

    function clearAll()
    {
        $('#input_username').val('');
        $('#input_password').val('');
    }