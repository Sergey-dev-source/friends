<template>
  <div class="chat-app">
    <conversation :user="user" :messages="messages" :contact_name="contact_name" @new="newMessages1"
                  :selected="selected"/>
    <ContactList :contacts="contacts" :select="selected" @new="newMessages" @selected="userSelect"/>
  </div>
</template>

<script>
import ContactList from "./ContactList.vue";
import conversation from "./conversation.vue";

export default {
  components: {conversation, ContactList},
  props: {
    user: {
      type: Object,
      require: true
    }
  },
  data() {
    return {
      selected: null,
      contact_name: '',
      contacts: [],
      messages: []
    }

  },
  mounted() {
    {{ this.user.id }}
    Echo.private(`messages${this.user.id}`)
        .listen(`NewMessage`, (e) => {
          this.hanleIncoming(e.message);
        })
    axios.get('/contacts')
        .then((response) => {
          this.contacts = response.data;
        });

  },
  methods: {
    userSelect(contact) {
      this.selected = contact.id;
      this.contact_name = contact.name;
    },
    newMessages(mess) {
      this.messages = mess;
    },
    newMessages1(mess) {
      this.messages.push(mess);
    },
    hanleIncoming(message){
      if (this.selected && message.from == this.selected){
        this.newMessages(message);
      }
      alert(message.message)
    }
  }
}
</script>

<style>
.chat-app {
  display: flex;
  justify-content: space-between;
  height: 500px;
  overflow-y: hidden;
}
</style>
