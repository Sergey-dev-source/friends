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
                            <li @if($cintactId == $contact->id) class="contact-active" @endif>
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
            <div class="contact-profile">
                {{--                <img src="/images/{{ $cont->accounts[0]->avatar }}" alt=""/>--}}
                {{--                <p>{{ $cont->name }}</p>--}}

            </div>
            <div class="messages">
                <ul>
                    @foreach($messages as $m)

                        <li @if($m->from == Auth::id()) class="replies" @else class="sent" @endif >
                            @if (!empty($m->message_file))
                                <?php $f = explode('.',$m->message_file); ?>
                                @if($f[1] == 'mp4')
                                        <video width="320" height="240" controls>
                                            <source src="{{ $m->message_file }}" type="video/mp4">
                                        </video>
                                    @else
                                <img src="{{ $m->message_file }}" alt="">
                                    @endif
                            @endif
                            @if(!empty($m->message))
                                <p>
                                    {{ $m->message }}
                                </p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="message-input">
                <div class="wrap">
                    <form action="{{ route('create_chat') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="to" value="{{ $cintactId }}">
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

