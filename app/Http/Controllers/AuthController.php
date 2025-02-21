<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

use function Pest\Laravel\json;

class AuthController extends Controller
{
    //

    public function showLogin(Request $request)
    {
        $user = $request->user();
        if ($user) {
            return redirect()->route('posts.index');
        } else {
            return view('login');
        }
    }
    public function showRegister(Request $request)
    {
        $user = $request->user();
        if ($user) {
            return redirect()->route('posts.index');
        } else {
            return view('register');
        }
    }

    public function setTheme(Request $request)
    {
        $themes = [
            "light",
            "dark",
            "cupcake",
            "bumblebee",
            "emerald",
            "corporate",
            "synthwave",
            "retro",
            "cyberpunk",
            "valentine",
            "halloween",
            "garden",
            "forest",
            "aqua",
            "lofi",
            "pastel",
            "fantasy",
            "wireframe",
            "black",
            "luxury",
            "dracula",
            "cmyk",
            "autumn",
            "business",
            "acid",
            "lemonade",
            "night",
            "coffee",
            "winter",
            "dim",
            "nord",
            "sunset",
        ];
        $selectedTheme = $request
            ->input('theme', 'light');
        if (!in_array($selectedTheme, $themes)) {
            $selectedTheme = 'light';
        }
        $request->user()->update([
            'theme' => $selectedTheme
        ]);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('posts.index');
        }
        throw ValidationException::withMessages(['credentials' => 'Invalid Credentials']);
    }
    public function register(Request $request)
    {
        //auto validates confirmation and hashes pass
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create($validated);
        Auth::login($user);
        return redirect()->route('posts.index');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('show.login');
    }
}
