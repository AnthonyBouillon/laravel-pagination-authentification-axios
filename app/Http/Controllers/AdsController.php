<?php

namespace App\Http\Controllers;

use App\Ads;
use Session;
use pagination;
use Illuminate\Http\Request;
use App\Http\Requests\AdStore;
use Illuminate\Support\Facades\Auth;


class AdsController extends Controller
{

    /**
     * Méthode correspondant à la liste des annonces
     */
    public function index()
    {
        // Récupère toutes les données de la table ads et créer une pagination => view: {{ $ads->links() }}
        $ads = Ads::orderBy('created_at', 'DESC')->paginate(5);
        // Retourne la vue ads_list.blade.php et transmet l'objet ads qui est réutilisable dans la vue => foreach()
        return view('ads_list', compact('ads'));
    }

    /** 
     * Méthode qui récupère les données du formulaire dans la liste des annonces (méthode index())
     * et retourne le résultat au format json pour l'ajax
     */
    public function search()
    {
        // Récupère la valeur du searchbar
        $words = request('words');
        // Requête SQL, récupère le résultat
        $ads = Ads::where('title', 'LIKE', "%$words%")->orderBy('created_at', 'DESC')->get();
        // Si success, retourne la réponse au format json, et lui transmet l'objet $ads
        return response()->json(['success' => true, 'ads' => $ads]);
    }

    // Retourne la vue avec le formulaire d'ajout
    public function create()
    {
        return view('create_ads');
        // Sinon, redirection vers la page d'accueil

    }

    // Les données du formulaire d'ajout sont envoyé ici
    public function store(AdStore $request)
    {
        // var_dump
        //dd(request());
        // Appelle la vérification des champs défini dans la classe AdStore 
        $data_insert = $request->validated();
        // On créer une nouvelle annonce
        $ads = new Ads();
        // On ajoute les valeurs des champs
        $ads->title = $data_insert['title'];
        $ads->description = $data_insert['description'];
        $ads->localisation = $data_insert['localisation'];
        $ads->price = $data_insert['price'];
        // foreign key
        $ads->user_id = Auth::id();

        // Insert dans la table announce les données
        if ($ads->save()) {
            Session::flash('success', 'Votre annonce a été validée');
        } else {
            Session::flash('error', 'Votre annonce n\'a pas pu être ajouté');
        }
        // Redirige sur la même page
        return back();
    }
}
