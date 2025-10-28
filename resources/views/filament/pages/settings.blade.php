<x-filament::page>
	<form wire:submit="save">
		{{ $this->form }}
        @if (session()->has('success'))
            <p class="mt-4 text-green-500">{{ session('success') }}</p>
        @endif
        <x-filament::button size="sm mt-5" wire:click='save' class="">
            Save
        </x-filament::button>
	</form>    

</x-filament::page>