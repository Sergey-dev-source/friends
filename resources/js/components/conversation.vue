<template>
  <div class="conversation">

    <div class="chat-name">
      <h1 v-if="contact_name != '' ">{{ contact_name }}</h1>
      <h1 v-else>please entry contact</h1>
      <div v-if="write && selected == writeContact" class="write">write</div>
    </div>
    <ChatBody :messages="messages" :user="user" :selected="selected" />
    <ChatMessage :user="user" :selected="selected" @new="newMessage"/>

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
    },
    messages: {
      type:Array
    }
  },
  data() {
    return {
      selectContact: null,
      write: false,
      writeContact: ''
    }
  },
  mounted() {
    Echo.private(`write.${this.user.id}`)
        .listen(`Write`, (e) => {
          this.w(e.write);
        });
  },
  methods: {
    newMessage(m) {
      this.$emit('new' , m);
    },
    w(e) {
      this.writeContact = e;
      this.write = true;
      setTimeout(()=>{
        this.write = false;
      },500)
    }
  }
}
</script>

<style>
.conversation {
  width: 70%;
  display: flex;
  height: 100%;
  flex-direction: column;
  justify-content: space-between;
}

.chat-name {
  width: 100%;
  background-color: black;
  display: flex
}

.chat-name h1 {
  color: white;
  padding-left: 20px;
  text-transform: capitalize;
  font-size: 25px;
  line-height: 42px;
  margin-top: 6px;
}
.write{
  color: #f1f1f1;
  margin-left: 50px;
  line-height: 52px;
  text-transform: capitalize;
}
</style>
