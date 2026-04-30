<x-guest-layout>
    <div class="text-center mb-6">
        <h2 class="text-[#EAB308] text-4xl font-bold">Login</h2>
    </div>

    <!-- Social Login Buttons -->
    <div class="space-y-3 mb-6">
        <!-- Google -->
        <button class="w-full flex items-center justify-center space-x-3 border border-gray-600 rounded-full py-2 hover:bg-gray-800 transition">
            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" class="w-5 h-5" alt="Google">
            <span class="text-white text-sm">Continue with Google</span>
        </button>

        <!-- Facebook -->
        <button class="w-full flex items-center justify-center space-x-3 border border-gray-600 rounded-full py-2 hover:bg-gray-800 transition">
            <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            <span class="text-white text-sm">Continue with Facebook</span>
        </button>

        <!-- Apple -->
        <button class="w-full flex items-center justify-center space-x-3 border border-gray-600 rounded-full py-2 hover:bg-gray-800 transition">
            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24"><path d="M12.152 6.896c-.948 0-2.415-1.078-3.96-1.04-2.04.027-3.91 1.183-4.961 3.014-2.117 3.675-.546 9.103 1.519 12.09 1.013 1.454 2.208 3.09 3.792 3.039 1.52-.065 2.09-.987 3.935-.987 1.831 0 2.35.987 3.96.948 1.637-.026 2.676-1.48 3.676-2.948 1.156-1.688 1.636-3.325 1.662-3.415-.039-.013-3.182-1.221-3.22-4.857-.026-3.04 2.48-4.494 2.597-4.559-1.429-2.09-3.623-2.324-4.39-2.376-2-.156-3.675 1.09-4.61 1.09zM15.53 3.83c.843-1.012 1.4-2.427 1.245-3.83-1.207.052-2.662.805-3.532 1.818-.78.896-1.454 2.338-1.273 3.714 1.338.104 2.715-.688 3.559-1.701z"/></svg>
            <span class="text-white text-sm">Continue with Apple</span>
        </button>
    </div>

    <!-- Divider -->
    <div class="relative flex items-center mb-6">
        <div class="flex-grow border-t border-gray-700"></div>
        <span class="flex-shrink mx-4 text-gray-500 text-xs">Or</span>
        <div class="flex-grow border-t border-gray-700"></div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label class="block text-white text-xs font-bold mb-2">Username</label>
            <input type="email" name="email" placeholder="Masukkan nama Anda" 
                class="w-full bg-transparent border border-gray-700 rounded-full py-2 px-4 text-gray-400 text-sm focus:outline-none focus:border-[#EAB308]">
        </div>

        <div class="mb-4">
            <label class="block text-white text-xs font-bold mb-2">Password</label>
            <input type="password" name="password" placeholder="Masukkan password Anda" 
                class="w-full bg-transparent border border-gray-700 rounded-full py-2 px-4 text-gray-400 text-sm focus:outline-none focus:border-[#EAB308]">
        </div>

        <p class="text-[10px] text-gray-500 mb-6">
            Belum punya akun? Daftar di sini <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
        </p>
    </form>
</x-guest-layout>