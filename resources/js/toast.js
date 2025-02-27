
function toast (message, variant, time = 3000){
    $('#toast').removeClass('hidden');
    $('#toastMessage').text(message)
    $('#toastVariant').addClass('alert-'+variant)
    setTimeout(function() {
        $('.toast').addClass('hidden');
    }, time);
}