<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;
use App\Models\Etudiant;

class LoginController extends Controller
{
    public function show()
    {
        if(Auth::guard('etudiants')->user()){
            return redirect()->route('home');
        }elseif(Auth::guard('admin')->user()){
            $admin = Auth::guard('admin')->user();

            if ($admin->role == 'RH') {
                return to_route('admin.show')->with('success', 'Connecté avec succès');
            } else{
                return to_route('admin.service_show')->with('success', 'Connecté avec succès');
            }
        }else{
            return view('login.show');
        }
    }

    public function login(Request $request)
    {
        $formFields = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:20',
        ]);

        if(Auth::guard('etudiants')->attempt($formFields)){
            $request->session()->regenerate();

            return to_route('home')->with('success', 'Connecté avec succès');
        }elseif (Auth::guard('admin')->attempt($formFields)) {
            $request->session()->regenerate();
            $admin = Auth::guard('admin')->user();

            if ($admin->role == 'RH') {
                return to_route('admin.show')->with('success', 'Connecté avec succès');
            } else{
                return to_route('admin.service_show')->with('success', 'Connecté avec succès');
            }
        }
        else{
            return back()->withErrors([
                'email' => 'Email ou mot de passe incorrect.'
            ])->onlyInput('email');
        }
    }

    public function logout()
    {
        session()->flush();

        Auth::logout();
        return to_route('login')->with('success', 'Déconnecté avec succès');
    }

    public function edit(Request $request)
    {
        return view('login.edit');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $token = Str::random(64);
        $email = $request->email;

        // Remove any existing token
        DB::table('password_reset_tokens')->where('email', $email)->delete();

        // Save the token (you can hash it for more security)
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        // Send the email
        Mail::to($email)->send(new ResetPasswordMail($token));

        return back()->with('success', 'Lien de réinitialisation envoyé à votre adresse e-mail.');
    }

    public function showResetForm($token)
    {
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$record) {
            return response()->json(['message' => 'Lien invalide ou expiré'], 404);
        }
    
        return view('login.reset', [
            'token' => $token,
            'email' => $record->email,
        ]);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:20|confirmed',
            'token' => 'required',
        ]);

        $error = null;

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            $error = 'Lien de réinitialisation invalide ou expiré.';
        } else {
            $expiresAt = Carbon::parse($record->created_at)->addMinutes(60);
            if (Carbon::now()->greaterThan($expiresAt)) {
                $error = 'Ce lien a expiré. Veuillez refaire une demande.';
            }
        }

        if ($error) {
            return back()->withErrors(['email' => $error]);
        }
        
        $user = Etudiant::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Utilisateur introuvable.']);
        }
    
        $user->password = Hash::make($request->password);
        $user->save();
    
        
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();
    
        return redirect()->route('login')->with('success', 'Mot de passe réinitialisé avec succès.');
    }
}
