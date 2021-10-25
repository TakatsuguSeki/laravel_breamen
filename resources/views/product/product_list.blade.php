@extends('layout')
@section('title', '商品一覧')
@section('content')
<div class="row">
    <table class="table table-striped">
        <tr>
            <th>
                <span><a class="sort" href="product_list.php?sort=id&order=ASC">▲</a></span>
                <p>ID</p>
                <span><a class="sort" href="product_list.php?sort=id&order=DESC">▼</a></span>
            </th>
            <th>
                <span><a class="sort" href="product_list.php?sort=name&order=ASC">▲</a></span>
                <p>商品名</p>
                <span><a class="sort" href="product_list.php?sort=name&order=DESC">▼</a></span>
            </th>
            <th>画像</th>
            <th>登録日時</th>
            <th>
                <span><a class="sort" href="product_list.php?sort=updated_at&order=ASC">▲</a></span>
                <p>更新日時</p>
                <span><a class="sort" href="product_list.php?sort=updated_at&order=DESC">▼</a></span>
            </th>
            <th>
                <form action="product_edit.php?status=add" method="post">
                    @csrf
                    <input type="submit" value="新規登録">
                </form>
            </th>
        </tr>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->name }}</td>
                <td>
                    @if(isset($product->img))
                        <img src="/image/pc/{{ $product->img }}" alt="{{ $product->img }}" width="150">
                    @endif
                </td>
                <td>{{ $product->created_at }}</td>
                <td>
                    @if(isset($product->updated_at))
                        {{ $product->updated_at }}
                    @endif
                </td>
                <td>
                    <form action="product_edit.php?status=edit&id" method="post">
                        @csrf
                        <input type="hidden" name="id" value="id">
                        <input type="submit" value="編集">
                        <input type="submit" name="delete" value="削除" formaction="product_list.php" onclick="return confirm('本当に削除しますか？')">
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection
