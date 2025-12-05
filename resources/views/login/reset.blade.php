<x-masterpage title="Réinitialiser le mot de passe">
    <img class="img-fluid" src="{{ asset('storage/logo2.png') }}" alt="Logo" style="max-height: 200px;max-width: 100%;">
    <p class="ps-5 pe-5" style="font-size: 0.8em;font-family: 'Comic Sans MS', cursive, sans-serif;">🎓 <b>Bienvenue sur la plateforme officielle de demandes de stage</b><br>
        Gérée par <b>la Présidence de l’Université Cadi Ayyad</b>, cette plateforme vous permet de déposer vos demandes, suivre leur statut et recevoir des notifications en temps réel.</p>
    <form class="w-50" method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <h3>Réinitialiser le mot de passe</h3>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $email) }}" readonly />

            @error('email')
                <x-alert type="danger">
                    {{ $message }}
                </x-alert>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" class="form-control" required />
            @error('password')
                <x-alert type="danger">
                    {{ $message }}
                </x-alert>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" class="form-control" required />
            @error('password_confirmation')
                <x-alert type="danger">
                    {{ $message }}
                </x-alert>
            @enderror
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Réinitialiser le mot de passe</button>
        </div>
    </form>
</x-masterpage>
