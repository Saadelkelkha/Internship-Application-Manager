<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show()
    {
        if(Auth::guard('admin')->user()){
            $demandes = Demande::all();
            $users = Etudiant::all();
            return view('admin.show',compact('demandes','users'));
        }else{
            return redirect()->route('login.show');
        }
    }

    public function service_show()
    {
        if(Auth::guard('admin')->user()){
            $demandes = Demande::all();
            $users = Etudiant::all();
            return view('admin.service_show',compact('demandes','users'));
        }else{
            return redirect()->route('login.show');
        }
    }
}
