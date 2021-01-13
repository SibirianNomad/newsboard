
$(function(){$("#phone").mask("+7(999)-999-9999");})
function readURLAvatar(input){
    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e)
        {
           var img=$(input).prev();
           $(img).attr('src',e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function readURLImage(input)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();

        reader.onload = function (e)
        {
            $('#photo').remove();
            var img=$( "<img/>", {
                class: "col-lg-3 col-md-4 col-6",
                src:e.target.result,
                id:"photo"
            });
            $('#selected_photos').append( img );
            let width=$('#photo').width()-($('#photo').width()*5/100);
            $('.close').css('left',width);
            $('.close').css('z-index','100');
            $('.close').removeClass('d-none');
            $('.close').on('click',function () {
                $('#photo').remove();
                $('.close').addClass('d-none');
                $(input).val('');
            });
        }

        reader.readAsDataURL(input.files[0]);
    }
}
function showPhoto(e){
    $('.img-photo img').remove();
    var src=$(e).attr('src');
    var img=$( "<img/>", {
        src:src,
        class: 'w-100'
    });
    $('.img-photo').append(img);
}


