jQuery(document).ready( function(){
    // Verificacion de consola
    //console.log('Documento listo');
    
    /** ENVIO DE MENSAJE PARA SOPORTE **
    * Verificar si usuario intenta enviar mensaje.
    * Recuperar los datos.
    * Hacer el Ajax.
    * Validar y generar mensajes
    **/
    jQuery('#support_form').submit( function(e) {
        // verificacion de evento en cosola
        //console.log('enviando');
        var username = jQuery('input[name=gg_wp_user]');
        var mensaje = jQuery('textarea[name=gg_mensaje]');
        //Verifico si viene algo en mensaje, de lo contrario ERROR
        //console.log(mensaje.val());
        if ( mensaje.val().length > 0 ){
            jQuery.ajax({
                type : 'POST',
                url : ajaxurl,
                data:{
                    'action': 'ajaxConversion',
                    'action': 'send_mail_via_ajax',
                    'username': username.val(),
                    'mensaje': mensaje.val()
                },
                dataType: 'text',
                beforeSend  : function(){
                    jQuery('#support-submit').html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');    
                },
                error       : function(data){
                    console.log(data);
                },
                success     : function(data){
                    jQuery('#form-submit-wrapper').html(data);
                    console.log(data);
                    if( data == 0 ){
                        //show error
                        jQuery('#send-message').html(
                            '<p class="text-warning">' +
                            '<i class="fa fa-exclamation-circle" aria-hidden="true"></i> Su mensaje no ha podido enviarse. Intentelo mas tarde.' +
                            '</p>'
                        );
                    }else{
                        jQuery('#send-message').html(
                            '<p class="text-success">' +
                            '<i class="fa fa-check-circle" aria-hidden="true"></i> Gracias por enviar el mensaje. Se pondrán en contacto con usted pronto.' +
                            '</p>'
                        );
                        //clean inputs
                        mensaje.val('');
                        jQuery('#support-submit').html('Enviar');  
                        //grecaptcha.reset();
                    }
                }
            })
        }else{
            jQuery('#send-message').html('<p class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No puede enviar un mensaje vacio</p>');
        }
        e.preventDefault();
    });    
});

jQuery(window).load(function(){
    // Verificacion de consola
    //console.log('Window cargo');
});