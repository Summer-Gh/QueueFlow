<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\FileAttente;
use App\Models\Ticket;

class ServiceController extends Controller
{
    // afficher tous les services
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // ajouter service (agent)
    public function add(Request $request)
    {
        $request->validate([
            'nomService' => 'required',
            'description' => 'required'
        ]);

        Service::create([
            'nomService' => $request->nomService,
            'description' => $request->description,
            'idUser' => session('user_id')
        ]);

        return redirect()->route('services.index')
            ->with('success', 'Service ajouté');
    }

    // supprimer service (FIX FK ERROR)
    public function delete($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        // delete file + tickets first
        $file = FileAttente::where('idService', $id)->first();

        if ($file) {
            Ticket::where('idFile', $file->idFile)->delete();
            $file->delete();
        }

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service supprimé');
    }

    // show details
    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        return view('services.show', compact('service'));
    }

    // UPDATE FORM
    public function updateForm($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        return view('services.update', compact('service'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
    $request->validate([
        'nomService' => 'required',
        'description' => 'required'
    ]);

    $service = Service::find($id);

    if (!$service) {
        abort(404);
    }

    $service->nomService = $request->nomService;
    $service->description = $request->description;
    $service->save();

    return redirect()->route('services.index')
        ->with('success', 'Service modifié avec succès');
        }
}