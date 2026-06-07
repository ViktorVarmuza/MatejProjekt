@php
    $url = route($route, ['id' => $id]);

    if (!empty($querry)) {
    $url .= '?' . http_build_query($querry);
    }
@endphp

<div id="delete-modal-{{ $id}}" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">

    <div class="relative w-full max-w-md max-h-full">

        <div class="relative bg-white rounded-lg shadow">

            <!-- HEADER -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-semibold text-gray-900">
                    Potvrzení smazání
                </h3>

                <button type="button" data-modal-hide="delete-modal-{{ $id }}"
                    class="text-gray-400 hover:text-gray-900">
                    ✕
                </button>
            </div>

            <!-- BODY -->
            <div class="p-6 text-gray-700">
                Opravdu chceš smazat tuto položku? Tato akce je nevratná.
            </div>

            <!-- FOOTER -->
            <div class="flex justify-end gap-2 p-4 border-t">

                <button data-modal-hide="delete-modal-{{ $id }}"
                    class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    Zrušit
                </button>

                <form method="POST" action="{{ $url }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                        Smazat
                    </button>
                </form>

            </div>

        </div>

    </div>
</div>