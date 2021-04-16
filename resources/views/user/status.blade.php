<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">New Status</h2>
                    <div class="p-6 bg-white border-b border-gray-200" style="display: block">
                        <form action="{{ route('stat') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="text" name="status" >
                            <input type="file" name="image" >
                            <x-button class="ml-4">
                                {{ __('Add') }}
                            </x-button>
                        </form>
                    </div>
                </div>
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Status</h2>
                    <div class="mt-4">
                        @foreach($status as $stat)
                            <div>
                                @if(!empty($stat->name))
                                    <div>
                                        <img src="{{ $stat->name }}">
                                    </div>
                                @endif
                                <p>{{ $stat->status }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
