<div>
   Show Tweets


   <p>{{ $content }}</p> 

   <form method="post" wire:submit.prevent="create">

       <input type="text" name="content" id="content" wire:model="content" />
       @error('content')
           {{ $message}}
       @enderror
       <button type="submit">Criar Tweet</button>
   </form>
   <hr>

   @foreach ($tweets as $tweet)
       <div class="flex">
        <div class="1/8">
            {{-- Verificnado se o usuario tem uma foto, 'photo', vem da mutation no modulo user --}}
            @if ($tweet->user->photo)
                <img src="{{ url("storage/{$tweet->user->photo}") }}" alt="{{ $tweet->user->name }}" class="rounded-full h-8 w-8" >
             @else
                 <img src="{{ url('images/papel_parede.jpg')}}" alt="{{ $tweet->user->name }}" class="rounded-full h-8 w-8">
             @endif
             {{ $tweet->user->name }}
       </div>
        <div class="7/8">
            {{ $tweet->content }} - 

            {{-- opção de curtir ou descurtir --}}
            @if ($tweet->likes->count())
                <a href="#" wire:click.prevent="unlike({{ $tweet->id }})">Descurtir</a>
            @else
            <a href="#" wire:click.prevent="like({{ $tweet->id }})">Curtir</a>
            @endif
        </div>
       </div>
        <br>
    @endforeach


    <hr>
    <div>
        {{ $tweets->links()}}
    </div>
</div>
