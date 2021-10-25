@include('template.header')
<main class="list-main" id="earnings_list">
    <div class="top-container">
            <form class="indicate" action="" method="get">
                <input type="month" name="month" value="month">
                <input type="submit" name="indicate" value="表示">
            </form>
            <form  action="" method="post">
                <input class="add" type="submit" value="新規登録" formaction="earnings_edit.php?status=add">
                <table border="1">
                    <tr>
                        <th>日付</th>
                        <th>売上総数</th>
                        <th>売上総額（円）</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>売上の日付</td>
                        <td>numberformatされた売上個数</td>
                        <td>numerformatされた合計金額</td>
                        <td>
                            <input type="submit" value="編集" formaction="earnings_edit.php?status=edit&id">
                        </td>
                    </tr>
                </table>
            </form>
    </div>
</main>
@include('template.footer')
