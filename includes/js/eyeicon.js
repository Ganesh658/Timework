
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
    
    $("#new a").on('click', function(event) {
        event.preventDefault();
        if($('#new input').attr("type") == "text"){
            $('#new input').attr('type', 'password');
            $('#new i').addClass( "fa-eye-slash" );
            $('#new i').removeClass( "fa-eye" );
        }else if($('#new input').attr("type") == "password"){
            $('#new input').attr('type', 'text');
            $('#new i').removeClass( "fa-eye-slash" );
            $('#new i').addClass( "fa-eye" );
        }
    });
        
