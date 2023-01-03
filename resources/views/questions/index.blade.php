<x-layout>
    <div class="w-full p-10 pb-24 h-full self-center" x-data="{ modal: false, action: null }">
        <div x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-show="modal"
            id="popup-modal" tabindex="-1" class="fixed top-0 left-0 right-0 z-50 p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full hidden" @keydown.window="modal=false">
            <div class="relative w-full h-full max-w-md md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button" @click="modal=false"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-hide="popup-modal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-6 text-center">
                        <svg aria-hidden="true" class="mx-auto mb-4 text-gray-400 w-14 h-14 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to delete this question?</h3>
                        <form method="POST" x-bind:action="action" class="inline-flex">
                            @csrf
                            @method('DELETE')
                            <button data-modal-hide="popup-modal" type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm items-center px-5 py-2.5 text-center mr-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button @click="modal=false" data-modal-hide="popup-modal" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
        @include('partials._search')
        @if (count($questions) != 0)
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="border border-slate-700 p-1 w-32">Question</th>
                        <th class="border border-slate-700 p-1">Body</th>
                        <th class="border border-slate-700 p-1">Type</th>
                        <th class="border border-slate-700 p-1 w-32">View</th>
                        <th class="border border-slate-700 p-1 w-32">Edit</th>
                        <th class="border border-slate-700 p-1 w-32">Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($questions as $question)
                        <x-question-card :question="$question" :index="$loop->index" />
                    @endforeach
                </tbody>
            </table>
        @elseif(request()->search)
            <x-form-layout>
                <h1 class="text-2xl text-center">No results found for "{{ request()->search }}"</h1>
            </x-form-layout>
        @else
            <x-form-layout>
                <h1 class="text-2xl text-center">There are no questions yet...</h1>
            </x-form-layout>
        @endif
    </div>
    <div class="p-4 bottom-0 fixed w-full">
        {{ $questions->links() }}
    </div>
</x-layout>
<script>
    $(document).ready(function() {
        $('#popup-modal').removeClass('hidden');
    });
</script>