<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BREMEN　管理画面</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="top-body">
    <div class="container">
        <header class="gl-header">
            <span>ログイン名[ {{ Auth::user()->name }} ]さん、ご機嫌いかがですか？</span>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button class="btn btn-danger">ログアウト</button>
            </form>
            <h1>BREMEN　管理画面</h1>
            <nav class="gl-nav">
                <ul>
                    <li><a href="top.php">top</a></li>
                    <li><a href="product_list.php">商品管理</a></li>
                    <li><a href="earnings_list.php">売上管理</a></li>
                    <li><a href="#">○○管理</a></li>
                    <li><a href="#">○○管理</a></li>
                    <li><a href="#">○○管理</a></li>
                </ul>
            </nav>
        </header>
        <div class="mt-5">
            <x-alert type="success" :session="session('success')"/>
            <main class="top-main">
                <div class="top-container">
                </div>
            </main>
        </div>
        <footer class=gl-footer>
            <p><small>2021 ebacorp.inc</small></p>
        </footer>
    </div>
</body>
</html>
