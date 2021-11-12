@extends('layout')
@php
$totalprice = 0;
@endphp
@section('title', '売上管理確認画面')
@section('content')
<div>
    <h2>売上管理確認画面</h2>
    <div class="form-group">
        <table class="date">
            <tr>
                <th>日付</th>
                <td>{{ $input['date'] }}</td>
            </tr>
        </table>
        <table class="detail">
            <tr>
                <th>商品名</th>
                <th>単価</th>
                <th>個数</th>
                <th>小計</th>
            </tr>
            @for ($i = 0; $i < count($input['num']); $i++)
                <tr>
                    <th>{{ $product[$i]['name'] }}</th>
                    <td>{{ number_format($product[$i]['price']) }}</td>
                    <td>{{ $num = !empty($input['num'][$i]) ? number_format($input['num'][$i]) : 0 }}</td>
                    <td>{{ number_format($product[$i]['price'] * $num) }}</td>
                    @php
                        $totalprice += ($product[$i]['price'] * $num)
                    @endphp
                </tr>
            @endfor
            </table>
        <table class="total">
            <tr>
                <th>売上総数</th>
                <td>
                    {{ number_format($totalnum = array_sum($input['num'])) }}
                </td>
            </tr>
            <tr>
                <th>売上総額</th>
                <td>{{ number_format($totalprice) }}</td>
            </tr>
        </table>
    </div>
    <form method="post" action="{{ route('earningsStore') }}">
        @csrf
        @if (isset($input['earnings_id']))
            <input type="hidden" name="earnings_id" value="{{ $input['earnings_id'] }}">
        @endif
        <input type="hidden" name="create_user" value="{{ $user_id }}">
        <input type="hidden" name="date" value="{{ $input['date'] }}">
            @for ($i = 0; $i < count($input['num']); $i++)
                <input type="hidden" name="name[]" value="{{ $product[$i]['name'] }}">
                <input type="hidden" name="price[]" value="{{ $product[$i]['price'] }}">
                <input type="hidden" name="product_id[]" value="{{ $input['product_id'][$i] }}">
                <input type="hidden" name="num[]" value="{{ $input['num'][$i] }}">
            @endfor
        <div class="mt-5">
            <a class="btn btn-secondary" href="{{ route('earningsList') }}">
                キャンセル
            </a>
            <button type="submit" class="btn btn-primary">
                登録する
            </button>
        </div>
    </form>
</div>
@endsection
