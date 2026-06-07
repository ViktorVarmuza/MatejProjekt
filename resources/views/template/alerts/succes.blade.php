<div class="flex items-center justify-between p-4 mb-4 text-green-800 rounded-lg bg-green-50 border border-green-200"
    role="alert">

    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.172 7.707 8.879a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                clip-rule="evenodd"></path>
        </svg>

        <span class="font-medium">Úspěch!</span>
        <span class="ml-2">{{ session('success') }}</span>
    </div>

    <button type="button"
        onclick="this.parentElement.remove()"
        class="text-green-600 hover:text-green-900">
        ✕
    </button>

</div>