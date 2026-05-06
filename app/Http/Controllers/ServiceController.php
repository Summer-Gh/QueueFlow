<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\FileAttente;
use App\Models\Ticket;

class ServiceController extends Controller
{
    // =========================
    // LIST ALL SERVICES
    // =========================
    public function index()
    {
        $services = Service::all();
        return view('services.index', compact('services'));
    }

    // =========================
    // ADD SERVICE (AGENT)
    // =========================
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
            ->with('success', 'Service ajouté avec succès');
    }

    // =========================
    // DELETE SERVICE
    // =========================
    public function delete($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        // delete file + tickets FIRST (FK constraint fix)
        $file = FileAttente::where('idService', $id)->first();

        if ($file) {
            Ticket::where('idFile', $file->idFile)->delete();
            $file->delete();
        }

        $service->delete();

        return redirect()->route('services.index')
            ->with('success', 'Service supprimé avec succès');
    }

    // =========================
    // SHOW ONE SERVICE + TICKETS
    // =========================
    public function show($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        $tickets = [];

        if ($service->fileAttente) {
            $tickets = Ticket::where('idFile', $service->fileAttente->idFile)
                ->orderBy('position', 'asc')
                ->get();
        }

        return view('services.show', compact('service', 'tickets'));
    }

    // =========================
    // SHOW UPDATE FORM
    // =========================
    public function updateForm($id)
    {
        $service = Service::find($id);

        if (!$service) {
            abort(404);
        }

        return view('services.update', compact('service'));
    }

    // =========================
    // UPDATE SERVICE
    // =========================
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