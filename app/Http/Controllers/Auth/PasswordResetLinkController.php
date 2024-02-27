<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        $pageConfigs = ['myLayout' => 'blank'];
        return view('templates.auth.forgot_password', ['pageConfigs' => $pageConfigs]);
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }

    public function passwordResetSubmit(Request $req)
    {
        $req->validate([
            'email' => ['required', 'email'],
        ]);

        $ifExists = User::where('email',$req->email)->first();
        if($ifExists)
        {
            $routeLink = url('/reset-password')."?email=".$req->email;
            Mail::to($req->email)->send(new ResetPasswordMail($routeLink));
            return redirect()->route('login')->with('success','New password reset link sent to you mail');
        }
        else{
            return redirect()->back()->with('error','Email not found');
        }
    }

    public function passwordResetConfirm(Request $req)
    {
        $email = '';
        if($req->has('email'))
        {
            $email = $req->get('email');
        }
        $pageConfigs = ['myLayout' => 'blank'];
        return view('templates.auth.reset_password',['pageConfigs' => $pageConfigs],compact('email'));
    }

    public function passwordResetConfirmSubmit(Request $req)
    {
        $req->validate([
            'email' => ['required', 'email'],
        ]);

        $user = User::where('email',$req->email)->first();
        if($user)
        {
            $user->password = $req->password;
            if($user->save())
            {
                return redirect()->route('login')->with('success','Password reset succesfull.');
            }
            else
            {
                return redirect()->back()->with('error','Something went wrong');
            }            
        }
        else
        {
            return redirect()->back()->with('error','Email not found');
        }
    }
}
