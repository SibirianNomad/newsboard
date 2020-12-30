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
            var img=$( "<img/>", {
                class: "col-lg-3 col-md-4 col-6",
                src:e.target.result
            });
            $('#selected_photos').append( img )
        }

        reader.readAsDataURL(input.files[0]);
    }
}
