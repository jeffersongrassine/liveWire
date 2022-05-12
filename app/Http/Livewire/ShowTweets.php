<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    // Traid para não FAZER RELOAD NA PAGINAÇÃO
    use WithPagination;

    public $content = '';

    // Validações
    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function render()
    {
        //Pega os tweeter do usuario
        // $tweets = Tweet::with('user')->get(); //Metodo with(), otimiza busca ao BD
        $tweets = Tweet::with('user')->latest()->paginate(10); //Metodo with(), otimiza busca ao BD

        return view('livewire.show-tweets', [ 
            'tweets' => $tweets

        ]);

    }
    
    
    public function create()
    {
        $this->validate();

        // Primeiro Exemplo
        // Tweet::create([
        //     'content' => $this->content,
        //     'user_id' => auth()->user()->id(),
        // ]);

        auth()->user()->tweets()->create([
            'content' =>  $this->content
        ]);

        $this->content = '';
        
        //dd($this->message);
    }

    public function like($idTweet)
    {
        $tweet = Tweet::findOrFail($idTweet);

        $tweet->likes()->create([
            'user_id' => auth()->user()->id
        ]);

    }

    public function unlike(Tweet $tweet)
    {
        $tweet->likes()->delete();

    }

   
}
