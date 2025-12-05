<x-masterpage title="Inscription">
    <img class="img-fluid" src="{{ asset('storage/logo2.png') }}" alt="Logo" style="max-height: 200px;max-width: 100%;">
    <p class="ps-5 pe-5" style="font-size: 0.8em;font-family: 'Comic Sans MS', cursive, sans-serif;">🎓 <b>Bienvenue sur la plateforme officielle de demandes de stage</b><br>
        Gérée par <b>la Présidence de l’Université Cadi Ayyad</b>, cette plateforme vous permet de déposer vos demandes, suivre leur statut et recevoir des notifications en temps réel.</p>
    <form class="w-50" method="POST" action="{{ route('etudiant.store') }}">
        @csrf
        <h3>Créer un compte</h3>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" name="prenom" class="form-control" value="{{old('prenom')}}"/>

            @error('prenom')
                <x-alert type="danger" >
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="nom" class="form-control" value="{{old('name')}}"/>
            
            @error('nom')
                <x-alert type="danger" >
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" name="email" class="form-control" value="{{old('email')}}"/>
            
            @error('email')
                <x-alert type="danger" >
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" class="form-control"/>
            @error('password')
                <x-alert type="danger" >
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control"/>
            @error('password_confirmation')
                <x-alert type="danger" >
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Créer un compte</button>
        </div>
    </form>
    <div class="mt-3">
        <a href="{{ route('login.show') }}">Se connecter</a>
        <span class="mx-2">|</span>
        <a href="{{ route('login.edit') }}">Mot de passe oublié ?</a>
    </div>
</x-masterpage>