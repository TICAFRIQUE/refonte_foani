{{-- filepath: c:\laragon\www\foani\resources\views\backend\pages\clients\importv1.blade.php --}}
@extends('backend.layouts.master')

@section('title')
    Importer des Clients
@endsection

@section('css')
    <style>
        .import-container {
            max-width: 600px;
            margin: 0 auto;
        }

        .upload-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .upload-header {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 20px;
            border-radius: 15px 15px 0 0;
            text-align: center;
        }

        .upload-zone {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 40px 20px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #f8f9fa;
            position: relative;
        }

        .upload-zone:hover {
            border-color: #28a745;
            background: #f0f8f0;
        }

        .upload-zone.dragover {
            border-color: #28a745;
            background: #e8f5e9;
        }

        .upload-zone.file-selected {
            cursor: default;
            border-color: #28a745;
            background: #f0f8f0;
        }

        .upload-icon {
            font-size: 48px;
            color: #6c757d;
            margin-bottom: 15px;
        }

        .file-input {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
        }

        .selected-file {
            background: #e8f5e9;
            border: 1px solid #28a745;
            border-radius: 8px;
            padding: 15px;
            margin-top: 15px;
            display: none;
        }

        .btn-upload {
            background: #28a745;
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            text-transform: uppercase;
            border-radius: 25px;
            width: 100%;
            margin-top: 20px;
        }

        .btn-upload:hover {
            background: #218838;
        }

        .btn-upload:disabled {
            background: #6c757d;
            cursor: not-allowed;
        }

        .format-help {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            font-size: 14px;
        }

        .example-format {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            font-family: monospace;
            font-size: 13px;
            margin: 10px 0;
            overflow-x: auto;
        }

        .alert-custom {
            border-radius: 8px;
            border: none;
            margin-bottom: 20px;
        }
    </style>
@endsection

@section('content')
    @component('backend.components.breadcrumb')
        @slot('li_1')
            Clients
        @endslot
        @slot('title')
            Importer des Clients
        @endslot
    @endcomponent

    <div class="import-container">
        <div class="card upload-card">
            <div class="upload-header">
                <h4 class="mb-0">
                    <i class="fas fa-upload me-2"></i>
                    Importer des Clients
                </h4>
                <p class="mb-0 mt-2 opacity-75">Téléchargez votre fichier CSV pour importer vos clients</p>
            </div>

            <div class="card-body p-4">
                <!-- Messages d'alerte -->
                @if (session('success'))
                    <div class="alert alert-success alert-custom">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-custom">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-custom">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Erreurs:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Formulaire d'upload -->
                <form action="{{ route('client.importer_store') }}" method="POST" enctype="multipart/form-data"
                    id="uploadForm">
                    @csrf

                    <div class="upload-zone" id="uploadZone">
                        <input type="file" name="csv_file" id="file" class="file-input" accept=".csv,.xlsx,.xls"
                            required style="display: none;">
                        <div id="uploadContent">
                            <i class="fas fa-cloud-upload-alt upload-icon"></i>
                            <h5>Cliquez ici pour sélectionner votre fichier</h5>
                            <p class="text-muted mb-0">ou glissez-déposez votre fichier CSV/Excel</p>
                            <small class="text-muted">Formats: .csv, .xlsx, .xls | Max: 10MB</small>
                        </div>
                    </div>

                    <!-- Fichier sélectionné -->
                    <div class="selected-file" id="selectedFile">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <i class="fas fa-file-csv text-success me-2"></i>
                                <strong id="fileName"></strong>
                                <br>
                                <small class="text-muted" id="fileSize"></small>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-danger" onclick="clearFile()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success btn-upload" id="submitBtn" disabled>
                        <i class="fas fa-upload me-2"></i>
                        Importer les Clients
                    </button>
                </form>

                <!-- Aide sur le format -->
                <div class="format-help">
                    <h6><i class="fas fa-info-circle text-info me-2"></i>Format requis</h6>
                    <p>Votre fichier doit contenir ces colonnes:</p>
                    <div class="example-format">
                        nom,prenom,telephone,email,adresse
                        Kouassi,Jean,0101020304,jean@email.com,"Abidjan, Cocody"
                        Traore,Marie,0505060708,marie@email.com,"Bouaké, Centre"
                    </div>
                    <small class="text-muted">
                        <strong>Important:</strong> Première ligne = en-têtes, séparateur = virgule, encodage = UTF-8
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('file');
            const uploadZone = document.getElementById('uploadZone');
            const selectedFile = document.getElementById('selectedFile');
            const fileName = document.getElementById('fileName');
            const fileSize = document.getElementById('fileSize');
            const submitBtn = document.getElementById('submitBtn');
            const uploadForm = document.getElementById('uploadForm');
            let fileSelected = false;

            // Click sur la zone d'upload
            uploadZone.addEventListener('click', function(e) {
                // Empêcher le re-déclenchement si un fichier est déjà sélectionné
                if (!fileSelected) {
                    fileInput.click();
                }
                e.preventDefault();
                e.stopPropagation();
            });

            // Drag & Drop
            uploadZone.addEventListener('dragover', function(e) {
                e.preventDefault();
                if (!fileSelected) {
                    uploadZone.classList.add('dragover');
                }
            });

            uploadZone.addEventListener('dragleave', function(e) {
                e.preventDefault();
                uploadZone.classList.remove('dragover');
            });

            uploadZone.addEventListener('drop', function(e) {
                e.preventDefault();
                uploadZone.classList.remove('dragover');
                
                if (!fileSelected && e.dataTransfer.files.length > 0) {
                    fileInput.files = e.dataTransfer.files;
                    handleFile();
                }
            });

            // Sélection de fichier
            fileInput.addEventListener('change', function(e) {
                e.stopPropagation();
                handleFile();
            });

            function handleFile() {
                const file = fileInput.files[0];
                if (!file) return;

                // Validation du fichier
                const validTypes = ['text/csv', 'application/vnd.ms-excel',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                ];
                const validExtensions = ['.csv', '.xls', '.xlsx'];

                if (!validTypes.includes(file.type) && !validExtensions.some(ext => file.name.toLowerCase()
                        .endsWith(ext))) {
                    alert('Format de fichier non valide. Utilisez .csv, .xls ou .xlsx');
                    clearFile();
                    return;
                }

                if (file.size > 10 * 1024 * 1024) {
                    alert('Fichier trop volumineux. Maximum: 10MB');
                    clearFile();
                    return;
                }

                // Marquer comme fichier sélectionné
                fileSelected = true;
                
                // Modifier l'apparence de la zone d'upload
                uploadZone.classList.add('file-selected');
                
                // Afficher les infos du fichier
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                selectedFile.style.display = 'block';
                submitBtn.disabled = false;
            }

            function clearFile() {
                fileInput.value = '';
                selectedFile.style.display = 'none';
                submitBtn.disabled = true;
                fileSelected = false;
                uploadZone.classList.remove('file-selected');
            }

            function formatFileSize(bytes) {
                if (bytes === 0) return '0 Bytes';
                const k = 1024;
                const sizes = ['Bytes', 'KB', 'MB', 'GB'];
                const i = Math.floor(Math.log(bytes) / Math.log(k));
                return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
            }

            // Soumission du formulaire
            uploadForm.addEventListener('submit', function(e) {
                if (!fileInput.files[0]) {
                    e.preventDefault();
                    alert('Veuillez sélectionner un fichier.');
                    return;
                }

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Importation...';
            });

            // Fonction globale pour clear
            window.clearFile = clearFile;
        });
    </script>
@endsection