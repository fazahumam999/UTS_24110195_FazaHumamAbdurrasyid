<?php

namespace App\Http\Controllers;

use App\Models\Tamu;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TamuController extends Controller
{
        public function tamu()
        {
            $tamus = Tamu::all();
            return view('tamu', compact('tamus'));
        }
    
        public function create()
        {
            return view('create')->with('success', 'Tamu berhasil ditambahkan!');
        }

        public function store(Request $request)
        {

            $request->validate([
                'nama'             => 'required|string|max:255',
                'nomor_identitas'  => 'required|string|unique:tamus,nomor_identitas',
                'alamat'           => 'required|string',
                'telepon'          => 'required|string',
                'tanggal_checkin'  => 'required|date',
                'tanggal_checkout' => 'required|date|after_or_equal:tanggal_checkin',
            ]);
    
            Tamu::create($request->all());
    
            return redirect()->route('tamu')->with('success', 'Tamu berhasil ditambahkan!');

        }
    
        public function edit($id)
        {
            $tamu = Tamu::findOrFail($id);
            return view('edit', compact('tamu'));
        }
    
        public function update(Request $request, $id)
        {
            $request->validate([
                'nama'             => 'required|string|max:255',
                'nomor_identitas'  => "required|string|unique:tamus,nomor_identitas,{$id}",
                'alamat'           => 'required|string',
                'telepon'          => 'required|string',
                'tanggal_checkin'  => 'required|date',
                'tanggal_checkout' => 'required|date|after_or_equal:tanggal_checkin',
            ]);
    
            $tamu = Tamu::findOrFail($id);
            $tamu->update($request->all());
    
            return redirect()->route('tamu')->with('success', 'Data tamu berhasil diupdate!');
            session()->flash('success', 'Data berhasil diperbarui');
        }
    
        public function destroy($id)
        {
            $tamu = Tamu::findOrFail($id);
            $tamu->delete();
    
            return redirect()->route('tamu');
        }
}
