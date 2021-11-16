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
    <form method="post" action="">
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
                </tr>
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
                    </tr>
                @endfor
            </table>
            <input type="hidden" name="create_user" value="{{ $user_id }}">
            <button name="line_add" class="btn btn-primary" value="1行追加">1行追加</button>
            <button name="line_del" class="btn btn-danger" value="1行削除">1行削除</button>
        </div>
        <div class="mt-5">
            <input type="hidden" name="earnings_id" value="{{ $earnings['id'] }}">
            <input type="hidden" name="count" value="{{ $count }}">
            <a class="btn btn-secondary" href="{{ route('earningsList') }}">
                キャンセル
            </a>
            <button type="submit" class="btn btn-primary" formaction="{{ route('editPost') }}">
                確認画面へ
            </button>
        </div>
    </form>
</div>
@endsection
