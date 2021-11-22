$(function () {
    $('#addRow').click(function () {
        var html1 = '<tr><td><select id="product_id" name="product_id[$i]" class="form-control">'
            @foreach($products as $product)
                <option value="$product['id']" $product['id'] == $earnings_detail[$i]['product_id'] ? ' selected' : ''> $product['name']</option>
            @endforeach
        var html2 = '</select></td><td> <input type="text" name="num[$i]" class="form-control" value="old(\'num\', $earnings_detail[$i][\'num\'])"></td><td><button class="remove btn btn-danger">ー</button></td></tr>';
        $('.line').append(html);
    })

    $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
    })
})
