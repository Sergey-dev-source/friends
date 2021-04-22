<template>
    <div class="chat-body">
        <ul>
            <li v-for="message in messages" :key="message.id"  >
                {{ message.message }}
            </li>{{ messages }}
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            messages: {
                type: Array,
                default: []
            }
        }
    }
</script>
