<?php

    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Validation\Rules;
    use Livewire\Attributes\Layout;
    use Livewire\Volt\Component;

    new #[Layout('layouts.guest')] class extends Component
    {
        public string $name                  = '';
        public string $email                 = '';
        public string $password              = '';
        public string $password_confirmation = '';

        public function register(): void
        {
            $validated = $this->validate([
                'name'     => ['required', 'string', 'max:255'],
                'email'    => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            ]);

            $validated['password'] = Hash::make($validated['password']);

            event(new Illuminate\Auth\Events\Registered($user = User::create($validated)));

            Auth::login($user);

            $this->redirect(route('dashboard', absolute: false), navigate: true);
        }
}?>

<div>
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-slate-800">Sign Up</h2>
        <p class="text-slate-500 text-sm mt-2">Create your account to get started.</p>
    </div>

    <form wire:submit="register">

        <div class="mb-5">
            <label for="name" class="block font-medium text-sm text-slate-700 mb-2">Full Name</label>
            <input wire:model="name" id="name" type="text" name="name" required autofocus autocomplete="name"
                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-transparent focus:border-slate-500 focus:bg-white focus:ring-0 transition-all duration-200 text-sm placeholder-slate-400"
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-5">
            <label for="email" class="block font-medium text-sm text-slate-700 mb-2">Email</label>
            <input wire:model="email" id="email" type="email" name="email" required autocomplete="username"
                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-transparent focus:border-slate-500 focus:bg-white focus:ring-0 transition-all duration-200 text-sm placeholder-slate-400"
                placeholder="Example@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-5" x-data="{ show: false }">
            <label for="password" class="block font-medium text-sm text-slate-700 mb-2">Password</label>
            <div class="relative">
                <input wire:model="password" :type="show ? 'text' : 'password'" id="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-3 rounded-xl bg-slate-50 border-transparent focus:border-slate-500 focus:bg-white focus:ring-0 transition-all duration-200 text-sm placeholder-slate-400"
                    placeholder="Create a password" />
                <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-400 hover:text-slate-600 outline-none">
                     <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                    <svg x-show="show" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6">
            <label for="password_confirmation" class="block font-medium text-sm text-slate-700 mb-2">Confirm Password</label>
            <input wire:model="password_confirmation" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                class="w-full px-4 py-3 rounded-xl bg-slate-50 border-transparent focus:border-slate-500 focus:bg-white focus:ring-0 transition-all duration-200 text-sm placeholder-slate-400"
                placeholder="Confirm your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <button type="submit" class="w-full bg-slate-700 hover:bg-slate-800 text-white font-semibold py-3.5 px-4 rounded-xl shadow-lg shadow-slate-300/50 transition duration-200 flex justify-center items-center gap-2">
            <span wire:loading.remove>Sign Up</span>
            <span wire:loading>Creating Account...</span>
        </button>
    </form>

    <div class="relative flex py-8 items-center">
        <div class="flex-grow border-t border-slate-200"></div>
        <span class="flex-shrink-0 mx-4 text-slate-400 text-xs">Or with</span>
        <div class="flex-grow border-t border-slate-200"></div>
    </div>

    <div class="grid grid-cols-3 gap-3 mb-8">
        <button class="flex items-center justify-center py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition"><img src="https://www.svgrepo.com/show/475656/google-color.svg" class="w-6 h-6"></button>
        <button class="flex items-center justify-center py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition"><img src="https://www.svgrepo.com/show/475647/facebook-color.svg" class="w-6 h-6"></button>
        <button class="flex items-center justify-center py-2.5 border border-slate-200 rounded-xl hover:bg-slate-50 transition"><svg class="w-6 h-6 text-black" fill="currentColor" viewBox="0 0 24 24"><path d="M17.05 20.28c-.98.95-2.05.8-3.08.35-1.09-.46-2.09-.48-3.24 0-1.44.62-2.2.44-3.06-.35C2.79 15.25 3.51 7.59 9.05 7.31c1.35.07 2.29.74 3.08.74 1.18 0 2.45-1.11 4.1-1.11 1.03.06 2.36.43 3.4 1.62-2.8 1.4-2.4 5.25.46 6.64-.53 1.48-1.25 2.92-3.04 5.08zM12.03 7.25c-.15-2.23 1.66-4.07 3.74-4.25.29 2.58-2.34 4.5-3.74 4.25z"/></svg></button>
    </div>

    <div class="text-center text-sm text-slate-500">
        Already have an account?
        <a href="{{ route('login') }}" wire:navigate class="font-bold text-slate-800 hover:underline">Sign In</a>
    </div>
</div>
