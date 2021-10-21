<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BREMEN　管理ログイン画面</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
</head>
<body>
    <form class="form-signin" method="post" action="{{ route('login') }}">
        @csrf
        <h1 class="h3 mb-3 font-weight-normal">BREMEN<br>管理ログイン画面</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-alert type="danger" :session="session('danger')"/>

        <label for="inputId" class="sr-only">Login ID</label>
        <input type="text" id="inputid" name="login_id" class="form-control" placeholder="ログインID" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">認証</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021 ebacorp.inc</p>
    </form>
</body>
</html>
