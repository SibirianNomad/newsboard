$(function(){$("#phone").mask("+7(999)-999-9999");})
function uploadPhoto(){
    $('#uploadPhoto').submit();
}
function readURL(input)
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
        }

        reader.readAsDataURL(input.files[0]);
    }
}

