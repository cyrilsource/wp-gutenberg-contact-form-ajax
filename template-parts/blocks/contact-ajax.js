jQuery( document ).ready( function( $ ) {
  'use strict';
  //variables
  //busy to avoid a compulsive click
  var busy = null;
  var error = false;
  var form = $( '#contactForm' );
  var name = $( '#name' );
  var message = $( '#message' );
  var email = $( '#email' );
  var phone = $( '#phone' );
  var url = $( '#url' );
  
  //when submit is clicked
  $( '#contactForm' ).on( 'click', '#submit', function( e ) {
  error = false;
  e.preventDefault();
  
  //errors treatments
  if ( undefined !== name.val() ) {
    if ( 0 == name.val().length  ) {
      $( '#nameError' ).show( 'slow' ).delay( 4000 ).hide( 'slow' );
      name.addClass( 'inputError' );
      setTimeout( function() {
        name.removeClass( 'inputError' );
    }, 4000 );
      error = true;
      }
    };
  if ( undefined !== message.val() ) {
    if ( 0 == message.val().length  ) {
      $( '#messageError' ).show( 'slow' ).delay( 4000 ).hide( 'slow' );
      error = true;
      }
    };
  if ( undefined !== email.val() ) {
    if ( ! $( email ).val().match( /^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i ) ) {
      $( '#emailError' ).show( 'slow' ).delay( 4000 ).hide( 'slow' );
      email.addClass( 'inputError' );
      setTimeout( function() {
        email.removeClass( 'inputError' );
    }, 4000 );
      error = true;
      }
    };
    if ( undefined !== phone.val() ) {
      if ( ! $( phone ).val().match( '^[0-9]+$' ) ) {
      $( '#phoneError' ).show( 'slow' ).delay( 4000 ).hide( 'slow' );
      phone.addClass( 'inputError' );
      setTimeout( function() {
        phone.removeClass( 'inputError' );
    }, 4000 );
      error = true;
        }
      };
  if ( undefined !== url.val() ) {
    if ( ! $( url ).val().match( /^( http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/gm ) ) {
      $( '#urlError' ).show( 'slow' ).delay( 4000 ).hide( 'slow' );
      url.addClass( 'inputError' );
      setTimeout( function() {
        url.removeClass( 'inputError' );
    }, 4000 );
      error = true;
      }
    };
  
  if ( ! error  ) {

    if ( busy ) {
      busy.abort();
    }
    //send to admin-ajax.php of WordPress
    busy = $.ajax({
    url: ajaxurl,
    type: 'POST',
    data: form.serialize(),
    success: function( response ) {
      if ( 'success' == response ) {
        form[ 0 ].reset();
        $( '#messageSuccess' ).show( 'slow' ).delay( 4000 ).hide( 'slow' );
        }
      if ( 'error' == response ) {
        $( '#textError' ).show( 'slow' ).delay( 6000 ).hide( 'slow' );
        }
      }
    });
    }
  return false;
  });
});
