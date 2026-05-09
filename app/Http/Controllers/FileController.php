<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileAttente;
use App\Models\Ticket;
use App\Models\Notifications;
use Barryvdh\DomPDF\Facade\Pdf;

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

    // prevent duplicate join
    $already = Ticket::where('idFile', $file->idFile)
        ->where('idUser', session('user_id'))
        ->exists();

    if ($already) {
        return back()->with('error', 'Vous êtes déjà dans cette file');
    }

    $count = Ticket::where('idFile', $file->idFile)->count();

    // capacity check
    if ($count >= $file->capacite) {
        return back()->with('error', 'File pleine');
    }

    $position = $count + 1;

    $ticket = Ticket::create([
        'position' => $position,
        'tempsEstime' => $position * 2,
        'idFile' => $file->idFile,
        'idUser' => session('user_id')
    ]);
    Notifications::create([
        'message' => 'Votre ticket a été créé avec succès',
        'idUser' => session('user_id')
    ]);
    if($position <= 3){
        Notifications::create([
            'message' => 'Votre tour approche',
            'idUser' => session('user_id')
        ]);
    }
    if($position == 1){
        Notifications::create([
            'message' => 'C’est votre tour',
            'idUser' => session('user_id')
        ]);
    }

    return back()->with('success', 'Ticket créé');
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
    $file = FileAttente::find($id);

    if (!$file) {
        abort(404);
    }

    $file->nomFile = $request->nomFile;
    $file->capacite = $request->capacite;
    $file->save();

    return redirect()->route(
        'services.show',
        $file->idService
    )->with('success', 'File modifiée avec succès');
    }
    public function next($id)
    {
    $first = Ticket::where('idFile', $id)
        ->orderBy('position', 'asc')
        ->first();

    if (!$first) {
        return back()->with('error', 'Aucun ticket');
    }

    // delete first
    $first->delete();

    // reorder
    $tickets = Ticket::where('idFile', $id)->get();

    foreach ($tickets as $t) {

        $t->position = $t->position - 1;

        $t->tempsEstime = $t->position * 2;

        $t->save();
        if($t->position <= 3){
            Notifications::create([
                'message' => 'Votre tour approche',
                'idUser' => $t->idUser
            ]);
        }
        if($t->position == 1){
            Notifications::create([
                'message' => 'C’est votre tour',
                'idUser' => $t->idUser
            ]);
        }
    }

    return back()->with('success', 'Client suivant appelé');
    }  
    public function downloadTicket($id)
    {
    $ticket = Ticket::find($id);

    if(!$ticket){
        abort(404);
    }

    $pdf = Pdf::loadView(
        'ticket.pdf',
        compact('ticket')
    );

    return $pdf->download('ticket.pdf');
    }
}