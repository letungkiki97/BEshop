function selectImage(e){
    $('body').delegate('.wrap-library .image-item', 'click', function(){
        if($(this).hasClass('active')){
            $(this).removeClass('active');
        }else{
            $(this).addClass('active');
            if(e != 'multi'){
                $('.wrap-library .image-item').not($(this)).removeClass('active');
            }
            
        }

        disabledButton();
        
    });
}

function disabledButton(){
    var disabled = true;
    $('.wrap-library .image-item').each(function(){
        if($(this).hasClass('active')){
            disabled = false;
        }
    });

    if(!disabled){
        $('#inset_image').removeAttr('disabled');
    }else{
        $('#inset_image').attr('disabled', 'disabled');
    }
}

$('.search_images').on('keyup', function(){
    var name    = $(this).val();
    $('.wrap-library').empty();
    var url_show        = '/ajax/load-images';
    var data_show       = {};
    data_show.name      = name;
    data_show.type      = 'show';
    $('.wrap-loading-icon.show_img').css('display', 'inline-block');
    $.get(url_show, data_show, function(res){
        var current     = JSON.parse(res);
        if(current.html != ''){
            $('.wrap-library').html(current.html);
            if(current.count >= 15){
                $('.wrap-library').css('overflow-y', 'auto');    
            }else{
                $('.wrap-library').css('overflow-y', 'hidden');  
            }
            
        }else{
            $('.wrap-library').css('overflow-y', 'hidden').html('<div>No results.</div>');
        }
        
        $('.wrap-loading-icon.show_img').css('display', 'none');
    });
});

function loadImage(){
    var i = 0;
    $('.wrap-library').bind('scroll', function(){
        if($(this).scrollTop() + $(this).innerHeight()>=$(this)[0].scrollHeight){
            var img_name    = $('.search_images').val();
            var url         = '/ajax/load-images';
            var data        = {};
            data.name       = img_name;
            data.skip       = i;
            data.type       = 'load';
            $('.wrap-library .wrap-loading-icon').css('display', 'inline-block');
            $.get(url, data, function(res){
                var current     = JSON.parse(res);
                $('.wrap-library .wrap-loading-icon').remove();
                $('.wrap-library .wrap-loading-icon').css('display', 'none');
                $('.wrap-library').append(current.html);
            });
            i++;
        }
    });
}