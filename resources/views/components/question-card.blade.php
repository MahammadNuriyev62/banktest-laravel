@props(['question', 'index', 'type'])

<div class="flex">
    <tr>
        <th class="border border-slate-700 p-1">{{ $index + 1 }}</th>
        <th class="border border-slate-700 p-1">{{ $question->body }}</th>
        <th class="border border-slate-700 p-1">{{ $question->type }}</th>
        <th class="border border-slate-700 p-1">
            <form method="GET" action="/questions/{{ $question->id }}">
                @csrf
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold w-full h-full" type="submit">Edit</button>
            </form>

        </th>
        <th class="border border-slate-700 p-1">
            <form method="POST" action="/questions/{{ $question->id }}">
                @csrf
                @method('DELETE')
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold w-full h-full" type="submit">Delete</button>
            </form>
        </th>
    </tr>
</div>
