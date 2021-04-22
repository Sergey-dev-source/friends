<template>
  <div class="chat-app">
    <conversation :user="user" :message="messages" :contact_name="contact_name" :selected="selected"/>
    <ContactList :contacts="contacts" :select="selected" @selected="userSelect"/>
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
    axios.get('/contacts')
        .then((response) => {
          this.contacts = response.data;
        });

  },
  methods: {
    userSelect(contact) {
      this.selected = contact.id;
      this.contact_name = contact.name;
      axios.get("/messages/get/" + contact.id)
          .then((response) => {
            this.messages.push(response.data);
          });
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
