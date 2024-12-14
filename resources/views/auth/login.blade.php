@include('bovenenbeneden.header')

<div class="min-h-screen bg-gradient-to-br from-indigo-100 via-white to-indigo-200 flex items-center justify-center py-12 px-6 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-lg shadow-md p-8 space-y-8 transform transition-all duration-300 hover:shadow-xl">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">
                {{ __('Login to your account') }}
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                {{ __("Don't have an account?") }}
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                    {{ __('Sign up here') }}
                </a>
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf
            <div class="space-y-4">
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        {{ __('Email Address') }}
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="email" required
                               class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('email') border-red-500 @enderror"
                               placeholder="{{ __('Enter your email') }}"
                               value="{{ old('email') }}">
                        @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        {{ __('Password') }}
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('password') border-red-500 @enderror"
                               placeholder="{{ __('Enter your password') }}">
                        @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Remember Me and Forgot Password -->
            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember" name="remember" type="checkbox"
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                           {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember" class="ml-2 block text-sm text-gray-900">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <div class="text-sm">
                        <a href="{{ route('password.request') }}" class="font-medium text-indigo-600 hover:text-indigo-500">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-transform transform hover:scale-105">
                    {{ __('Login') }}
                </button>
            </div>
        </form>

        <!-- Social Login Option -->
        <div class="relative flex items-center justify-center py-4">
            <div class="w-full border-t border-gray-300"></div>
            <span class="absolute px-2 bg-white text-gray-500 text-sm">
                {{ __('Or login with') }}
            </span>
        </div>
        <div class="flex justify-center space-x-4">
            <button class="flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M22.162 10.334h-1.14V9.26h1.14v1.074zm-6.906 2.314v4.366c0 .183-.02.367-.062.55h-4.83v-6.868h6.068v2.086zm-4.812 4.916H3.566v-6.868h6.878v6.868zM22.205 24c.5 0 1.08-.184 1.62-.552l-1.174-.903h-.414V24z"/>
                </svg>
                <span>Google</span>
            </button>
            <button class="flex items-center space-x-2 px-4 py-2 bg-blue-800 text-white rounded-lg shadow hover:bg-blue-900">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M24 12.073c0-6.617-5.383-12-12-12s-12 5.383-12 12c0 5.991 4.388 10.958 10.125 11.84v-8.387h-3.047v-3.453h3.047v-2.633c0-3.014 1.798-4.688 4.533-4.688 1.312 0 2.688.236 2.688.236v2.953h-1.515c-1.491 0-1.954.926-1.954 1.875v2.257h3.328l-.531 3.453h-2.797v8.387c5.737-.883 10.125-5.849 10.125-11.84z"/>
                </svg>
                <span>Facebook</span>
            </button>
        </div>
    </div>
</div>

@include('bovenenbeneden.footer')
