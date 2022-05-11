<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    // Traid para não FAZER RELOAD NA PAGINAÇÃO
    use WithPagination;


    public function render()
    {
        //Pega os tweeter do usuario
        // $tweets = Tweet::with('user')->get(); //Metodo with(), otimiza busca ao BD
        $tweets = Tweet::with('user')->paginate(3); //Metodo with(), otimiza busca ao BD

        return view('livewire.show-tweets', [ 
            'tweets' => $tweets

        ]);

    }
    
    public $content = 'Apenas um teste';

    // Validações
    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];
    
    public function create()
    {
        $this->validate();

        Tweet::create([
            'content' => $this->content,
            'user_id' => 1,
        ]);

        $this->content = '';
        
        //dd($this->message);
    }

   
}
