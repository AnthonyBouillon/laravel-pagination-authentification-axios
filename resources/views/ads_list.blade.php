@extends('layouts.app')

@section('content')
    <main class="container">
        <header>
            <h1 class="text-center">Liste des annonces</h1>
        </header>
        {{-- Même page (action) --}}
        <form method="POST" action="{{ route('list_ads') }}" v-on:submit.prevent="search" id="form-search">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" id="input-search">
            </div>
            <button class="btn btn-primary">Recherche</button>
        </form>
        <hr/>
        {{-- affiche en ajax --}}
        <div id="results_axios">
            @foreach($ads as $ad)
                <article>
                <h2 id="title">{{ $ad->title }}</h2>
                </article>
            @endforeach
        </div>

       {{-- Pagination déclarer dans le controller AdsController de la méthode index() => paginate(5) --}}
        {{ $ads->links() }}
    </main>
@endsection

{{-- Permet d'utiliser le javascript qui est appelé dans le layout (app.blade.php) --}}
@section('extra-js')
    <script>
        // Méthode appelé quand le formulaire est soumis (v-on:submit.prevent=search)
        function search(){
            // Post les données du champ dans le controller search, voir dans routes pour mieux comprendre
            axios.post(`{{ route('list_ads') }}`, {
                // Récupère la valeur du champ
                words: document.querySelector('#input-search').value
                // Si la réponse est positive
            }).then(function (response){
                // Récupère la div où on va afficher les données json
                let results_ajax = document.querySelector('#results_axios');
                // Vide le contenu de la div
                results_ajax.innerHTML = '';
                // Assigne les valeurs récupéré en json dans une constante
                const ads = response.data.ads;
                // On parcours l'objet json
                for(let i = 0; i < ads.length; i++){
                    // et transmet les données dans la div
                    results_ajax.innerHTML = 
                        '<article>'
                        + '<h2 id="title">'
                            + ads[i].title
                        + '</h2>'
                     + '</article>';
                }
            }).catch(function (error){
                alert(error);
            });
        }
    </script>
@endsection