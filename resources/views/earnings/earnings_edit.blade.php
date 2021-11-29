@extends('layout')
@php
if (($count = count($earnings_detail)) == 0) {
    $count = 1;
}

if (isset($postCount)) {
    $count = $postCount;
}
@endphp
@section('title', '売上管理編集')
@section('content')
<div>
    <h2>売上管理編集</h2>
    <form id="edit" method="post" action="{{ route('editPost') }}">
    @csrf
        <div class="form-group">
            <table class="table table-striped">
                <tr>
                    <th>日付</th>
                    <td>
                        {{ $earnings->date }}
                        <input type="hidden" name="date" value="{{ $earnings->date }}">
                    </td>
                </tr>
            </table>
            <table class="table table-striped">
                <tr>
                    <th>商品</th>
                    <th>個数</th>
                    <th></th>
                </tr>
                <tbody class="line">
                    @for ($i = 0; $i < $count; $i++)
                    <tr>
                        <td>
                            <select id="product_id" name="product_id[{{ $i }}]" class="form-control">
                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}" {{ $product['id'] == $earnings_detail[$i]['product_id'] ? ' selected' : '' }}>{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input
                            type="text"
                            name="num[{{ $i }}]"
                            class="form-control"
                            value="{{ old('num', $earnings_detail[$i]['num']) }}"
                            >
                        </td>
                        <td><button class="remove btn btn-danger">ー</button></td>
                    </tr>
                    @endfor
                    <tr id="RowTemplate" style="display: disabled;">
                        <td>
                            <select id="product_id" name="product_id[]" class="form-control">
                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}" {{ isset($earnings_detail[$i]['product_id']) && $product['id'] == $earnings_detail[$i]['product_id'] ? ' selected' : '' }}>{{ $product['name'] }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input
                            type="text"
                            name="num[]"
                            class="form-control"
                            value="{{ old('num', isset($earnings_detail[$i]['num']) ? $earnings_detail[$i]['num'] : 0) }}"
                            >
                        </td>
                        <td><button class="remove btn btn-danger">ー</button></td>
                    </tr>
                </tbody>
            </table>
            <input type="hidden" name="create_user" value="{{ $user_id }}">
            <input type="hidden" name="earnings_id" value="{{ $earnings['id'] }}">
        </div>
    </form>
    <button id="addRow" type="button" class="btn btn-primary">1行追加</button>
    <div class="mt-5">
        <a class="btn btn-secondary" href="{{ route('earningsList') }}">
            キャンセル
        </a>
        <button type="submit" class="btn btn-primary" form="edit">
            確認画面へ
        </button>
    </div>
</div>
<script src="{{ mix('js/add_line.js') }}"></script>
@endsection
