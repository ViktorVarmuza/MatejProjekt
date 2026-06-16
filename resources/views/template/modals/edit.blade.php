@php
$url = route($route);

if (!empty($querry)) {
$url .= '?' . http_build_query($querry);
}
@endphp

<div id="edit-modal-{{ $id }}" tabindex="-1" aria-hidden="true"
    class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto h-[calc(100%-1rem)] max-h-full bg-gray-900/50 backdrop-blur-sm">

    <div class="relative w-full max-w-2xl max-h-full mx-auto mt-10">

        <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

            {{-- HEADER --}}
            <div class="flex items-center justify-between p-5 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <i class="fa-solid fa-pen text-yellow-500"></i>
                    Editace ročníku - {{ $race->real_name }}
                </h3>

                <button type="button" data-modal-hide="edit-modal-{{ $id }}"
                    class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 p-2 rounded-lg transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            {{-- BODY --}}
            <form method="POST"
                action="{{ $url }}"
                enctype="multipart/form-data"
                class="p-6 space-y-6">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    {{-- MAIN RACE NAME (FLOATING LABEL + READONLY) --}}
                    <div class="sm:col-span-2 relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <i class="fa-solid fa-folder"></i>
                        </div>
                        <input type="text" id="main_race_{{ $id }}"
                            value="{{ $raceName ?? 'Závod' }}"
                            class="peer bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full pl-10 p-2.5 pt-5 cursor-not-allowed"
                            readonly placeholder=" ">

                        <input type="hidden" name="id" value="{{ $id ?? '' }}">

                        <label for="main_race_{{ $id }}"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-10 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Hlavní závod
                        </label>
                    </div>

                    {{-- EDITION/REAL NAME (FLOATING LABEL) --}}
                    <div class="sm:col-span-2 relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                            <i class="fa-solid fa-flag-checkered"></i>
                        </div>
                        <input type="text" name="real_name" id="real_name_{{ $id }}"
                            value="{{ $race->real_name }}"
                            class="peer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 pt-5 transition-shadow focus:shadow-sm"
                            placeholder=" " required>
                        <label for="real_name_{{ $id }}"
                            class="absolute text-sm text-gray-500 duration-300 transform -translate-y-3 scale-75 top-4 z-10 origin-[0] left-10 peer-focus:text-blue-600 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-3">
                            Název tohoto ročníku
                        </label>
                    </div>

                    {{-- START DATE --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Začátek závodu</label>
                        <input type="date" name="start_date" id="start_date_{{ $id }}"
                            value="{{ \Carbon\Carbon::parse($race->start_date)->format('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    {{-- END DATE --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Konec závodu</label>
                        <input type="date" name="end_date" id="end_date_{{ $id }}"
                            value="{{ \Carbon\Carbon::parse($race->end_date)->format('Y-m-d') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    </div>

                    {{-- YEAR --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-400">Rok ročníku</label>
                        <input type="number" name="year" id="year_{{ $id }}"
                            value="{{ $race->year }}"
                            class="bg-gray-100 border border-gray-300 text-gray-500 text-sm rounded-lg block w-full p-2.5 cursor-not-allowed"
                            readonly placeholder="Vyplní se automaticky">
                    </div>

                    {{-- SEX --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Kategorie (Pohlaví)</label>
                        <select name="sex" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            <option value="M" {{ ($race->sex ?? '') === 'M' ? 'selected' : '' }}>Muži (M)</option>
                            <option value="W" {{ ($race->sex ?? '') === 'W' ? 'selected' : '' }}>Ženy (W)</option>
                        </select>
                    </div>

                    {{-- UCI TOUR SELECT --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">UCI Tour</label>
                        <select name="uci_tour" id="uci_tour_{{ $id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="" disabled>Vyberte sérii...</option>
                            @foreach($modalData['uciTourTypes'] as $tour)
                            <option value="{{ $tour->id }}" {{ $race->uci_tour_type_id == $tour->id ? 'selected' : '' }}>
                                {{ $tour->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- COUNTRY SELECT --}}
                    <div>
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Pořadatelská země</label>
                        <select name="country" id="country_{{ $id }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            <option value="" disabled>Vyberte zemi...</option>
                            @foreach($modalData['countries'] as $country)
                            <option value="{{ $country['alpha2'] }}" {{ strtolower($race->country) == strtolower($country['alpha2']) ? 'selected' : '' }}>
                                {{ $country['name'] }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- LOGO UPGRADE --}}
                    <div class="sm:col-span-2">
                        <label class="block mb-1.5 text-sm font-medium text-gray-700">Logo ročníku</label>
                        <div class="flex items-center gap-4 w-full">

                            {{-- Preview Box --}}
                            <div id="previewContainer_{{ $id }}" class="flex-shrink-0 w-24 h-24 rounded-xl border border-gray-200 bg-gray-50 flex items-center justify-center overflow-hidden relative">
                                @if($race->logo)
                                <img id="logoPreview_{{ $id }}" src="{{ asset('logos/' . $race->logo) }}" class="w-full h-full object-contain p-1" alt="Logo">
                                <div id="previewPlaceholder_{{ $id }}" class="text-gray-300 flex flex-col items-center hidden">
                                    <i class="fa-solid fa-image text-2xl"></i>
                                </div>
                                @else
                                <img id="logoPreview_{{ $id }}" src="" class="hidden w-full h-full object-contain p-1" alt="Logo">
                                <div id="previewPlaceholder_{{ $id }}" class="text-gray-300 flex flex-col items-center">
                                    <i class="fa-solid fa-image text-2xl"></i>
                                </div>
                                @endif
                            </div>

                            {{-- Input Upload Box --}}
                            <div class="flex-grow">
                                <label for="logoInput_{{ $id }}" class="flex flex-col items-center justify-center w-full h-24 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors">
                                    <div class="flex flex-col items-center justify-center pt-4 pb-4 px-2 text-center">
                                        <i class="fa-solid fa-cloud-arrow-up text-gray-400 text-xl mb-1"></i>
                                        <p class="text-xs text-gray-500 font-medium"><span class="font-semibold text-blue-600">Klikněte pro změnu</span> nebo přetáhněte soubor</p>
                                        <p class="text-[10px] text-gray-400 mt-0.5">PNG, JPG nebo SVG (max. 2MB)</p>
                                    </div>
                                    <input type="file" name="logo" id="logoInput_{{ $id }}" class="hidden" accept="image/*">
                                </label>
                            </div>

                        </div>
                    </div>

                    {{-- DESCRIPTION TEXTAREA (WITH TINYMCE) --}}
                    <div class="sm:col-span-2" style="margin-bottom: 15px;">
                        <label for="textarea_{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">Popis ročníku</label>
                        <textarea id="textarea_{{ $id }}" name="description" rows="4"
                            class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 transition-shadow focus:shadow-sm"
                            placeholder="Zde napište podrobný popis ročníku...">{!! $race->description ?? '' !!}</textarea>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" data-modal-hide="edit-modal-{{ $id }}"
                        class="px-4 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                        Zrušit
                    </button>

                    <button type="submit"
                        class="px-5 py-2.5 text-sm font-medium text-white bg-yellow-500 rounded-lg hover:bg-yellow-600 transition-colors shadow-sm shadow-yellow-100">
                        <i class="fa-solid fa-floppy-disk mr-1.5"></i> Uložit změny
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<script>
    (function() {
        const id = "{{ $id }}";
        const textareaId = `textarea_${id}`;

        function initRow() {
            const startInput = document.getElementById(`start_date_${id}`);
            const endInput = document.getElementById(`end_date_${id}`);
            const yearInput = document.getElementById(`year_${id}`);
            const logoInput = document.getElementById(`logoInput_${id}`);
            const logoPreview = document.getElementById(`logoPreview_${id}`);
            const previewPlaceholder = document.getElementById(`previewPlaceholder_${id}`);
            const modalElement = document.getElementById(`edit-modal-${id}`);

            // --- Náhled obrázku ---
            if (logoInput) {
                logoInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (!file) return;
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (logoPreview) {
                            logoPreview.src = e.target.result;
                            logoPreview.classList.remove('hidden');
                        }
                        if (previewPlaceholder) previewPlaceholder.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                });
            }

            // --- Datumy + automatický rok ---
            function handleDateChange() {
                const startVal = startInput.value;
                const endVal = endInput.value;
                if (startVal) {
                    yearInput.value = startVal.split('-')[0];
                    endInput.min = startVal;
                    if (endVal && endVal < startVal) endInput.value = startVal;
                } else {
                    yearInput.value = '';
                    endInput.min = '';
                }
            }

            if (startInput && endInput) {
                startInput.addEventListener('change', handleDateChange);
                endInput.addEventListener('change', handleDateChange);
                handleDateChange();
            }

            // --- TinyMCE Konfigurace (převzato z tvého zadání) ---
            // Hledej v Blade šabloně toto místo a uprav ho:
            const tinyConfig = {
                height: 250,
                menubar: false,

                // --- TYTO DVA ŘÁDKY VYŘEŠÍ ZOBRAZENÍ A BOLD PŘI SELF-HOSTED ---
                skin: false,
                content_css: false,
                // -------------------------------------------------------------

                plugins: 'lists link image charmap preview anchor searchreplace visualblocks code fullscreen table wordcount',
                toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat',
                language: 'cs',
                license_key: 'gpl',
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            };

            // Pomocná funkce pro bezpečné spuštění TinyMCE
            function initTinyEditor() {
                if (typeof tinymce !== 'undefined') {
                    if (!tinymce.get(textareaId)) {
                        tinymce.init({
                            ...tinyConfig,
                            selector: `#${textareaId}`
                        });
                    }
                }
            }

            // Pomocná funkce pro zničení editoru (prevence duplicity při zavření)
            function destroyTinyEditor() {
                if (typeof tinymce !== 'undefined') {
                    const instance = tinymce.get(textareaId);
                    if (instance) {
                        instance.destroy();
                    }
                }
            }

            // --- Flowbite / Custom Eventy pro otevírání modalu ---
            // Poněvadž Flowbite přepíná třídu .hidden, vytvoříme MutationObserver,
            // který bezpečně pozná, kdy se modal opravdu zviditelnil.
            if (modalElement) {
                const observer = new MutationObserver(function(mutations) {
                    mutations.forEach(function(mutation) {
                        if (mutation.attributeName === 'class') {
                            const isHidden = modalElement.classList.contains('hidden');
                            if (!isHidden) {
                                // Modal se otevřel -> Inicializujeme TinyMCE s drobným zpožděním
                                setTimeout(initTinyEditor, 100);
                            } else {
                                // Modal se zavřel -> Zničíme instanci
                                destroyTinyEditor();
                            }
                        }
                    });
                });

                observer.observe(modalElement, {
                    attributes: true
                });

                // Pojistka pro případ, že modal byl načten rovnou jako otevřený
                if (!modalElement.classList.contains('hidden')) {
                    setTimeout(initTinyEditor, 100);
                }
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initRow);
        } else {
            initRow();
        }
    })();
</script>