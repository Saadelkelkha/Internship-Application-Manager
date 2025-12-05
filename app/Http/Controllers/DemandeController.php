<?php

namespace App\Http\Controllers;

use App\Http\Requests\DemandeRequest;
use App\Mail\AcceptMail;
use App\Mail\RejectMail;
use App\Models\Demande;
use App\Models\Etudiant;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class DemandeController extends Controller
{
    public function create(){
        if(Auth::guard('etudiants')->user()){
            return view('demande.home');
        }else{
            return redirect()->route('login.show');
        }
        
    }

    public function store(DemandeRequest $request){
        $formFields = $request->validated();
        $formFields['id_user'] = Auth::guard('etudiants')->user()->id;

        if($request->hasFile('cv')){
            $formFields['cv'] = $request->file('cv')->store('cv', 'public');
        }

        if($request->hasFile('lettre_de_recommandation')){
            $formFields['lettre_de_recommandation'] = $request->file('lettre_de_recommandation')->store('lettre_de_recommandation', 'public');
        }

        Demande::create($formFields);
       
        return redirect()->route('home')->with('success', 'Demande envoyée avec succès.');
    }

    public function update(Request $req){
        $demande = Demande::find($req->id);
        if($req->service){
            $demande->service = $req->service;
            $demande->status = "En attente de la réponse du service";
        }else{
            $user = Etudiant::where('id', $demande->id_user)->first();

            $demande->date_debut = $req->date_debut;
            $demande->status = "Acceptée";
            Mail::to($user->email)->send(new AcceptMail($user->nom, $user->prenom, $demande->service, $demande->date_debut, $demande->date_fin));
        }
        
        $demande->save();

        $admin = Auth::guard('admin')->user();

        if ($admin->role == 'RH') {
            return to_route('admin.show')->with('success', 'Demande mise à jour avec succès.');
        } else{
            return to_route('admin.service_show')->with('success', 'Demande acceptée avec succès.');
        }
    }

    public function destroy(Request $req){
        $demande = Demande::find($req->id);
        $demande->status = "Rejetée";
        $demande->save();

        $formFields = [
            'motif' => $req->motif,
            'id_demande' => $req->id,
        ];
        
        $demande = Demande::where('id', $req->id)->first();
        $user = Etudiant::where('id', $demande->id_user)->first();
        
        Mail::to($user->email)->send(new RejectMail($formFields['motif']));

        Reponse::create($formFields);

        $admin = Auth::guard('admin')->user();

        if ($admin->role == 'RH') {
            return to_route('admin.show')->with('success', 'Demande rejetée avec succès.');
        } else{
            return to_route('admin.service_show')->with('Demande rejetée avec succès.');
        }
    }
}
