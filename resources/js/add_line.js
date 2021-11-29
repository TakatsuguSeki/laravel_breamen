$(function () {
    $("#addRow").click(function(){
        //最終行のjqueryオブジェクト取得
        var obj = $('#RowTemplate').clone();
        obj.show();
        //最後尾にjqueryオブジェクト追加
        $('.line').append(obj);
    });
    
    $(document).on('click', '.remove', function() {
        $(this).parents('tr').remove();
    })
})
