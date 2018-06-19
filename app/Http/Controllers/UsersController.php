<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * UsersController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        if ($socialUser = \App\User::socialUser($request->get('email'))->first()) {
        if ($socialUser = User::socialUser($request->get('email'))->first()) {
            return $this->updateSocialAccount($request, $socialUser);
        }

        return $this->createNativeAccount($request);
    }

    /**
     * Confirm user's email address.
     *
     * @param string $code
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirm($code)
    {
//        $user = \App\User::whereConfirmCode($code)->first();
        $user = User::whereConfirmCode($code)->first();

        if (! $user) {
            return $this->respondError('URL이 정확하지 않습니다.');
        }

        $user->activated = 1;
        $user->confirm_code = null;
        $user->save();

//        auth()->login($user);
//        return $this->respondCreated($user->name . '님, 환영합니다. 가입 확인되었습니다.');

        return $this->responsConfirmed($user);

    }

    /**
     * Make an error response.
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function respondError($message)
    {
        flash()->error($message);

        return redirect('/');
    }

    /**
     * A user has logged into the application with social account before.
     * But s/he tries to register an native account again.
     * So updating his/her existing social account with the information.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    protected function updateSocialAccount(Request $request, \App\User $user)
    protected function updateSocialAccount(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|confirmed|min:6',
        ]);

        $user->update([
            'name' => $request->input('name'),
            'password' => bcrypt($request->input('password')),
        ]);

//        auth()->login($user);

//        return $this->respondCreated($user->name . '님, 환영합니다.');
        return $this->respondUpdated($user);

    }

    /**
     * A user tries to register a native account for the first time.
     * S/he has not logged into this service before with a social account.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function createNativeAccount(Request $request)
    {
        $this->validate($request, [
            'name'  => 'required|max:255',
            'email'  => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $confirmCode = str_random(60);

//        $user = \App\User::create([
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirm_code' => $confirmCode,
        ]);

        event(new \App\Events\UserCreated($user));

//        return $this->respondCreated('가입하신 메일 계정으로 가입확인 메일을 보내드렸습니다. 가입확인하시고 로그인해 주세요.');
        return $this->respondConfirmationEmailSent();

    }

    /**
     * @param \App\User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function responsConfirmed(User $user)
    {
        auth()->login($user);
        flash(
            trans('auth.users.info_confirmed', ['name' => $user->name])
        );

        return redirect(route('home'));
    }

    /* Response Methods */

    /**
     * @param \App\User $user
     * @param null $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    protected function respondSuccess(User $user, $message = null)
    {
        auth()->login($user);
        flash($message);

        return ($return = request('return'))
            ? redirect(urldecode($return))
            : redirect()->intended();
    }

    /**
     * Make a success response.
     *
     * @param string $message
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    protected function respondCreated($message)
    protected function respondUpdated(User $user)
    {
//        flash($message);
        return $this->respondSuccess(
            $user,
            trans('auth.users.info_welcome', ['name' => $user->name])
        );
    }

    protected function respondConfirmationEmailSent()
    {
        flash(trans('auth.users.info_confirmation_sent'));

//        return redirect('/');
        return redirect(route('root'));
    }
}
