@if ($errors->any())
    <div {{ $attributes }}>
        <div class="text-xl text-red-600">{{ __('Ops! Algo deu errado.') }}</div>

        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        @if (Route::has('password.request'))
         @if(request()->routeIs('login'))
                <a class="underline text-sm mt-4 text-blue-400 hover:text-emerald-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Esqueceu sua senha?') }}
                </a>
            @endif
        @endif
    </div>
@endif
