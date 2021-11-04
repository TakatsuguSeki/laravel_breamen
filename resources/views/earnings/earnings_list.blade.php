@extends('layout')
@section('title', '売上一覧')
@section('content')
<div class="row">
    <div>
        <h2>売上一覧</h2>
        @if (session('err_msg'))
            <p class="text-danger">
                {{ session('err_msg') }}
            </p>
        @endif
        <form class="indicate" action="" method="get">
            @csrf
            <input type="month" name="month" value="{{ old('month', \Carbon\Carbon::now()->format('Y-m')) }}">
            <input type="submit" name="indicate" value="表示">
        </form>
        <form action="{{ route('earningsAdd') }}" method="get">
            @csrf
            <button type="submit">新規登録</button>
        </form>
        <table class="table table-striped">
            <tr>
                <th>日付</th>
                <th>売上総数</th>
                <th>売上総額（円）</th>
                <th></th>
            </tr>
            @foreach($earnings as $earning)
                <tr>
                    <td>{{ $earning->date }}</td>
                    <td>{{ $earning->totalnum }}</td>
                    <td>{{ $earning->totalprice }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" onclick="location.href='/earnings_list/edit/{{ $earning->id }}'">編集</button>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
