$(document).ready( function(){
    $('#select-month-btn, #show-calendar').click( function(){
        $('#month-picker').toggleClass('active');
        $('body').css('touch-action','none');
    });
    $('#btn-order-details').click( function(){
        $('#order-details-box').toggleClass('active');
        $('body').css('touch-action','none');
    })
    $('#btn-go-back').click( function(){
        $('#month-picker').toggleClass('active');
        $('body').css('touch-action','auto');
    });
    $('#btn-go-back-sumary').click( function(){
        $('#order-details-box').toggleClass('active');
        $('body').css('touch-action','auto');
    });
    $('#btn-ok-date').click( function(){
        $('#month-picker').toggleClass('active');
        $('body').css('touch-action','auto');
    })
})