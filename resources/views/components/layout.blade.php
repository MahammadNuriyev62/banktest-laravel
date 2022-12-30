<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: '#ef3b2d',
                    },
                },
            },
        }
    </script>
    <title>Document</title>
</head>

<body class="h-screen flex flex-col w-screen">
    <x-status-handler />
    <nav class="bg-gray-800">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="flex flex-1 items-center items-stretch justify-start">
                    {{-- <div class="flex flex-shrink-0 items-center">
                        <img class="block h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company">
                    </div> --}}
                    <div class="ml-6 block">
                        <div class="flex space-x-4">
                            <x-header-child href='/questions'>Questions</x-header-child>
                            <x-header-child href='/questions/create'>Create
                                Question</x-header-child>
                            <x-header-child href='/about'>About
                                Project</x-header-child>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <main class="w-full flex-1">
        {{ $slot }}
    </main>
</body>

</html>
