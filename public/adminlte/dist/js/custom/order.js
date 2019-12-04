$(document).ready(function () {

    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $(this).data('price');
        $(this).removeClass('btn-success').addClass('btn-default disabled');
        var html =
            `<tr>
                <input type="hidden" name="products[]" value="${id}">
                <td>${name}</td>
                <td><input type="number" name="quantities[]" data-price="${price}" class="form-control input-sm product-quantity" min="1" value="1"></td>
                <td class="product-price">${price}</td>               
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;
        $('.order-list').append(html);
        calculateTotal();
    });

    $('body').on('click', '.disabled', function (e) {
        e.preventDefault();
    });

    $('body').on('click', '.remove-product-btn', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $(this).closest('tr').remove();
        $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        calculateTotal();
    });

    $('body').on('keyup change', '.product-quantity', function () {
        var quantity = parseInt($(this).val());
        var uitPrice = $(this).data('price');
        $(this).closest('tr').find('.product-price').html(quantity * uitPrice);
        calculateTotal();
    });

    $('.order-products').on('click', function (e) {
        e.preventDefault();
        var url = $(this).data('url');
        // alert(url);
        var method = $(this).data('method');
        $.ajax({
            url: url,
            method: method,
            success: function (data) {
                $('#order-product-list').empty();
                $('#order-product-list').append(data);
            }
        })
    });

    $(document).on('click', '.print-btn', function() {

        $('#print-area').printThis();

    });

});


function calculateTotal() {
    var price = 0;
    $('.order-list .product-price').each(function (index) {
        price += parseInt($(this).html());
    });
    $('.total-price').html(price);
    if (price > 0) {
        $('#add-order').removeClass('disabled')
    }else {
        $('#add-order').addClass('disabled')
    }
}
