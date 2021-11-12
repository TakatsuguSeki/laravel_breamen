@extends('layout')
@section('title', '売上管理編集')
@section('content')
<div>
    <h2>売上管理編集</h2>
    <form method="post" action="{{ route('editPost') }}">
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
            <div id="app">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>商品</th>
                            <th>個数</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($earnings_detail as $value)
                        <tr v-for=" (list, index) in lists " v-bind:key="list.id">
                            <td>
                                <select id="product_id" name="product_id[]" class="form-control" v-model="list.product_id">
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}" @if($product->id == $value->product_id) selected @endif>{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input
                                type="text"
                                name="num[]"
                                class="form-control"
                                v-model="list.num"
                                value="{{ old('num', $value->num) }}"
                                >
                            </td>
                            <td>
                                <button v-on:click="del(index)" class="btn btn-danger">
                                    1行削除
                                </button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <input type="hidden" name="create_user" value="{{ $user_id }}">
                <button v-on:click="add" class="btn btn-primary">
                    1行追加
                </button>
            </div>
        </div>
        <div class="mt-5">
            <input type="hidden" name="earnings_id" value="{{ $earnings->id }}">
            <a class="btn btn-secondary" href="{{ route('earningsList') }}">
                キャンセル
            </a>
            <button type="submit" class="btn btn-primary">
                確認画面へ
            </button>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var app = new Vue({
    el: '#app',
    data() {
        return {
            lists: [{ product_id: $product->id, num: $value->num }]
        }
    },
    methods: {
        add: function() {
            this.lists.push({ product_id: $product->id, num: 0 })
        },
        del: function(index) {
            this.lists.splice(index, 1)
        },
    }
})
</script>
@endsection
