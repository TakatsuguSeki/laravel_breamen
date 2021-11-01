@extends('layout')
@section('title', '商品詳細')
@section('content')
<div class="row">
    <table class="table table-striped">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>画像</th>
            <td>
                @if(isset($product->img))
                    <img src="/image/pc/{{ $product->img }}" alt="{{ $product->img }}">
                @endif
            </td>
        </tr>
        <tr>
            <th>登録日時</th>
            <td>{{ $product->created_at }}</td>
        </tr>
        <tr>
            <th>更新日時</th>
            <td>{{ $product->updated_at }}</td>
        </tr>
        <tr>
            <th>金額</th>
            <td>{{ $product->price }}円</td>
        </tr>
        <tr>
            <th>詳細</th>
            <td>{{ $product->description }}</td>
        </tr>
    </table>
</div>
@endsection
