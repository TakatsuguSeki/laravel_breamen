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
            <div id="app">
                <table>
                    <thead>
                        <tr>
                            <th>商品</th>
                            <th>個数</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for=" (list, index) in lists " v-bind:key="list.id">
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
                                v-model="list.num"
                                value="{{ old('num', 0) }}"
                                >
                            </td>
                            <td>
                                <button v-on:click="del(index)" class="btn btn-danger">
                                    1行削除
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" name="create_user" value="{{ $user_id }}">
                <button v-on:click="add" class="btn btn-primary">
                    1行追加
                </button>
            </div>
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
var app = new Vue({
    el: '#app',
    data() {
        return {
            lists: [{ product_id: $value->id, num: 0 }]
        }
    },
    methods: {
        add: function() {
            this.lists.push({ product_id: $value->id, num: 0 })
        },
        del: function(index) {
            this.lists.splice(index, 1)
        },
    }
})
</script>
@endsection
