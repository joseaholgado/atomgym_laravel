<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class MusculosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $musculos=[
            ['nombre'=>'Pecho'],
            ['nombre'=>'Espalda'],
            ['nombre'=>'Hombros'],
            ['nombre'=>'Biceps'],
            ['nombre'=>'Triceps'],
            ['nombre'=>'Piernas'],
            ['nombre'=>'Abdominales'],
            ['nombre'=>'Gluteos'],
            ['nombre'=>'Trapecio'],
            ['nombre'=>'Antebrazo'],
            ['nombre'=>'Gemelos']
        ];
        foreach($musculos as $musculo){
            DB::table('musculos')->insert([
                 'nombre'=>$musculo
            ]);
        }
    }
}
