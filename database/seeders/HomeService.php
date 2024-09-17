<?php

namespace Database\Seeders;

use App\Models\Home;
use App\Models\HomeService as ModelsHomeService;
use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class HomeService extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        ModelsHomeService::truncate();

        // Recupera tutti gli homes e i servizi
        $homes = Home::pluck('id')->toArray();
        $services = Service::pluck('id')->toArray();

        // Numero di associazioni da creare
        $numAssociations = 120;

        // Genera e inserisce associazioni uniche
        $insertData = [];
        while (count($insertData) < $numAssociations) {
            // Seleziona un home e un servizio casuali
            $homeId = $homes[array_rand($homes)];
            $serviceId = $services[array_rand($services)];

            // Controlla se la combinazione esiste già nella tabella
            $exists = ModelsHomeService::where('home_id', $homeId)
                ->where('service_id', $serviceId)
                ->exists();

            if (!$exists) {
                // Aggiunge la combinazione all'array di dati da inserire
                $insertData[] = [
                    'home_id' => $homeId,
                    'service_id' => $serviceId,
                ];
            }
        }

        DB::table('home_service')->insert($insertData);

        Schema::enableForeignKeyConstraints();
    }
}
