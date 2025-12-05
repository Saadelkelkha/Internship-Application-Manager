<x-masterpageAdmin title="Dashboard">
    <h1 class="text-2xl font-semibold text-gray-900 mb-4">Liste des demandes</h1>

    <div class="w-100" style="max-width: 100%; overflow-x: auto;">
        <div class="mb-4 d-flex justify-content-between">
            <input type="text" id="searchBar" class="form-control w-50" placeholder="Rechercher..." onkeyup="filterTable()">
            <button type="button" name="submit_all" class="btn btn-primary w-30" onclick="toutes()">Toutes les demandes</button>
        </div>
        <table class="table table-hover table-dark w-100">
            <thead>
                <tr class="align-middle">
                    <th>Nom et Prenom</th>
                    <th>Etablissement</th>
                    <th>Competences</th>
                    <th>Service</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="table-light">
                @foreach ($demandes as $demande)
                    @if ($demande->status == 'En attente de la réponse du service' && $demande->service == Auth::guard('admin')->user()->role)
                        <tr class="align-middle">
                            @foreach ($users as $userr)
                                @if ($userr->id == $demande->id_user)
                                    @php $user = $userr; @endphp
                                @endif
                            @endforeach
                            <td>{{ $user->prenom }} {{ $user->nom }}</td>
                            <td>{{ $demande->etablissement }}</td>
                            <td>
                                <div class="d-grid gap-2" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
                                    @foreach (json_decode($demande->competences) as $competence)
                                        <div class="border text-center p-1 bg-dark text-light" style="border-radius:50px; white-space: nowrap;">
                                            <span>{{$competence->competence}}</span> <span class="fw-bold ms-1">{{$competence->range}}</span>
                                            <i class="bi bi-star-fill text-warning"></i>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>{{ $demande->service }}</td>
                            <td><div style="display: flex; flex-wrap: wrap;gap:5px">{{ $demande->date_debut }}</div></td>
                            <td><div style="display: flex; flex-wrap: wrap;gap:5px">{{ $demande->date_fin }}</div></td>
                            <td><button class="btn btn-primary" onclick="Voir({{$user->id}},{{$demande->id}})">Voir</button></td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="details card shadow p-4 mb-4 bg-dark text-white rounded w-100" style="display: none;">
        
    </div>
    <div id="popup" style="display: none;"></div>
    <div class="overlay" id="overlay" style="display: none;"></div>
    <!-- PDF.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

    <script>
        function Voir(id, demandeId) {
            const details = document.querySelector('.details');
            const users = @json($users);
            const user = users.find(user => user.id === id);

            @foreach ($demandes as $demande)
                    if ({{$demande->id}} == demandeId) {
                        const cvUrl = `{{ asset('storage/' . $demande->cv) }}`;
                        const lettreUrl = `{{ asset('storage/' . $demande->lettre_de_recommandation) }}`;

                        let cvWidth, cvHeight, lettreWidth, lettreHeight;

                        Promise.all([
                            pdfjsLib.getDocument(cvUrl).promise.then(pdf => pdf.getPage(1).then(page => page.getViewport({ scale: 1 }))),
                            pdfjsLib.getDocument(lettreUrl).promise.then(pdf => pdf.getPage(1).then(page => page.getViewport({ scale: 1 })))
                        ]).then(([cvViewport, lettreViewport]) => {
                            cvWidth = cvViewport.width + 'px';
                            cvHeight = cvViewport.height + 'px';
                            lettreWidth = lettreViewport.width + 'px';
                            lettreHeight = lettreViewport.height + 'px';
                            details.innerHTML = `
                                <h1>Détails de la demande</h1>
                                <strong style="position: absolute; top: 0px; right: 5px; cursor: pointer;" onclick="closeVoir()">X</strong>
                                <div class="d-flex flex-column align-items-start">
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Nom et Prénom :</strong></div>
                                        <div style="font-size: 1rem;">${user.prenom} ${user.nom}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Email :</strong></div>
                                        <div style="font-size: 1rem;">${user.email}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Téléphone :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->telephone }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Etablissement :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->etablissement }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Type de Stage :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->type_stage }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Date de Début :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->date_debut }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Date de Fin :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->date_fin }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-start w-100 gap-3 justify-content-start">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Compétences :</strong></div>
                                        <div class="d-grid gap-2" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));">
                                            @foreach (json_decode($demande->competences) as $competence)
                                                <div class="border text-center p-1 bg-dark text-light" style="border-radius:50px; white-space: nowrap;">
                                                    <span>{{$competence->competence}}</span>
                                                    <span class="fw-bold ms-1">{{$competence->range}}</span>
                                                    <i class="bi bi-star-fill text-warning"></i>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Service :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->service }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Lettre de Motivation :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->lettre_motivation }}</div>
                                    </div>
                                    <div class="d-flex flex-row align-items-center w-100 gap-3 justify-content-start" style="height: 50px;">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Status :</strong></div>
                                        <div style="font-size: 1rem;">{{ $demande->status }}</div>
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>CV :</strong></div>
                                        <div style="text-align: right;">
                                            <embed src="${cvUrl}" type="application/pdf" style="width:${cvWidth}; height:${cvHeight}; border:none; max-width: 100%;" />
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column w-100">
                                        <div style="width: 50%; font-size: 1.25rem;" align="left"><strong>Lettre de recommandation :</strong></div>
                                        <div style="text-align: right;">
                                            <embed src="${lettreUrl}" type="application/pdf" style="width:${lettreWidth}; height:${lettreHeight}; border:none; max-width: 100%;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center align-items-center gap-3 mt-4">
                                    <button class="btn btn-success" onclick="afficherPopup(${demandeId},'{{ $demande->date_debut }}')">Valider</button>
                                    <button class="btn btn-danger" onclick="afficherPopupReject(${demandeId})">Rejeter</button>
                                </div>
                            `;
                        })
                    };
                @endforeach

                    details.style.display = 'block';
        }

        function afficherPopup(demandeId,dated) {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('overlay');

            popup.innerHTML = `
                <h2>Valider la demande</h2>
                <form method="POST" action="{{ route('demande.update') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="${demandeId}">
                    <input type="date" id="date_debut" name="date_debut" class="form-control" value="${dated}"/>
                    <div class="d-flex w-100 justify-content-center align-items-center gap-3 mt-2">
                        <button type="submit" class="btn btn-success mt-2">Valider</button>
                        <button type="button" class="btn btn-secondary mt-2" onclick="fermerPopup()">Annuler</button>
                    </div>
                </form>
            `;

            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            overlay.style.zIndex = '1001';
            overlay.onclick = fermerPopup;
            overlay.style.display = 'block';
            
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.backgroundColor = 'white';
            popup.style.padding = '20px';
            popup.style.borderRadius = '10px';
            popup.style.zIndex = '1002';
            popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            popup.style.maxWidth = '90vw';
            popup.style.display = 'block';
        }

        function fermerPopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        function afficherPopupReject(demandeId) {
            const popup = document.getElementById('popup');
            const overlay = document.getElementById('overlay');

            popup.innerHTML = `
                <h2>Rejeter la demande</h2>
                <form method="POST" action="{{ route('demande.destroy') }}">
                    @csrf
                    <input type="hidden" name="id" value="${demandeId}">
                    <label for="motif" class="form-label">Motif de rejet</label>
                    <textarea id="motif" name="motif" class="form-control" rows="4" required></textarea>
                    <div class="d-flex w-100 justify-content-center align-items-center gap-3 mt-2">
                        <button type="submit" class="btn btn-success mt-2">Valider</button>
                        <button type="button" class="btn btn-secondary mt-2" onclick="fermerPopup()">Annuler</button>
                    </div>
                </form>
            `;

            overlay.style.position = 'fixed';
            overlay.style.top = '0';
            overlay.style.left = '0';
            overlay.style.width = '100%';
            overlay.style.height = '100%';
            overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
            overlay.style.zIndex = '1001';
            overlay.onclick = fermerPopup;
            overlay.style.display = 'block';
            
            popup.style.position = 'fixed';
            popup.style.top = '50%';
            popup.style.left = '50%';
            popup.style.transform = 'translate(-50%, -50%)';
            popup.style.backgroundColor = 'white';
            popup.style.padding = '20px';
            popup.style.borderRadius = '10px';
            popup.style.zIndex = '1002';
            popup.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
            popup.style.maxWidth = '90vw';
            popup.style.display = 'block';
        }

        function filterTable() {
            const input = document.getElementById('searchBar');
            const filter = input.value.toLowerCase();
            const table = document.querySelector('table tbody');
            const rows = table.getElementsByTagName('tr');

            for (let i = 0; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let match = false;

                for (let j = 0; j < cells.length; j++) {
                    
                    if (cells[j].textContent.toLowerCase().includes(filter)) {
                        match = true;
                        break;
                    }
                }

                rows[i].style.display = match ? '' : 'none';
            }
        }

        function toutes(){
            const input = document.getElementById('searchBar');
            input.value = "";

            filterTable();
        }

        function closeVoir(){
            const details = document.querySelector('.details');
            details.innerHTML = "";
            details.style.display = "none";
        }
    </script>

</x-masterpageAdmin>

