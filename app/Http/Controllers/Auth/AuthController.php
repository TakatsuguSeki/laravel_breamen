<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;

class AuthController extends Controller
{
    /**
     * @return View
     */
    public function showLogin()
    {
        return view('login.login_form');
    }

    /**
     * @param App\Http\Requests\LoginFormRequest $request
     */
    public function login(LoginFormRequest $request)
    {
        $credentials = $request->only('login_id', 'password');

        //アカウントロックされていたらはじく
        $user = User::where('login_id', '=', $credentials['login_id'])->first();

        if (!is_null($user)) {
            if($user->locked_flg === 1) {
                return back()->withErrors([
                    'danger' => 'アカウントがロックされています。',
                ]);
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                //ログイン成功時にエラーカウントを0にする
                if ($user->error_count > 0) {
                    $user->error_count =0;
                    $user->save();
                }

                return redirect()->route('home')->with('success', 'ログインに成功しました。');
            }

            //ログイン失敗時、エラーカウントを1増やす
            $user->error_count = $user->error_count + 1;
            //エラーカウントが6以上の場合はロックする
            if ($user->error_count > 5) {
                $user->locked_flg = 1;
                $user->save();
                return back()->withErrors([
                    'danger' => 'アカウントがロックされました。解除したい場合は運営担当者に連絡してください。',
                ]);
            }
            $user->save();

        }

        return back()->withErrors([
            'danger' => 'ログインIDかパスワードが間違っています。',
        ]);
    }

    /**
    * ユーザーをアプリケーションからログアウトさせる
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.show')->with('danger', 'ログアウトしました。');
    }

}
