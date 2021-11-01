@extends('layout')
@section('title', '商品管理編集')
@section('content')
<div>
    <h2>商品管理編集</h2>
    <form method="post" action="{{ route('update') }}" onSubmit="return checkSubmit()">
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
                        value="{{ $product->name }}"
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
                    <th>商品カテゴリー</th>
                    <td>
                        <select id="product_category_id" name="product_category_id" class="form-control">
                            @foreach ($product_category as $value)
                                <option value="{{ $value->id }}" @if($product->id == $value->id) selected @endif>{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                    <th>金額</th>
                    <td>
                        <input
                        id="price"
                        name="price"
                        class="form-control"
                        value="{{ $product->price }}"
                        type="text"
                        >
                        円
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
                        >{{ $product->description }}</textarea>
                    @if ($errors->has('description'))
                        <div class="text-danger">
                            {{ $errors->first('description') }}
                        </div>
                    @endif
                    </td>
                </tr>
            </table>
            <input type="hidden" name="update_user" value="{{ $user_id }}">
            <input type="hidden" name="id" value="{{ $product->id }}">
        </div>
        <div class="mt-5">
            <a class="btn btn-secondary" href="{{ route('productList') }}">
                キャンセル
            </a>
            <button type="submit" class="btn btn-primary">
                更新する
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
