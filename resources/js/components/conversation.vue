<template>
    <div class="conversation">

        <div class="chat-name">
            <h1 v-if="contact_name != '' ">{{ contact_name }}</h1>
            <h1 v-else>please entry contact</h1>
        </div>
        <ChatBody :messages="messages"/>
        <ChatMessage :user="user" :selected="selected" @new="newMessage" />

    </div>
</template>

<script>
import ChatMessage from "./ChatMessage.vue";
import ChatBody from "./ChatBody.vue";

export default {
    components: {ChatBody, ChatMessage},
    props: {
        user: {
            type: Object,
            require: true,
        },
        selected: {
            default: ''
        },
        contact_name: {
            default: ''
        }
    },
    data() {
        return {
            messages: [],
            selectContact: null,
        }
    },
    methods: {
        newMessage( m ){
            this.messages.push(m);
        }
    }
}
</script>

<style>
.conversation {
    width:80%;
    display: flex;
    height: 100%;
    flex-direction: column;
    justify-content: space-between;
}

.chat-name {
    width: 100%;
    background-color: black;
}

.chat-name h1 {
    color: white;
    padding-left: 20px;
    text-transform: capitalize;
    font-size: 25px;
    line-height: 42px;
    margin-top: 6px;
}
</style>
