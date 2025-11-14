<script>
    // Ajoute ce script dans la section @section('script') de ton fichier show.blade.php


    // Fonction d'impression de la facture
    function imprimerFacture() {
        // Contenu de la facture
        const factureContent = `
        <html>
        <head>
            <title>Facture - ${document.title}</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #2a6b2a; padding-bottom: 20px; }
                .logo { font-size: 24px; font-weight: bold; color: #2a6b2a; }
                .info-section { display: flex; justify-content: space-between; margin-bottom: 30px; }
                .info-block { width: 45%; }
                .info-block h4 { color: #2a6b2a; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
                table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
                th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
                th { background-color: #f8f9fa; font-weight: bold; }
                .total-section { text-align: right; margin-top: 20px; }
                .total-line { margin: 5px 0; }
                .total-final { font-size: 18px; font-weight: bold; color: #2a6b2a; }
                .footer { margin-top: 40px; text-align: center; font-size: 12px; color: #666; }
                @media print {
                    body { margin: 0; }
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <div class="header">
                <div class="logo">
                      <img src="{{ $data_parametre ? URL::asset($data_parametre->getFirstMediaUrl('logo_header')) : URL::asset('images/camera-icon.png') }}"
                        alt="Foani" class="logo-image" style="height:50px; vertical-align: middle;">
                    </div>
              
                <p>Email: info@foani.ci | Tél: (+225) 05 05 96 96 25</p>
            </div>

            <div class="info-section">
                <div class="info-block">
                    <h4>Informations Client</h4>
                    <p><strong>Client:</strong> {{ $commande->user->username ?? 'Inconnu' }}</p>
                    <p><strong>Téléphone:</strong> {{ $commande->telephone ?? '—' }}</p>
                    <p><strong>Adresse:</strong>{{ $commande->commune ?? '—' }} <i>{{ $commande->adresse ?? '—' }}</i></p>
                </div>
                <div class="info-block">
                    <h4>Informations Commande</h4>
                    <p><strong>N° Commande:</strong> {{ $commande->code }}</p>
                    <p><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Statut:</strong> {{ ucfirst(str_replace('_', ' ', $commande->statut)) }}</p>
                    @if ($commande->date_livraison)
                    <p><strong>Livraison prévue:</strong> {{ $commande->date_livraison->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix unitaire</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commande->produits as $index => $produit)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $produit->libelle }}</td>
                        <td>{{ $produit->pivot->quantite }}</td>
                        <td>{{ number_format($produit->pivot->prix_unitaire, 0, ',', ' ') }} FCFA</td>
                        <td>{{ number_format($produit->pivot->total, 0, ',', ' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="total-section">
                <div class="total-line">
                    <strong>Sous-total: {{ number_format($commande->sous_total, 0, ',', ' ') }} FCFA</strong>
                </div>
                <div class="total-line">
                    <strong>Frais de livraison: {{ number_format($commande->frais_livraison, 0, ',', ' ') }} FCFA</strong>
                </div>
                <hr>
                <div class="total-final">
                    <strong>TOTAL: {{ number_format($commande->total, 0, ',', ' ') }} FCFA</strong>
                </div>
            </div>

            <div class="footer">
                <p>Merci pour votre confiance !</p>
                <p>Cette facture a été générée automatiquement le {{ now()->format('d/m/Y à H:i') }}</p>
            </div>
        </body>
        </html>
    `;

        // Créer une nouvelle fenêtre pour l'impression
        const printWindow = window.open('', '_blank', 'width=800,height=600');
        printWindow.document.open();
        printWindow.document.write(factureContent);
        printWindow.document.close();

        // Attendre que le contenu soit chargé puis imprimer
        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
            // Fermer la fenêtre après impression (optionnel)
            printWindow.onafterprint = function() {
                printWindow.close();
            };
        };
    }

    // Attacher l'événement au bouton d'impression
    $(document).ready(function() {
        $('.btn-primary:contains("Imprimer")').on('click', function(e) {
            e.preventDefault();
            imprimerFacture();
        });

        // Raccourci clavier Ctrl+P pour imprimer
        $(document).keydown(function(e) {
            if (e.ctrlKey && e.keyCode === 80) { // Ctrl+P
                e.preventDefault();
                imprimerFacture();
            }
        });
    });
</script>
