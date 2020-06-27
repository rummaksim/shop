/*
$(document).ready(function () {
    $(".btn-buy").click(function () {
        let id = $(this).attr("data-id");
        $.post("/cart/add/" + id, {}, function (data) {
            $("#count-products-in-cart").html(data);
        });
        return false;
    });
});
*/
$(document).on('click', '.btn-buy', function(e){
    e.preventDefault();
    let idProduct = $(this).attr("data-id");
    $.ajax({
        type:'POST',
        url: "/cart/add/"+idProduct,
        error: function (data) {
            alert('Ошибка связи. Перезагрузите страницу и повторите попытку.');
            console.log(data);
        },
        success: function (data) {
            if (typeof data != 'undefined')
            {
                $("#count-products-in-cart").html(data);
            }
            else{
                console.log("Произошла ошибка при выборе данных");
                alert('Ошибка доступа к данным. Перезагрузите страницу и повторите попытку. Если ошибка будет повторяться, обратитесь к разработчику.');
            }
        }
    });
});
