$(document).ready(function () {
    $('.add-product-btn').on('click', function (e) {
        e.preventDefault();
        var name = $(this).data('name');
        var id = $(this).data('id');
        var price = $(this).data('price');
        $(this).removeClass('btn-success').addClass('btn-default disabled');
        var html =
            `<tr>
                <td>${name}</td>
                <td><input type="number" name="quantities[]" class="form-control input-sm" min="1" value="1"></td>
                <td>${price}</td>               
                <td><button class="btn btn-danger btn-sm remove-product-btn" data-id="${id}"><span class="fa fa-trash"></span></button></td>
            </tr>`;
        $('.order-list').append(html);
        $('body').on('click', '.disabled', function (e) {
            e.preventDefault();
        });
        $('body').on('click', '.remove-product-btn', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $(this).closest('tr').remove();
            $('#product-'+id).removeClass('btn-default disabled').addClass('btn-success');
        });
    });
});
