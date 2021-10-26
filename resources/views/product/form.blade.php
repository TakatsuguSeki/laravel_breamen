@extends('layout')
@section('title', 'ブログ投稿')
@section('content')
<div>
    <h2>商品管理登録</h2>
    <form method="post" action="{{ route('store') }}" onSubmit="return checkSubmit()">
    @csrf
        <div class="form-group">
            <table class="table table-striped">
                <tr>
                    <th>商品名</th>
                    <td>
                        <input
                        id="name"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        type="text"
                    >
                    @if ($errors->has('name'))
                        <div class="text-danger">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>金額</th>
                    <td>
                        <input
                        id="price"
                        name="price"
                        class="form-control"
                        value="{{ old('price') }}"
                        type="text"
                    >
                    @if ($errors->has('price'))
                        <div class="text-danger">
                            {{ $errors->first('price') }}
                        </div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <th>詳細</th>
                    <td>
                        <textarea
                        id="description"
                        name="description"
                        class="form-control"
                        rows="4"
                        >{{ old('description') }}</textarea>
                    @if ($errors->has('description'))
                        <div class="text-danger">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    </td>
                </tr>
            </table>
        </div>
        <div class="mt-5">
            <a class="btn btn-secondary" href="{{ route('productList') }}">
                キャンセル
            </a>
            <button type="submit" class="btn btn-primary">
                登録する
            </button>
        </div>
    </form>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
