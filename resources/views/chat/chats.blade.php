<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('chat') }}

        </h2>
    </x-slot>

    <div id="frame">
        <div class="contact">
            <div class="chat-contact">
                <ul>
                    @if($contacts->count())
                        @foreach($contacts as $contact)
                            <li>
                                <a href="{{ asset('contact/'.$contact->id) }}">
                                    <div class="chat-image">
                                        <img @if(!empty($contact->accounts[0]->avatar)) src="/images/{{ $contact->accounts[0]->avatar }}"
                                             @else src="/images/us.png" @endif alt="">
                                    </div>
                                    <div class="chat-text">
                                        {{ $contact->name }}
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <div class="content">
        </div>
    </div>
</x-app-layout>

