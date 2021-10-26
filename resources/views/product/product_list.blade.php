@extends('layout')
@section('title', '商品一覧')
@section('content')
<div class="row">
    <div>
        <h2>商品一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <table class="table table-striped">
            <tr>
                <th>@sortablelink('id', 'ID')</th>
                <th>@sortablelink('name', '商品名')</th>
                <th>画像</th>
                <th>登録日時</th>
                <th>@sortablelink('created_at', '更新日時')</th>
                <th>
                    <form action="{{ route('add') }}" method="get">
                        @csrf
                        <button type="submit">新規登録</button>
                    </form>
                </th>
            </tr>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td><a href="/product_list/{{ $product->id }}">{{ $product->name }}</a></td>
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
                            <button type="submit">編集</button>
                            <input type="submit" name="delete" value="削除" formaction="product_list.php" onclick="return confirm('本当に削除しますか？')">
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
