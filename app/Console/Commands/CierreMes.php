<?php

namespace App\Console\Commands;

use App\Models\Sucursal;
use Illuminate\Console\Command;

class CierreMes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cierre-mes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cierre de mes a las 11:59 de cada mes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        // ejecuta la consulta del cierre de mes
        Sucursal::cierreMes();
    }
}
