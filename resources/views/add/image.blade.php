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
<div>
    <div>
        <h2>Enter telephone</h2>
        <div>
            <form action="{{ route('enter_image') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mt-4">
                    <label for="image"  />
                    <input id="image" class="block mt-1 w-full" type="file" name="image"  />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('verification.notice') }}">
                        {{ __('skip') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Add') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
