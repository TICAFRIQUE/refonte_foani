<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Affiche la liste des sliders.
     */
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('backend.pages.slider.index', compact('sliders'));
    }

    /**
     * Enregistre un nouveau slider.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'url' => 'nullable|url|max:255',
                'btn_nom' => 'nullable|string|max:100',
                'description' => 'nullable|string|max:500',
                'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
                'visible' => 'nullable|boolean',
            ]);

            // Vérifier si un slider du même libellé existe déjà
            if (Slider::where('libelle', $validated['libelle'])->exists()) {
                return redirect()->back()->with('error', 'Un slider avec ce libellé existe déjà.')->withInput();
            }

            // Upload de l’image
            if ($request->hasFile('image')) {
                $validated['image'] = $request->file('image')->store('sliders', 'public');
            }

            // Assurer que 'visible' a une valeur même si non cochée
            $validated['visible'] = $request->has('visible') ? (bool) $request->visible : false;

            Slider::create($validated);

            return redirect()->route('sliders.index')->with('success', 'Slider ajouté avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Met à jour un slider existant.
     */
    public function update(Request $request, $id)
    {
        try {
            $slider = Slider::findOrFail($id);

            $validated = $request->validate([
                'libelle' => 'required|string|max:255',
                'url' => 'nullable|url|max:255',
                'btn_nom' => 'nullable|string|max:100',
                'description' => 'nullable|string|max:500',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'visible' => 'nullable|boolean',
            ]);

            // Upload d’une nouvelle image si fournie
            if ($request->hasFile('image')) {
                // Supprimer l’ancienne image si elle existe
                if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                    Storage::disk('public')->delete($slider->image);
                }

                $validated['image'] = $request->file('image')->store('sliders', 'public');
            }
            // Assurer que 'visible' a une valeur même si non cochée
            $validated['visible'] = $request->has('visible') ? (bool) $request->visible : false;


            $slider->update($validated);

            return redirect()->route('sliders.index')->with('success', 'Slider mis à jour avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Supprime un slider.
     */
    public function delete($id)
    {
        try {

            $slider = Slider::findOrFail($id);

            // Supprimer l’image du stockage
            if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                Storage::disk('public')->delete($slider->image);
            }

            $slider->delete();

            return response()->json([
                'status' => 200,
            ]);

            // return redirect()->route('sliders.index')->with('success', 'Slider supprimé avec succès.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur : ' . $e->getMessage());
        }
    }
}
