{{-- Protection anti-robots (voir App\Support\AntiRobot) : champ piège hors écran + heure d'affichage chiffrée --}}
<div style="position: absolute; left: -10000px; top: auto; width: 1px; height: 1px; overflow: hidden;" aria-hidden="true">
    <label>Laissez ce champ vide
        <input type="text" name="{{ \App\Support\AntiRobot::PIEGE }}" value="" tabindex="-1" autocomplete="off">
    </label>
</div>
<input type="hidden" name="{{ \App\Support\AntiRobot::JETON }}" value="{{ \App\Support\AntiRobot::jeton() }}">
