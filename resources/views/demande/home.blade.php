<x-masterpage title="Home">
    <form class="w-100 w-md-50 mx-auto" method="POST" action="{{ route('demande.store') }}" enctype="multipart/form-data">
        @csrf
        <h3 class="text-center">Demande de Stage</h3>
        <div class="mb-3">
            <label for="prenom" class="form-label">Prenom</label>
            <input type="text" id="prenom" name="prenom" class="form-control" value="{{ old('prenom', Auth::guard('etudiants')->user()->prenom) }}" readonly/>

            @error('prenom')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" id="nom" name="nom" class="form-control" value="{{ old('name', Auth::guard('etudiants')->user()->nom) }}" readonly/>
            
            @error('nom')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', Auth::guard('etudiants')->user()->email) }}" readonly/>
            
            @error('email')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="etablissement" class="form-label">Etablissement</label>
            <input type="text" id="etablissement" name="etablissement" class="form-control" value="{{ old('etablissement') }}"/>
            
            @error('etablissement')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="telephone" class="form-label">Telephone</label>
            <input type="tel" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') }}"/>
            
            @error('telephone')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="type_stage" class="form-label">Type de stage</label>
            <select id="type_stage" name="type_stage" class="form-select">
                <option value="STAGE PRÉ-EMBAUCHE" {{ old('type_stage') == 'STAGE PRÉ-EMBAUCHE' ? 'selected' : '' }}>STAGE PRÉ-EMBAUCHE</option>
                <option value="STAGE FONCTIONNEL" {{ old('type_stage') == 'STAGE FONCTIONNEL' ? 'selected' : '' }}>STAGE FONCTIONNEL</option>
                <option value="STAGE PFE" {{ old('type_stage') == 'STAGE PFE' ? 'selected' : '' }}>STAGE PFE</option>
                <option value="STAGE D'OBSERVATION" {{ old('type_stage') == "STAGE D'OBSERVATION" ? 'selected' : '' }}>STAGE D'OBSERVATION</option>
                <option value="STAGE EN ALTERNANCE" {{ old('type_stage') == "STAGE EN ALTERNANCE" ? 'selected' : '' }}>STAGE EN ALTERNANCE</option>
            </select>
            
            @error('type_stage')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de debut</label>
            <input type="date" id="date_debut" name="date_debut" class="form-control" value="{{ old('date_debut') }}"/>
            
            @error('date_debut')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de fin</label>
            <input type="date" id="date_fin" name="date_fin" class="form-control" value="{{ old('date_fin') }}"/>
            
            @error('date_fin')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <div class="row align-items-center">
                <div class="col-12 col-md-7">
                    <label for="competence" class="form-label">Competences</label>
                </div>
                <div class="col-6 col-md-3">
                    <label for="range" class="form-label">Niveaux</label>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-12 col-md-7">
                    <input type="text" id="competence" name="competence" class="form-control" value="{{ old('competence') }}"/>
                </div>
                <div class="col-6 col-md-3">
                    <div class="stars">
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        <div class="star"></div>
                        
                        <input class="cover" name="range" id="range1" type="range"/>
                    </div>
                </div>
                <div class="col-6 col-md-2">
                    <button type="button" class="btn btn-primary rounded w-100" onclick="ajouter_competence(event)"><i class="bi bi-plus-circle"></i></button>
                </div>
            </div>
            <div id="competences_range" class="row pt-1 ps-1 pe-1 align-items-center">

            </div>
            @error('competences')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="service" class="form-label">Service</label>
            <select id="service" name="service" class="form-select">
                <option value="IT" {{ old('service') == 'IT' ? 'selected' : '' }}>IT</option>
                <option value="HR" {{ old('service') == 'HR' ? 'selected' : '' }}>HR</option>
                <option value="Finance" {{ old('service') == 'Finance' ? 'selected' : '' }}>Finance</option>
                <option value="Marketing" {{ old('service') == 'Marketing' ? 'selected' : '' }}>Marketing</option>
            </select>
            
            @error('service')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lettre_motivation" class="form-label">Lettre de motivation</label>
            <textarea id="lettre_motivation" name="lettre_motivation" class="form-control" placeholder="Parcours, compétences, motivation" style="height: 200px">{{ old('lettre_motivation') }}</textarea>
            
            @error('lettre_motivation')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="cv" class="form-label">CV</label>
            <input type="file" id="cv" accept="application/pdf" name="cv" class="form-control"/>
            
            @error('cv')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="mb-3">
            <label for="lettre_de_recommandation" class="form-label">Lettre de recommandation</label>
            <input type="file" id="lettre_de_recommandation" accept=".pdf,application/pdf" name="lettre_de_recommandation" class="form-control"/>
            
            @error('lettre_de_recommandation')
                <x-alert type="danger">
                    {{$message}}
                </x-alert>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
        <input type="hidden" name="competences" id="competences" value="{{old('competences')}}"/>
    </form>
    <script>
        let competences = [];
        if({{ old('competences') ? 'true' : 'false' }}){
            competences = JSON.parse(@json(old('competences')));
            const competenceList = document.getElementById('competences_range');
            competences.forEach(item => {
                competenceList.innerHTML += `
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 pt-1 pb-1 border text-center p-1 bg-dark text-light mb-2" style="border-radius:50px; position: relative;">
                        <span>${item.competence}</span>
                        <span class="fw-bold ms-1">${item.range}</span>
                        <i class="bi bi-star-fill text-warning"></i>
                        <button type="button" class="btn text-danger rounded-circle" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);" onclick="remove_competence(event)"><i class="bi bi-x-circle"></i></button>
                    </div>
                `;
            });
        }

        function ajouter_competence(e){
            e.preventDefault();
            const competence = document.getElementById('competence').value;
            let range = 100 - document.getElementById('range1').value;
            const competenceList = document.getElementById('competences_range');

            if(competence && range){
                range = (parseInt(range) / 20).toFixed(1);
                
                const exists = competences.some(item => item.competence.toLowerCase() === competence.toLowerCase());
                if (!exists) {
                    competences.push({competence, range});
                    document.getElementById('competences').value = JSON.stringify(competences);

                    competenceList.innerHTML += `
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 pt-1 pb-1 border text-center p-1 bg-dark text-light mb-2" style="border-radius:50px; position: relative;">
                            <span>${competence}</span>
                            <span class="fw-bold ms-1">${range}</span>
                            <i class="bi bi-star-fill text-warning"></i>
                            <button type="button" class="btn text-danger rounded-circle" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%);" onclick="remove_competence(event)"><i class="bi bi-x-circle"></i></button>
                        </div>
                    `;
                    document.getElementById('competence').value = '';
                    document.getElementById('range1').value = 0;
                } else {
                    showPopupMessage('Cette compétence existe déjà.', 'red');
                }
            } else {
                showPopupMessage('Veuillez remplir le champ compétence et sélectionner un niveau.', 'yellow');
            }
        }

        function remove_competence(e){
            e.preventDefault();
            const parentElement = e.target.closest('.col-12');
            if (parentElement) {
                const competence = parentElement.querySelector('span:first-child')?.innerText || '';
                const range = parentElement.querySelector('span.fw-bold')?.innerText || '';
                competences = competences.filter(item => item.competence !== competence && item.range !== range);
                document.getElementById('competences').value = JSON.stringify(competences);
                parentElement.remove();
            }
        }

        function showPopupMessage(message, color) {
            const popupMessage = document.createElement('div');
            popupMessage.innerHTML = `<i class="fas fa-exclamation-circle h-100" style="color: white; background-color: ${color}; border-radius: 50%; padding: 5px;"></i> ${message}`;
            popupMessage.style.position = 'fixed';
            popupMessage.style.bottom = '20px';
            popupMessage.style.left = '50%';
            popupMessage.style.transform = 'translateX(-50%)';
            popupMessage.style.backgroundColor = '#333';
            popupMessage.style.color = '#fff';
            popupMessage.style.padding = '10px 20px';
            popupMessage.style.borderRadius = '5px';
            popupMessage.style.zIndex = '1000';
            document.body.appendChild(popupMessage);

            popupMessage.style.transition = 'opacity 0.5s ease';
            popupMessage.style.opacity = '1';
            setTimeout(() => {
                popupMessage.style.opacity = '0';
                setTimeout(() => {
                    popupMessage.remove();
                }, 500);
            }, 2000);
        }
    </script>
</x-masterpage>
