<div class="flex items-center justify-between p-4 mb-4 text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">

    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                  d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-9a1 1 0 012 0v3a1 1 0 11-2 0V9zm1 6a1.5 1.5 0 110-3 1.5 1.5 0 010 3z"
                  clip-rule="evenodd"></path>
        </svg>

        <span class="font-medium">Chyba!</span>
        <span class="ml-2">{{ session('error') }}</span>
    </div>

    <button type="button"
            onclick="this.parentElement.remove()"
            class="text-red-600 hover:text-red-900">
        ✕
    </button>
</div>

