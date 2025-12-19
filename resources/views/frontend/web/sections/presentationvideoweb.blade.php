{{-- filepath: c:\laragon\www\foani\resources\views\frontend\web\sections\presentationvideoweb.blade.php --}}
@push('styles')
    <style>
        /* SECTION VIDÉO PRÉSENTATION */
        .video-presentation-section {
            padding: 100px 0;
            background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 50%, #f0f2ff 100%);
            position: relative;
            overflow: hidden;
        }

        .video-presentation-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -10%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(40, 64, 147, 0.03) 0%, transparent 70%);
            border-radius: 50%;
        }

        .video-presentation-section::after {
            content: '';
            position: absolute;
            bottom: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(108, 122, 224, 0.03) 0%, transparent 70%);
            border-radius: 50%;
        }

        .video-container-wrapper {
            position: relative;
            z-index: 1;
        }

        .video-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .video-label {
            display: inline-block;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 20px;
            box-shadow: 0 4px 15px rgba(40, 64, 147, 0.3);
        }

        .video-header h2 {
            color: var(--color-primary);
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 15px;
            line-height: 1.2;
        }

        .video-header p {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        /* Container vidéo principal */
        .video-main-container {
            background: white;
            border-radius: 30px;
            padding: 40px;
            box-shadow: 0 20px 60px rgba(40, 64, 147, 0.1);
            border: 1px solid rgba(40, 64, 147, 0.05);
            position: relative;
        }

        .video-main-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            border-radius: 30px 30px 0 0;
        }

        /* Wrapper vidéo avec ratio 16:9 */
        .video-wrapper {
            position: relative;
            width: 100%;
            padding-bottom: 56.25%;
            /* Ratio 16:9 */
            border-radius: 20px;
            overflow: hidden;
            background: #000;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.2);
        }

        .video-player {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Overlay controls */
        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg,
                    rgba(0, 0, 0, 0.3) 0%,
                    transparent 30%,
                    transparent 70%,
                    rgba(0, 0, 0, 0.5) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .video-wrapper:hover .video-overlay {
            opacity: 1;
        }

        /* Bouton play/pause central */
        .video-play-button {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            pointer-events: all;
        }

        .video-play-button:hover {
            transform: scale(1.1);
            background: white;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }

        .video-play-button i {
            font-size: 2rem;
            color: var(--color-primary);
            margin-left: 3px;
        }

        .video-play-button.paused i::before {
            content: "\f144";
            /* bi-play-fill */
        }

        .video-play-button.playing i::before {
            content: "\f147";
            /* bi-pause-fill */
            margin-left: 0;
        }

        /* Controls bar en bas */
        .video-controls {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(180deg, transparent, rgba(0, 0, 0, 0.8));
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
        }

        .video-wrapper:hover .video-controls {
            opacity: 1;
            pointer-events: all;
        }

        .control-btn {
            background: transparent;
            border: none;
            color: white;
            font-size: 1.3rem;
            cursor: pointer;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 8px;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1);
        }

        /* Barre de progression */
        .progress-container {
            flex: 1;
            height: 6px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
            cursor: pointer;
            position: relative;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(90deg, var(--color-primary), var(--color-secondary));
            border-radius: 3px;
            width: 0%;
            transition: width 0.1s linear;
            position: relative;
        }

        .progress-bar::after {
            content: '';
            position: absolute;
            right: -6px;
            top: 50%;
            transform: translateY(-50%);
            width: 12px;
            height: 12px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        }

        /* Timer */
        .video-time {
            color: white;
            font-size: 0.9rem;
            font-weight: 600;
            min-width: 100px;
            text-align: right;
        }

        /* Volume control */
        .volume-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .volume-slider {
            width: 80px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 2px;
            cursor: pointer;
            position: relative;
        }

        .volume-bar {
            height: 100%;
            background: white;
            border-radius: 2px;
            width: 100%;
            transition: width 0.1s linear;
        }

        /* Fullscreen button */
        .fullscreen-btn {
            margin-left: 5px;
        }

        /* Informations sous la vidéo */
        .video-info {
            margin-top: 30px;
            text-align: center;
        }

        .video-info h3 {
            color: var(--color-primary);
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 15px;
        }

        .video-info p {
            color: #555;
            font-size: 1.05rem;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .video-stats {
            display: flex;
            justify-content: center;
            gap: 40px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            box-shadow: 0 8px 25px rgba(40, 64, 147, 0.2);
        }

        .stat-icon i {
            color: white;
            font-size: 1.5rem;
        }

        .stat-item strong {
            display: block;
            color: var(--color-primary);
            font-size: 1.5rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .stat-item span {
            color: #666;
            font-size: 0.95rem;
        }

        /* Badge autoplay */
        .autoplay-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-primary);
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
            animation: pulse 2s infinite;
        }

        .autoplay-badge i {
            color: #e74c3c;
            animation: blink 1.5s infinite;
        }

        @keyframes blink {

            0%,
            50%,
            100% {
                opacity: 1;
            }

            25%,
            75% {
                opacity: 0.3;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .video-presentation-section {
                padding: 40px 0;
            }

            .video-container-wrapper {
                padding: 0 10px;
            }

            .video-main-container {
                padding: 15px;
            }

            .video-header {
                margin-bottom: 30px;
            }

            .video-header h2 {
                font-size: 2rem;
            }

            .video-header p {
                font-size: 1rem;
            }

            /* Augmenter la taille de la vidéo sur mobile */
            .video-wrapper {
                padding-bottom: 65%;
                /* Ratio plus grand pour mobile */
            }

            .video-play-button {
                width: 60px;
                height: 60px;
            }

            .video-play-button i {
                font-size: 1.5rem;
            }

            .video-controls {
                padding: 15px 10px;
                gap: 10px;
            }

            .control-btn {
                font-size: 1.1rem;
                padding: 5px;
            }

            .video-time {
                font-size: 0.8rem;
                min-width: 80px;
            }

            .volume-slider {
                width: 60px;
            }

            .video-stats {
                gap: 25px;
            }

            .stat-icon {
                width: 50px;
                height: 50px;
            }

            .stat-icon i {
                font-size: 1.2rem;
            }

            .stat-item strong {
                font-size: 1.2rem;
            }

            .autoplay-badge {
                top: 10px;
                right: 10px;
                padding: 6px 12px;
                font-size: 0.75rem;
            }
        }

        /* Variables CSS */
        :root {
            --color-primary: #284093;
            --color-secondary: #6c7ae0;
        }
    </style>
@endpush

<!-- SECTION VIDÉO PRÉSENTATION -->
<section id="video-presentation" class="video-presentation-section">
    <div class="container video-container-wrapper">
        <!-- Header -->
        <div class="video-header" data-aos="fade-up">
            <span class="video-label">
                <i class="bi bi-play-circle me-2"></i>
                Découvrez FOANI
            </span>
            {{-- <h2>Notre Présentation en Vidéo</h2> --}}
            <p class="fw-bold">
                Découvrez l'univers FOANI, un engagement pour l'excellence
            </p>
        </div>

        <!-- Vidéo principale -->
        <div class="video-main-container" data-aos="fade-up" data-aos-delay="200">
            <!-- Badge autoplay -->
            <div class="autoplay-badge" id="autoplayBadge">
                <i class="bi bi-record-circle"></i>
                <span>Lecture automatique</span>
            </div>

            <div class="video-wrapper" id="videoWrapper">
                <!-- Vidéo player -->
                <video id="foaniVideo" class="video-player" autoplay playsinline
                    poster="{{ asset('front/images/logoweb.png') }}">
                    <source src="{{ asset('video/spot_foani.mp4') }}" type="video/mp4">
                    <source src="{{ asset('video/spot_foani.webm') }}" type="video/webm">
                    Votre navigateur ne supporte pas la lecture de vidéos.
                </video>

                <!-- Overlay avec bouton play/pause central -->
                <div class="video-overlay">
                    <button class="video-play-button playing" id="playPauseBtn">
                        <i class="bi"></i>
                    </button>
                </div>

                <!-- Controls bar -->
                <div class="video-controls">
                    <!-- Play/Pause -->
                    <button class="control-btn" id="playPauseControl" title="Lecture/Pause">
                        <i class="bi bi-pause-fill"></i>
                    </button>

                    <!-- Progress bar -->
                    <div class="progress-container" id="progressContainer">
                        <div class="progress-bar" id="progressBar"></div>
                    </div>

                    <!-- Time -->
                    <div class="video-time">
                        <span id="currentTime">0:00</span> / <span id="duration">0:00</span>
                    </div>

                    <!-- Volume -->
                    <div class="volume-container">
                        <button class="control-btn" id="muteBtn" title="Son">
                            <i class="bi bi-volume-mute-fill"></i>
                        </button>
                        <div class="volume-slider" id="volumeSlider">
                            <div class="volume-bar" id="volumeBar"></div>
                        </div>
                    </div>

                    <!-- Fullscreen -->
                    <button class="control-btn fullscreen-btn" id="fullscreenBtn" title="Plein écran">
                        <i class="bi bi-fullscreen"></i>
                    </button>
                </div>
            </div>


        </div>
    </div>
</section>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const video = document.getElementById('foaniVideo');
            const playPauseBtn = document.getElementById('playPauseBtn');
            const playPauseControl = document.getElementById('playPauseControl');
            const progressContainer = document.getElementById('progressContainer');
            const progressBar = document.getElementById('progressBar');
            const currentTimeEl = document.getElementById('currentTime');
            const durationEl = document.getElementById('duration');
            const muteBtn = document.getElementById('muteBtn');
            const volumeSlider = document.getElementById('volumeSlider');
            const volumeBar = document.getElementById('volumeBar');
            const fullscreenBtn = document.getElementById('fullscreenBtn');
            const videoWrapper = document.getElementById('videoWrapper');
            const autoplayBadge = document.getElementById('autoplayBadge');

            // Fonctions de mise à jour des contrôles (définir avant utilisation)
            function updateMuteButton() {
                if (video.muted || video.volume === 0) {
                    muteBtn.innerHTML = '<i class="bi bi-volume-mute-fill"></i>';
                } else if (video.volume < 0.5) {
                    muteBtn.innerHTML = '<i class="bi bi-volume-down-fill"></i>';
                } else {
                    muteBtn.innerHTML = '<i class="bi bi-volume-up-fill"></i>';
                }
            }

            function updateVolumeBar() {
                const volume = video.muted ? 0 : video.volume;
                volumeBar.style.width = (volume * 100) + '%';
            }

            // Variable pour suivre si le son est activé
            let soundEnabled = false;

            // Configuration initiale du volume
            video.volume = 0.8;
            video.muted = false;

            // Fonction pour activer le son
            function enableSound() {
                video.muted = false;
                video.volume = 0.8;
                soundEnabled = true;
                updateMuteButton();
                updateVolumeBar();
                console.log('🔊 Son activé - Volume:', video.volume, 'Muted:', video.muted);
            }

            // Attendre que la vidéo soit prête et forcer l'autoplay avec son
            video.addEventListener('loadeddata', () => {
                enableSound();

                const playPromise = video.play();
                if (playPromise !== undefined) {
                    playPromise.then(() => {
                        console.log('✓ Autoplay réussi avec son');
                        if (!soundEnabled) {
                            enableSound();
                        }
                    }).catch(err => {
                        console.log('⚠ Autoplay bloqué par le navigateur:', err.message);
                        // Fallback: démarrer en muet puis activer le son au premier clic
                        video.muted = true;
                        soundEnabled = false;
                        video.play().then(() => {
                            console.log(
                                '✓ Vidéo démarrée en muet (cliquez pour activer le son)'
                                );
                            updateMuteButton();
                        });
                    });
                }
            });

            // Réactiver le son dès la première interaction utilisateur
            const enableSoundOnInteraction = () => {
                console.log('👆 Interaction détectée');
                enableSound();

                // Si la vidéo est en pause, la démarrer
                if (video.paused) {
                    video.play().then(() => {
                        console.log('▶️ Vidéo démarrée');
                    });
                }
            };

            // Écouter plusieurs événements pour activer le son
            ['click', 'touchstart', 'scroll'].forEach(eventType => {
                document.addEventListener(eventType, enableSoundOnInteraction, {
                    once: true
                });
            });

            // Cacher le badge autoplay après 3 secondes
            setTimeout(() => {
                autoplayBadge.style.opacity = '0';
                setTimeout(() => {
                    autoplayBadge.style.display = 'none';
                }, 300);
            }, 3000);

            // Quand la vidéo se termine, afficher le bouton play
            video.addEventListener('ended', () => {
                playPauseBtn.classList.remove('playing');
                playPauseBtn.classList.add('paused');
                playPauseControl.innerHTML = '<i class="bi bi-play-fill"></i>';
                // Ne pas revenir au début, rester sur la dernière image
            });

            // Play/Pause toggle
            function togglePlayPause() {
                if (video.paused || video.ended) {
                    // Si la vidéo est terminée, la recommencer depuis le début
                    if (video.ended) {
                        video.currentTime = 0;
                    }
                    video.play();
                    playPauseBtn.classList.remove('paused');
                    playPauseBtn.classList.add('playing');
                    playPauseControl.innerHTML = '<i class="bi bi-pause-fill"></i>';
                } else {
                    video.pause();
                    playPauseBtn.classList.remove('playing');
                    playPauseBtn.classList.add('paused');
                    playPauseControl.innerHTML = '<i class="bi bi-play-fill"></i>';
                }
            }

            playPauseBtn.addEventListener('click', togglePlayPause);
            playPauseControl.addEventListener('click', togglePlayPause);
            video.addEventListener('click', togglePlayPause);

            // Update progress bar
            video.addEventListener('timeupdate', () => {
                const progress = (video.currentTime / video.duration) * 100;
                progressBar.style.width = progress + '%';
                currentTimeEl.textContent = formatTime(video.currentTime);
            });

            // Set duration
            video.addEventListener('loadedmetadata', () => {
                durationEl.textContent = formatTime(video.duration);
            });

            // Seek video
            progressContainer.addEventListener('click', (e) => {
                const rect = progressContainer.getBoundingClientRect();
                const pos = (e.clientX - rect.left) / rect.width;
                video.currentTime = pos * video.duration;
            });

            // Mute/Unmute
            muteBtn.addEventListener('click', () => {
                video.muted = !video.muted;
                updateMuteButton();
                updateVolumeBar();
            });

            // Volume control
            volumeSlider.addEventListener('click', (e) => {
                const rect = volumeSlider.getBoundingClientRect();
                const pos = (e.clientX - rect.left) / rect.width;
                video.volume = pos;
                video.muted = false;
                updateVolumeBar();
                updateMuteButton();
            });

            video.addEventListener('volumechange', () => {
                updateVolumeBar();
                updateMuteButton();
            });

            // Fullscreen
            fullscreenBtn.addEventListener('click', () => {
                if (!document.fullscreenElement) {
                    videoWrapper.requestFullscreen().catch(err => {
                        console.log('Erreur fullscreen:', err);
                    });
                    fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen-exit"></i>';
                } else {
                    document.exitFullscreen();
                    fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen"></i>';
                }
            });

            document.addEventListener('fullscreenchange', () => {
                if (!document.fullscreenElement) {
                    fullscreenBtn.innerHTML = '<i class="bi bi-fullscreen"></i>';
                }
            });

            // Format time helper
            function formatTime(seconds) {
                const mins = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${mins}:${secs.toString().padStart(2, '0')}`;
            }

            // Keyboard shortcuts
            document.addEventListener('keydown', (e) => {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') return;

                switch (e.key) {
                    case ' ':
                    case 'k':
                        e.preventDefault();
                        togglePlayPause();
                        break;
                    case 'f':
                        fullscreenBtn.click();
                        break;
                    case 'm':
                        muteBtn.click();
                        break;
                    case 'ArrowLeft':
                        video.currentTime -= 5;
                        break;
                    case 'ArrowRight':
                        video.currentTime += 5;
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        video.volume = Math.min(1, video.volume + 0.1);
                        break;
                    case 'ArrowDown':
                        e.preventDefault();
                        video.volume = Math.max(0, video.volume - 0.1);
                        break;
                }
            });

            // Initial volume setup
            updateVolumeBar();
            updateMuteButton();
        });
    </script>
@endpush
