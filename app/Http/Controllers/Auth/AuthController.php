<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use  App\Models\User;

class AuthController extends Controller
{
    public function __construct(User $user)
    {
        $this->user = $user;
    }

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
        $user = $this->user->getUserByLogin_id($credentials['login_id']);

        if (!is_null($user)) {
            if($this->user->isAccountLocked($user)) {
                return back()->withErrors([
                    'danger' => 'アカウントがロックされています。',
                ]);
            }

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                //ログイン成功時にエラーカウントを0にする
                $this->user->resetErrorCount($user);
                return redirect()->route('home')->with('success', 'ログインに成功しました。');
            }
            //ログイン失敗時、エラーカウントを1増やす
            $user->error_count = $this->user->addErrorCount($user->error_count);
            //エラーカウントが6以上の場合はロックする
            if ($this->user->lockAccount($user)) {
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
