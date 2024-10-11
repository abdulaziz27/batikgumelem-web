<x-filament-panels::page>
    <form wire:submit.prevent="generateReport">
        {{ $this->form }}

        <x-filament::button type="submit" class="mt-4">
            Generate Report
        </x-filament::button>
    </form>
</x-filament-panels::page>
