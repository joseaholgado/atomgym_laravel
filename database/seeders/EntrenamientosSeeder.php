<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Entrenamiento;

class EntrenamientosSeeder extends Seeder
{
    /**
     * Corre los seeder para rellenar la tabla entrenamientos
     */
    public function run(): void
    {
        // Array de 100 ejercicios
        $nombreEjercicio = ['Push-ups', 'Squats', 'Lunges', 'Pull-ups', 'Deadlifts', 'Bench Press', 'Bicep Curls', 'Tricep Dips', 'Shoulder Press', 'Leg Press'];

        // Trae todos los usuarios
        $users = User::all();

        // For de cada usuario, crea 100 entrenamientos
        foreach ($users as $user) {
            for ($i = 0; $i < 10; $i++) {
                Entrenamiento::create([
                    'user_id' => $user->id,
                    'musculo_id' => rand(1, 11), 
                    'nombre_ejercicio' => $nombreEjercicio[array_rand($nombreEjercicio)],
                    'series' => rand(1, 5),
                    'repeticiones' => rand(1, 10),
                    'descripcion' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla quam velit, vulputate eu pharetra nec, mattis ac neque. Duis vulputate commodo lectus, ac blandit elit tincidunt id. Sed rhoncus, tortor sed eleifend tristique, tortor mauris molestie elit, et luctus risus orci quis sem. Nulla ac euismod nunc. Nulla facilisi. Nulla nunc nunc, placerat at varius id, adipiscing in quam. Nulla facilisi. Curabitur et ligula.',
                    'imagen_ruta' => null,
                ]);
            }
        }
    }
}