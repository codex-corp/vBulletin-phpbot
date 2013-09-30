$(function() {

    $('#login').click( function(e) {
        e.preventDefault();

        var data = $('#login-form').serialize();

        // now add some additional stuff
        //data['wordlist'] = wordlist;

        /* Send the data using post */
        var posting = $.post( "bot.php", data);
        /* Put the results in a div */
        posting.done(function( data ) {
		if( data == 1){
			
			jQuery.facebox('login successful!');

		}else{
			jQuery.facebox('login failed');

		}
		

        });

    });

});
