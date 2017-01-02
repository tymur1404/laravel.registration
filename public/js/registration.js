/**
 * Created by timur on 02.01.17.
 */
$(document).ready(function(){

    function isValidEmail(emailAddress) {
        var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        return pattern.test(emailAddress);
    }

    function isValidPassword(password) {
        var pattern = new RegExp(/^[a-z0-9_-]{6,18}$/i);
        return pattern.test(password);
    }

    var email ='';

    $("#btn-registration").click(function(){
        $('.alert.alert-danger').hide();
        email = $('#login-username').val();
        var password = $('#login-password').val();
        if( !isValidEmail(email))
            $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">Email not valid</div>');
        if( !isValidPassword(password))
            $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">Password not valid</div>');
        else {
            $.ajax({
                type: 'POST',
                url: 'register/add_user',
                data: $('form').serialize(),
                success: function () {
                    window.location.replace('register/email_code');
                },
                error: function () {
                    $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">User with that email is already registered</div>');
                }
            });
        }

    });

    $("#submit").click(function(){
        console.info($('form').serialize());
        $.ajax({
            type: 'POST',
            url: '/register/check_code',
            data: $('form').serialize(),
            success: function(msg){
                console.log(msg);
                if(msg == 'success')
                    window.location.replace('/users');
                else
                    $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">Code is not valid</div>');
            }
        });

    });

    $("#btn-login").click(function(){
        $('.alert.alert-danger').hide();
        var email = $('#login-username').val();
        var password = $('#login-password').val();
        if( !isValidEmail(email))
            $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">Email not valid</div>');
        if( !isValidPassword(password))
            $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">Password not valid</div>');
        else {
            $.ajax({
                type: 'POST',
                url: 'login',
                data: $('form').serialize(),
                success: function (msg) {
                    if (msg == 'success')
                        window.location.replace('/users');
                    else
                        $('.panel.panel-info').after('<div class="alert alert-danger"  role="alert">This user does not exist</div>');

                }
            });
        }
    });

});