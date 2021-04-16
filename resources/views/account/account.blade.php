<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 ">
                    <form action="{{ route('edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-label for="country" :value="__('Country')" />

                            <x-input id="country" class="block mt-1 w-full" type="text" name="country" value="{{ $account->country }}" />
                        </div>
                        <div>
                            <x-label for="sity" :value="__('Sity')" />

                            <x-input id="sity" class="block mt-1 w-full" type="text" name="sity" value="{{ $account->sity }}"  />
                        </div>
                        <div>
                            <x-label for="age" :value="__('Age')" />
                            <x-input id="age" class="block mt-1 w-full" type="number" name="age" value="{{ $account->age }}"  />
                        </div>
                        <div>
                            <x-label :value="__('Gender')" />
                            <div class="flex" style="margin: 10px 0;">
                                @if($account->gender == 'male')
                                    <?php $male = 'checked' ?>
                                @else
                                    <?php $male = '' ?>
                                @endif

                                <div class="flex mr-1">
                                    <input id="male" class="inline-grid mr-1" type="radio" name="gender" value="male" {{ $male }} />
                                    <x-label for="male" :value="__('Male')" />
                                </div>
                                    @if($account->gender == 'female')
                                        <?php $female = 'checked' ?>
                                    @else
                                        <?php $female = '' ?>
                                    @endif
                                <div class="flex ml-1">
                                    <input id="female" class="block mr-1 " type="radio" name="gender" value="female" {{ $female }} />
                                    <x-label for="female" :value="__('Female')" />
                                </div>
                            </div>
                        </div>
                        <div>
                            <x-label for="about" :value="__('About')" />

                            <x-input id="about" class="block mt-1 w-full" type="text" name="about" value="{{ $account->about }}" />
                        </div>
                        <div>
                            <x-label for="phone" :value="__('Phone')" />

                            <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" value="{{ $account->phone }}" />
                        </div>
                        <div>
                            <x-label for="about" :value="__('image')" />

                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" />
                            <img src="/images/{{ $account->avatar }}" width="100" style="margin: 20px 0" height="100" alt="">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Edit') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
