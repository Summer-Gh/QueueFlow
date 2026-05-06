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

    if ($count >= $file->capacite) {
        return back()->with('error', 'File pleine');
    }

    $position = $count + 1;
    $temps = $position * 5;

    $ticket = Ticket::create([
        'tempsEstime' => $temps,
        'position' => $position,
        'idFile' => $file->idFile
    ]);

    return back()->with('success', 
        'Vous avez rejoint la file | Position: '.$position.' | Temps estimé: '.($position*5).' min'
    );
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
    public function next($id)
    {
    $first = Ticket::where('idFile', $id)
        ->orderBy('position', 'asc')
        ->first();

    if (!$first) {
        return back()->with('error', 'Aucun client');
    }

    // remove first client
    $first->delete();

    // update others
    $tickets = Ticket::where('idFile', $id)->get();

    foreach ($tickets as $t) {
        $t->position = $t->position - 1;
        $t->tempsEstime = $t->position * 5;
        $t->save();
    }

    return back()->with('success', 'Client suivant appelé');
    }   
}