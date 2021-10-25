<span>ログイン名[ {{ Auth::user()->name }} ]さん、ご機嫌いかがですか？</span>
<form action="{{ route('logout') }}" method="post">
    @csrf
    <button class="btn btn-danger">ログアウト</button>
</form>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="{{ url('home') }}">BREMEN　管理画面</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            <a class="nav-item nav-link" href="{{ url('home') }}">top</a>
            <a class="nav-item nav-link" href="{{ url('product_list') }}">商品管理</a>
            <a class="nav-item nav-link" href="{{ url('earnings_list') }}">売上管理</a>
            <a class="nav-item nav-link" href="#">○○管理</a>
            <a class="nav-item nav-link" href="#">○○管理</a>
            <a class="nav-item nav-link" href="#">○○管理</a>
        </div>
    </div>
</nav>
