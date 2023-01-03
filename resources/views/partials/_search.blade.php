<form action="/questions">
    <div class="relative w-full flex mb-5 answer">
        <input
            value="{{ request()->search }}"
            class="flex-1 text-lg appearance-none block bg-gray-200 text-gray-700 border border-gray-200 rounded-l py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500 answer-value"
            placeholder="search..." name="search">
        <button type="submit" class="p-3 text-lg h-full font-medium text-white bg-blue-500 rounded-r-lg border border-blue-500 select-none cursor-pointer answer-button">
            search
        </button>
    </div>
</form>
