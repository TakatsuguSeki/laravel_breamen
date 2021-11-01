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
                        <button type="button" class="btn btn-primary" onclick="location.href='/product_list/edit/{{ $product->id }}'">編集</button>
                        <form method="post" action="{{ route('delete', $product->id) }}" onSubmit="return checkDelete()">
                            @csrf
                            <button type="submit" class="btn btn-danger">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
<script>
    function checkDelete(){
    if(window.confirm('削除してよろしいですか？')){
        return true;
    } else {
        return false;
    }
    }
</script>
@endsection
