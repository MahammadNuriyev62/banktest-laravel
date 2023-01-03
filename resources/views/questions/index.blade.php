<x-layout>
    <div class="w-full p-10 pb-24 h-full">
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
