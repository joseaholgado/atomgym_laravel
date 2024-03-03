<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Entrenamiento;

class SearchComponent extends Component
{
    public $busqueda = '';

    public function render()
    {
        $user = Auth::user();
        $entrenamientos = [];

        if (strlen($this->busqueda) >= 2) {
            $entrenamientos = $user->entrenamientos()
                ->where('nombre', 'like', '%' . $this->busqueda . '%')
                ->orWhereHas('musculo', function ($query) {
                    $query->where('nombre', 'like', '%' . $this->busqueda . '%');
                })
                ->paginate(2);
        }

        return view('livewire.search-component', ['entrenamientos' => $entrenamientos]);
    }
}