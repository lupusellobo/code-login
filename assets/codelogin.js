(function ($) {
  console.log('code login');

  $('#codelogin-request').submit( function ( e ) {
    e.preventDefault();
    let $this = $( this );
    let value = $this.find( 'input[type=text]' ).val();
    let $error = $this.find( '.error');
    $error.html( '' );
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: codelogin.ajax_url,
      data: {
        action: 'code_login_send_code',
        value: value,
        nonce: $this.attr( 'data-nonce' ),
      },
      success: function (response) {
        $this.hide();
        $('#codelogin-code').show();
      },
      error: function ( err ) {
        $error.html( err.responseJSON.error );
      }
    });
  });

  $('#codelogin-code').submit( function ( e ) {
    e.preventDefault();
    let $this = $( this );
    let value = $this.find( 'input[type=number]' ).val();
    let $error = $this.find( '.error');
    $error.html( '' );
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: codelogin.ajax_url,
      data: {
        action: 'code_login_validate_code',
        value: value,
        nonce: $this.attr( 'data-nonce' ),
      },
      success: function ( response ) {
        window.location.href = response.url;
      },
      error: function ( err ) {
        $error.html( err.responseJSON.error );
      }
    });
  });
})( jQuery );
