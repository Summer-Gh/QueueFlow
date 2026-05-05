use App\Models\Ticket;

public function join(Request $request)
{
    $idFile = $request->idFile;

    // count tickets → position
    $position = Ticket::where('idFile', $idFile)->count() + 1;

    Ticket::create([
        'tempsEstime' => $position * 5,
        'position' => $position,
        'idFile' => $idFile
    ]);

    return back()->with('success', 'Vous avez rejoint la file');
}