<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class ShowTweets extends Component
{
    
    public $message = 'Apenas um teste';

    public function render()
    {
        $tweets = Tweet::with('user')->get(); //Metodo with(), otimiza busca ao BD

        return view('livewire.show-tweets', [ 
            'tweets' => $tweets

        ]);

    }
}
