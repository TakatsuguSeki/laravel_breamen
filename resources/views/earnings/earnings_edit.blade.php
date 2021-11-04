@extends('layout')
@section('title', '売上管理編集')
@section('content')
<div>
    <h2>売上管理編集</h2>
    <form method="post" action="{{ route('update') }}">
        @csrf
        <div class="form-group">
            <table class="table table-striped">
                <tr>
                    <th>日付</th>
                    <td>
                        {{ $earnings->date }}
                    </td>
                </tr>
            </table>
            <table class="table table-striped">
                <tr>
                    <th>商品</th>
                    <th>個数</th>
                </tr>
                @foreach ($earnings_detail as $value)
                <tr>
                    <td>
                        <select id="product_id" name="product_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" @if($product->id == $value->product_id) selected @endif>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input
                        type="text"
                        name="num"
                        class="form-control"
                        value="{{ old('num', $value->num) }}"
                        >
                    </td>
                </tr>
                @endforeach
            </table>
            <input type="hidden" name="create_user" value="{{ $user_id }}">
            <button type="submit" class="btn btn-primary">
                1行追加
            </button>
            <button type="submit" class="btn btn-danger">
                1行削除
            </button>
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
<script>
function checkSubmit(){
if(window.confirm('更新してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
