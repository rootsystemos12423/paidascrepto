<div>
    <div class="mb-10">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight mb-4">
            Prompt da IA do Chat
        </h2>
        <textarea wire:model.debounce.500ms="prompt" id="chatPrompt" name="chatPrompt" rows="4" class="shadow-sm focus:ring-emerald-500 focus:border-emerald-500 mt-1 block w-full sm:text-sm border-gray-600 rounded-lg bg-gray-800 text-gray-300 p-3" placeholder="Digite o prompt da IA aqui..."></textarea>
    </div>
    @if ($message)
    <div class="mt-3 text-green-500">
        {{ $message }}
    </div>
    @endif    
</div>
