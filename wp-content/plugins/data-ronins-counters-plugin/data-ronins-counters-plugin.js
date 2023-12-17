jQuery(document).ready(function($) {
    function customClick(ev) {
        ev.preventDefault();

        switch ( String(ev.data.btnType) ) {
            case "Login":
                var counterType = 1;
                break;
            case "Register":
                var counterType = 2;
                break;
            default:
                console.error('Error: Invalid action type'); 
                alert('Error: Invalid action type');
                return;
        }

        alert(ev.data.btnType + ' button clicked!');
        
        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: { 
                action: 'increment_counter',
                counter_type: counterType
             },
            success: function(response) {
                location.reload(true);
            },
            error: function(error) {
                console.error('AJAX error:', error);
            }
        });
    };

    $('#wp-submit').on('click', {btnType: "Login"}, customClick );
    $('.wp-login-register').on('click', {btnType: "Register"}, customClick );
});
