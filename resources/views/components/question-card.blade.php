@props(['question', 'index', 'type'])

<div class="flex">
    <tr>
        <th class="border border-slate-700 p-1">{{ $index + 1 }}</th>
        <th class="border border-slate-700 p-1">{{ $question->body }}</th>
        <th class="border border-slate-700 p-1">{{ $question->type }}</th>
        <th class="border border-slate-700 p-1">
            <a href="/questions/{{ $question->id }}">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold w-full h-full" type="button">View</button>
            </a>
        </th>
        <th class="border border-slate-700 p-1">
            <a href="/questions/{{ $question->id }}/edit">
                <button class="bg-amber-600 hover:bg-amber-800 text-white font-bold w-full h-full" type="button">Edit</button>
            </a>
        </th>
        <th class="border border-slate-700 p-1">
            <button @click="modal=true; action='/questions/{{ $question->id }}'" class="bg-red-500 hover:bg-red-700 text-white font-bold w-full h-full" type="button">Delete</button>
        </th>
    </tr>
</div>
