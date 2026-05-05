<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileAttente;
use App\Models\Ticket;

class FileController extends Controller
{
    // ADD FILE (1 per service)
    public function add(Request $request)
    {
        $exists = FileAttente::where('idService', $request->idService)->exists();

        if ($exists) {
            return back()->with('error', 'Ce service a déjà une file');
        }

        FileAttente::create([
            'nomFile' => $request->nomFile,
            'capacite' => $request->capacite,
            'idService' => $request->idService
        ]);

        return back()->with('success', 'File ajoutée');
    }

    // JOIN FILE (USER)
    public function join(Request $request)
    {
        $file = FileAttente::find($request->idFile);

        if (!$file) {
            return back()->with('error', 'File inexistante');
        }

        $count = Ticket::where('idFile', $file->idFile)->count();

        // capacity check 
        if ($count >= $file->capacite) {
            return back()->with('error', 'File pleine');
        }

        $position = $count + 1;

        Ticket::create([
            'tempsestime' => $position * 5,
            'position' => $position,
            'idFile' => $file->idFile
        ]);

        return back()->with('success', 'Vous avez rejoint la file');
    }

    // DELETE FILE (agent)
    public function delete($id)
    {
        $file = FileAttente::find($id);

        if (!$file) {
            abort(404);
        }

        Ticket::where('idFile', $id)->delete();
        $file->delete();

        return back()->with('success', 'File supprimée');
    }
    public function updateForm($id)
    {
        $file = \App\Models\FileAttente::find($id);
        if (!$file) {
            abort(404);
        }
        return view('file.update', compact('file'));
    }
    public function update(Request $request, $id)
    {
        $file = \App\Models\FileAttente::find($id);
        if (!$file) {
            abort(404);
        }
        $file->nomFile = $request->nomFile;
        $file->capacite = $request->capacite;
        $file->save();
        return back()->with('success', 'File modifiée');
    }
    
}