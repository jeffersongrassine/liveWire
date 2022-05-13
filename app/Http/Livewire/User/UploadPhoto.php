<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class UploadPhoto extends Component
{
    /**
     * trait para conseguir fazer o upload
     */
    use WithFileUploads;

    public $photo;
    
    public function render()
    {
        return view('livewire.user.upload-photo');
    }

    public function storagePhoto()
    {
        /**Validando direto do modulo */
        $this->validate([
            'photo' => 'required|image|max:1024'
        ]);
        
        //Pegando nome do Usuario
        $user = auth()->user()->name;

        //Renomeando o arquivo enviado
        $nameFile = Str::slug($user) . '.' .$this->photo->getClientOriginalExtension();

        //Gravando no Storage com o nome personalizado
        if ($path = $this->photo->storeAs('users', $nameFile)) {
            auth()->user()->update([
                'profile_photo_path' => $path
            ]);
        }

        return redirect()->route('tweets');
    }
}
