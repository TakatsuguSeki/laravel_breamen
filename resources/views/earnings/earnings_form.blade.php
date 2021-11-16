@extends('layout')
@section('title', '売上管理登録')
@section('content')
<div>
    <h2>売上管理登録</h2>
    <form method="post" action="{{ route('addPost') }}">
        @csrf
        <div class="form-group">
            <table class="table table-striped">
                <tr>
                    <th>日付</th>
                    <td>
                        <input
                        type="date"
                        name="date"
                        class="form-control"
                        value="{{ old('month', \Carbon\Carbon::now()->format('Y-m-d')) }}"
                        >
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <th>商品</th>
                    <th>個数</th>
                </tr>
                <tr>
                    <td>
                        <select id="product_id" name="product_id[]" class="form-control" v-model="list.product_id">
                            @foreach ($products as $value)
                                <option value="{{ $value->id }}" @if(old('product_id') == $value->id) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input
                        type="text"
                        name="num[]"
                        class="form-control"
                        value="{{ old('num', 0) }}"
                        >
                    </td>
                </tr>
            </table>
            <input type="hidden" name="create_user" value="{{ $user_id }}">
            <button class="btn btn-primary">1行追加</button>
            <button class="btn btn-danger">1行削除</button>
        </div>
        <div class="mt-5">
            <a class="btn btn-secondary" href="{{ route('earningsList') }}">
                キャンセル
            </a>
            <button type="submit" class="btn btn-primary">
                確認画面へ
            </button>
        </div>
    </form>
</div>
@endsection
