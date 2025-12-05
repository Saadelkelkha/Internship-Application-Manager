<?php

namespace App\Http\Controllers;

use App\Http\Requests\EtudiantRequest;
use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EtudiantController extends Controller
{
    public function create(){
        return view('etudiant.create');
    }

    public function store(EtudiantRequest $request){
        $password = $request->input('password');

        $formFields = $request->validated();

        $formFields['password'] = Hash::make($password);

        Etudiant::create($formFields);
       
        return redirect()->route('login.show')->with('success','Profil créé avec succès');
    }
}
