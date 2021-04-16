<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Image') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Image</h2>
                    <div class="p-6 bg-white border-b border-gray-200" style="display: block">
                        <form action="{{ route('img') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="image" >
                            <x-button class="ml-4">
                                {{ __('Add') }}
                            </x-button>
                        </form>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Image</h2>
                    <div class="flex items-center mt-4">
                        @foreach($images as $img)
                            <div class="img_block">
                                <img src="images/{{ $img['name'] }}" width="200" alt="err">
                                <div class="sel_img">
                                    <form action="{{ route('se_img') }}" method="post">
                                        @csrf
                                        <input type="hidden" name="i" value="{{ $img['name'] }}">
                                        <x-button class="ml-4">
                                            {{ __('Select avatar') }}
                                        </x-button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
