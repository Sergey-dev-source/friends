<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>

<div class="py-12">

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fill in account') }}
        </h2>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 ">
                <form action="{{ route('enter_telephone') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <x-label for="country" :value="__('Country')" />

                        <x-input id="country" class="block mt-1 w-full" type="text" name="country"  />
                    </div>
                    <div>
                        <x-label for="sity" :value="__('Sity')" />

                        <x-input id="sity" class="block mt-1 w-full" type="text" name="sity"   />
                    </div>
                    <div>
                        <x-label for="age" :value="__('Age')" />
                        <x-input id="age" class="block mt-1 w-full" type="number" name="age"  />
                    </div>
                    <div>
                        <x-label :value="__('Gender')" />
                        <div class="flex" style="margin: 10px 0;">
                            <div class="flex mr-1">
                                <input id="male" class="inline-grid mr-1" type="radio" name="gender" value="male" />
                                <x-label for="male" :value="__('Male')" />
                            </div>
                            <div class="flex ml-1">
                                <input id="female" class="block mr-1 " type="radio" name="gender" value="female" />
                                <x-label for="female" :value="__('Female')" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <x-label for="about" :value="__('About')" />

                        <x-input id="about" class="block mt-1 w-full" type="text" name="about"  />
                    </div>
                    <div>
                        <x-label for="phone" :value="__('Phone')" />

                        <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('skip') }}">
                            {{ __('skip') }}
                        </a>
                        <x-button class="ml-4">
                            {{ __('Create') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
