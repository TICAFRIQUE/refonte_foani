<?php

namespace App\Http\Controllers\backend;

use Exception;
use App\Models\Candidat;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CandidatController extends Controller
{
    //liste des candidats
    public function index()
    {
        try {
            $candidats = Candidat::latest()->get();
            return view('backend.pages.candidats.index', compact('candidats'));
        } catch (\Throwable $th) {
            return back()->with('error', 'Erreur lors du chargement des candidats : ' . $th->getMessage());
        }
    }

    // suppression
    public function delete($id)
    {
        $candidat = Candidat::findOrFail($id);
        $candidat->delete();

        return response()->json([
            'status' => 200,
        ]);
    }
}
