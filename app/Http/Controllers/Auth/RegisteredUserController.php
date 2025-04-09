<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:60'],
            //'path_img' => 'image|mimes:png,jpg,jpeg,gif|max:800',
            'tel' => ['required', 'string', 'max:20','unique:'.User::class],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:60', 'unique:'.User::class],
            'password' => ['required', Rules\Password::defaults()],
            
        ]);
        //$imageName=Storage::disk('public')->put('/requets',$request->file('path_img'));
        //$imageName=time() . '.' . $request['path_img']->extension();
        // $request['path_img']->move(public_path('storage'),$imageName);

        $user = User::create([
            'name' => $request->name,
            //'path_img'=>$imageName,  
            'tel' => $request->tel,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
