$(document).ready(function(){

    console.log('CookieOptIn');

    $('.bs-checkbox').click(function(){
        if (!$(this).hasClass('ronly')) {
            $(this).toggleClass('checked');
        }
    });

});