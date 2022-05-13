<div class="p-10">
    <h1>Atualizar Photo Perfil</h1>

    <form action="#" method="post" wire:submit.prevent="storagePhoto">
        <span class="text-red-600 font-semibold">
            @error('photo') {{ $message }} @enderror
        </span>
        <input type="file" wire:model="photo">
        <button type="submit">Upload Photo</button>
    </form>
</div>
