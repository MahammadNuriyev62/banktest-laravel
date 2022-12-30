@php
    $id = $id ?? (request()->id ?? (old('id') ?? null));
    $mode = $mode ?? (request()->mode ?? (old('mode') ?? 'create'));
    $type = $type ?? (request()->type ?? (old('type') ?? null));
    $body = $body ?? (request()->body ?? (old('body') ?? null));
    $answers = $answers ?? (session('answers') ?? (old('answers') ?? []));
    $answer =
        count($answers) > 0
            ? $answers[0]
            : [
                'body' => '',
                'result' => '1',
            ];
    $answerBody = $answer['body'] ?? '';
@endphp
<x-layout>
    <x-form-layout>
        <form method="POST" action={{ $mode == 'edit' ? '/questions/' . $id : '/questions' }} enctype="multipart/form-data">
            @csrf
            @if ($mode == 'edit')
                @method('PUT')
            @endif
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Question Body
                </label>
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" placeholder="Example: What is the best way to learn Laravel?" name="body" value="{{ $body }}" />
                @error('body')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                    Question Type
                </label>
                <div class="relative">
                    <select name="type" {{ $mode == 'edit' ? 'disabled' : '' }}
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="type-input">
                        <option {{ $type ? '' : 'selected' }} value={{ null }}>---</option>
                        @foreach ($types as $type_option)
                            <option {{ $type == $type_option ? 'selected' : '' }} value="{{ $type_option }}">
                                {{ ucfirst($type_option) }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mb-6">
                @if ($type)
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-password">
                        Answer
                    </label>
                @endif
                @if ($type == 'textarea')
                    <input name="answers[0][result]" class="hidden answer-result" value="1" type="number">
                    <textarea name="answers[0][body]" id="message" rows="4"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        placeholder="Example: The best way to learn Laravel is to learn by practise!">{{ $answerBody }}</textarea>
                @elseif ($type == 'text')
                    <input name="answers[0][result]" class="hidden answer-result" value="1" type="number">
                    <input name="answers[0][body]"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        type="text" placeholder="Example: What is the best way to learn Laravel?" value="{{ $answerBody }}" />
                @elseif ($type == 'radio' || $type == 'checkbox')
                    <div>
                        <div id="answers_container">
                            @foreach ($answers as $answer)
                                <x-answer index="{{ $loop->index }}" placeholder="Option {{ $loop->index }}..." body="{{ $answer['body'] }}" result="{{ $answer['result'] }}" />
                            @endforeach
                        </div>
                        @if ($mode == 'create')
                            <div class="relative w-full flex">
                                <input type="search" id="search-dropdown" disabled
                                    class="flex-1 appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded-l py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                                    placeholder="Option...">
                                <button type="button" id="add-answer"
                                    class="p-3 text-sm h-full font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 ">
                                    +
                                </button>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
            <div class="mb-6">
                <button class="bg-green-600 text-white rounded py-2 px-4 hover:bg-green-800">
                    {{ $mode = 'edit' ? 'Update Question' : 'Create Question' }}
                </button>
                <a href="/questions" class="text-black ml-4">Back</a>
            </div>
        </form>
    </x-form-layout>
</x-layout>
<script defer>
    const getAnswerButtonSelector = (index) => `#answers_container .answer:eq(${index}) .answer-button`;
    const getAnswerInputResultSelector = (index) => `#answers_container .answer:eq(${index}) .answer-result`;
    const checkIfAnswerIsCorrect = (index) => $(getAnswerInputResultSelector(index)).attr('value') !== '0';
    const paintButtonToGreen = (index) => {
        $(getAnswerButtonSelector(index)).addClass('bg-green-700').addClass('border-green-700').html('Correct');
    }
    const unpaintButtonFromGreen = (index) => {
        $(getAnswerButtonSelector(index)).removeClass('bg-green-700').removeClass('border-green-700').html('Incorrect');
    }
    $(document).ready(function() {
        const type = $('#type-input').val();
        const bindButtonLister = function(index) {
            $(getAnswerButtonSelector(index)).on('click', function() {
                const isCorrect = checkIfAnswerIsCorrect(index);
                const correctAnswerCount = $("#answers_container .answer .answer-result").map((i, e) => $(e).attr('value')).toArray()
                    .filter((e) => e === '1').length
                if (type === 'radio' && !isCorrect && correctAnswerCount > 0) {
                    return alert('You can only select one answer for radio type');
                }
                $(getAnswerInputResultSelector(index)).attr('value', isCorrect ? '0' : '1');
                isCorrect ? unpaintButtonFromGreen(index) : paintButtonToGreen(index);
            })
        };
        $('#add-answer').on('click', function() {
            const index = $('#answers_container').children().length;
            $('#answers_container').append(
                `<x-answer index="${index}" placeholder="Option ${index + 1}..." body="" result="0"/>`
            );
            bindButtonLister(index);
        })
        $('#type-input').on('change', function() {
            $('form').attr("method", "GET").attr("action", "/questions/create").submit();
        });
        $('#answers_container .answer').each(function(index) {
            bindButtonLister(index);
            if (checkIfAnswerIsCorrect(index)) {
                paintButtonToGreen(index);
            }
        });
    });
</script>
