<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 flex bg-white border-b border-gray-200">
                    <div class="block2">
                        <div class="im">
                            <img src="/images/{{ $users->accounts[0]->avatar }}" alt="">
                        </div>
                    </div>
                    <div class="block1">
                        <div class="tt">
                            <ul class="flex">
                                <li><a href="#">friends</a></li>
                                <li><a href="#">groups</a></li>
                                <li><a href="{{ route('status') }}">status</a></li>
                            </ul>
                        </div>
                        <div class="tt">
                            <h1 class="font-semibold text-xl text-gray-800 leading-tight">{{ $users->name }}</h1>
                            <h4>{{ $users->accounts[0]->age }} <small>year</small></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
