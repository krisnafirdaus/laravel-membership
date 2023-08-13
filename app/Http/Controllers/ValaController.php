<?php

namespace App\Http\Controllers;

use App\Models\Vala;
use Illuminate\Http\Request;

class ValaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $valas = Vala::all();
        return view('valas.index', compact('valas'));
    }
    
    public function create()
    {
        return view('valas.create');
    }
    
    public function store(Request $request)
    {
        // Validasi
        $data = $request->validate([
            'NamaValas' => 'required|string',
            'Nilai_Jual' => 'required|numeric',
            'Nilai_Beli' => 'required|numeric',
            'Tanggal_Rate' => 'required|date',
        ]);
    
        // Simpan
        Vala::create($data);
    
        return redirect()->route('valas.index');
    }    
}
