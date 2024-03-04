<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Contraseña')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Recordar sesión') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Olvidaste tu contraseña?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Acceder') }}
            </x-primary-button>

        </div>
    </form>
    <a href="{{ route('register') }}">
        <x-primary-button class="ms-3" style="margin-left:70%; margin-top:5%">
            {{ __('Registrarse') }}
        </x-primary-button>
    </a>
</x-guest-layout>
<script>
    // Select all paths in the SVG
    let paths = document.querySelectorAll('svg path');

// For each path...
for (let i = 0; i < paths.length; i++) {
    let path = paths[i];

    // Get the length of the path
    let length = path.getTotalLength();

    // Set a CSS letiable for the length
    path.style.setProperty('--path-stroke', length);

    // Reset the length of the path to 0
    path.style.strokeDasharray = length;
    path.style.strokeDashoffset = length;
}

// Create the animation
anime({
    targets: 'path',
    strokeDashoffset: [anime.setDashoffset, 0],
    easing: 'easeInOutSine',
    duration: 5500,
    delay: function(el, i) { return i * 10 },
    direction: 'alternate',
    loop: true
});
anime({
    targets: 'svg ',
    translateY: 20,
    duration: 2000,
    easing: 'easeInOutQuad',
    direction: 'alternate',
    loop: true
});
</script>
