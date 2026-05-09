<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FileAttente;
use App\Models\Ticket;

class AutoAdvanceQueues extends Command
{
    protected $signature = 'queue:auto';

    protected $description = 'Automatically advance queues';

    public function handle()
    {
        $files = FileAttente::all();

        foreach ($files as $file) {

            // get first ticket
            $first = Ticket::where('idFile', $file->idFile)
                ->orderBy('position', 'asc')
                ->first();

            // no tickets
            if (!$first) {
                continue;
            }

            // remove first ticket
            $first->delete();

            // reorder remaining tickets
            $tickets = Ticket::where('idFile', $file->idFile)
                ->orderBy('position', 'asc')
                ->get();

            $position = 1;

            foreach ($tickets as $ticket) {

                $ticket->position = $position;

                // 2 minutes per position
                $ticket->tempsEstime = $position * 2;

                $ticket->save();

                $position++;
            }

            $this->info('Queue updated for file ID: ' . $file->idFile);
        }

        return 0;
    }
}