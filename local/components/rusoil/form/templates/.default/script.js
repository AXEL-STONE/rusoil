$(document).ready(function() {
    $(document).on('click','.add-make-list', function() {
        var html = $('.list-make .make-item:last-child').html();
        $('.list-make').append('<div class="input-group mb-2 make-item">'+html+'</div>');
        return false;
    }).on('click','.del-item', function() {
        if($('.make-item').length > 1) {
            $(this).closest('.make-item').remove();
        }
        return false;
    });
});