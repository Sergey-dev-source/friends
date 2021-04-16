<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('chat') }}

        </h2>
    </x-slot>

    <div id="frame">
        <div class="content">
            <div class="contact-profile">
                <img src="/images/{{ $cont->accounts[0]->avatar }}" alt=""/>
                <p>{{ $cont->name }}</p>

            </div>
            <div class="messages">
                <ul>
                    @foreach($mess as $m)
                        @if($m->from == Auth::id())
                            <li class="replies">
                                <p>{{ $m->message }}</p>

                            </li>
                        @else
                            <li class="sent">
                                <p>{{ $m->message }}</p>

                            </li>
                        @endif
                    @endforeach
{{--                    <li class="sent">--}}
{{--                        <img src="http://emilcarlsson.se/assets/mikeross.png" alt=""/>--}}
{{--                        <p>What are you talking about? You do what they say or they shoot you.</p>--}}
{{--                    </li>--}}
{{--                    <li class="replies">--}}
{{--                        <img src="http://emilcarlsson.se/assets/harveyspecter.png" alt=""/>--}}
{{--                        <p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any--}}
{{--                            one of a hundred and forty six other things.</p>--}}
{{--                    </li>--}}
                </ul>
            </div>
            <div class="message-input">
                <div class="wrap">
                    <form action="{{ route('create_chat') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="to" value="{{ $cont->id }}">
                        <input type="text" name="message" placeholder="Write your message..."/>
                        <label for="ff"><i class="fa fa-paperclip attachment" aria-hidden="true"></i></label>
                        <input type="file" style="display: none" name="image" id="ff">
                        <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

