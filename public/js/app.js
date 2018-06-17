function calculatePrice() {
    var prices = [];
    $('.price').each(function() {
        var last = $(this).text().lastIndexOf(' ') + 1;
        var price = parseFloat($(this).text().slice(last));
        prices.push(price);
    });
    return prices.reduce((a,b) => a + b, 0);
}

function addToCart(data) {
    $.ajax({
        url: "/meal/add/",
        type: "POST",
        data: {'add' : data},
    }).done(
        function(response) {
            $("#cart").text("Cart["+response+"]")
            .effect("shake", {times: 2, direction: 'down', distance: 10}, 1000);
        }
    );
}

function removeFromCart(data, element) {
    $.ajax({
        url: "/meal/remove/",
        type: "POST",
        data: {'id' : data},
    }).done(
        function(response) {
            element.hide('slow', function(){element.remove();$('#price-number').text(calculatePrice());});
            $("#cart").text("Cart["+response+"]")
            .effect("shake", {times: 2, direction: 'down', distance: 10}, 1000);
        }
    );
}

function init() {
    $(document).foundation();
    $('a#remove-cart-button').click(function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        var box = $(this).closest('div.box');
        var endLink = link.substring(link.lastIndexOf("/") + 1);
        removeFromCart(endLink, box);
    });
    $('a#cart-button').click(function(e) {
        e.preventDefault();
        var link = $(this).attr('href');
        var endLink = link.substring(link.lastIndexOf("/") + 1);
        addToCart(endLink);
    });
    if ($('.price').length) {$('#price-number').text(calculatePrice());}
}

$(document).ready(init);

