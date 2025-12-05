<x-masterpage title="réinitialiser-mot-de-passe">
    <img class="img-fluid" src="{{ asset('storage/logo2.png') }}" alt="Logo" style="max-height: 200px;max-width: 100%;">
    <p class="ps-5 pe-5" style="font-size: 0.8em;font-family: 'Comic Sans MS', cursive, sans-serif;">🎓 <b>Bienvenue sur la plateforme officielle de demandes de stage</b><br>
        Gérée par <b>la Présidence de l’Université Cadi Ayyad</b>, cette plateforme vous permet de déposer vos demandes, suivre leur statut et recevoir des notifications en temps réel.</p>
    <form class="w-50" method="POST" action="{{ route('login.sendResetLink') }}">
        @csrf
        <h3>Réinitialiser le mot de passe</h3>
        <div class="mb-3">
            <label for="email" class="form-label">Adresse e-mail</label>
            <input type="text" name="email" class="form-control" value="{{old('email')}}"/>
            
            @error('email')
                <x-alert type="danger" >
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Envoyer le lien de réinitialisation</button>
        </div>
    </form>
    <div class="mt-3">
        <a href="{{ route('login.show') }}">Se connecter</a>
        <span class="mx-2">|</span>
        <a href="{{ route('user.create') }}">Créer un compte</a>
    </div>
</x-masterpage>