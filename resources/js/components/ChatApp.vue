<template>
  <div class="chat-app">
    <ContactList :contacts="contacts" :select="selected" @new="newMessages" @selected="userSelect"/>
    <conversation :user="user" :messages="messages" :contact_name="contact_name" @new="newMessages1"
                  :selected="selected"/>

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

    Echo.private(`messages.${this.user.id}`)
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
      this.UpdateUnreadCount(contact.id,true);
    },
    newMessages(mess) {

      this.messages = mess;


    },
    newMessages1(mess) {
      this.messages.push(mess);
    },
    hanleIncoming(message) {
      if (this.selected && message.from == this.selected) {
        this.newMessages1(message);
        return;
      }
      this.UpdateUnreadCount(message.fromContact,false);
    },
    UpdateUnreadCount(contact, reset) {
      this.contacts = this.contacts.map((single) => {
        if (single.id != contact) {
          return single;
        }

        if (reset)
          single.unread = 0;

        else {
          single.unread += 1;
          alert('ok');
        }
        return single;
      })
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
