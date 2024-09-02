@if(session('success') || session('error') || $errors->any())
<div class="fixed inset-0 bg-gray-900 bg-opacity-90 flex items-center justify-center z-50 px-4 py-6">
    <div class="bg-gray-800 rounded-lg w-full max-w-lg p-4 overflow-hidden">
        <button onclick="this.parentElement.parentElement.style.display='none';" class="absolute top-4 right-4 text-gray-400 hover:text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        @if(session('success'))
        <div class="flex items-center text-green-400 bg-green-900 rounded p-4" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        @endif

        @if(session('error'))
        <div class="flex items-center text-red-400 bg-red-900 rounded p-4" role="alert">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.268 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
            <span>{{ session('error') }}</span>
        </div>
        @endif

        @if($errors->any())
        <div class="text-red-400 bg-red-900 rounded p-4" role="alert">
            <ul class="list-disc pl-10 space-y-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>
@endif
