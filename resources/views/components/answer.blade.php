@props(['body', 'placeholder', 'index', 'result'])

<div class="relative w-full flex mb-3 answer">
    <input name="answers[{{$index}}][result]" class="hidden answer-result" value="{{$result}}" type="number">
    <input 
        class="flex-1 appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded-l py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 answer-value"
        placeholder="{{$placeholder}}"
        name="answers[{{$index}}][body]"
        value="{{$body}}">
    <div
        class="p-3 text-sm h-full font-medium text-white bg-red-700 rounded-r-lg border border-red-700 select-none cursor-pointer answer-button">
         Incorrect
    </div>
</div>