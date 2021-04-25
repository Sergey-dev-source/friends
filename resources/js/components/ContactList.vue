<template>
  <div class="contact-list">
    <ul>
      <li v-for="contact in sortedContacts" :key="contact.id" @click="selectContact(contact)"
          :class="{ 'selected': select == contact.id }">
        <p class="name">{{ contact.name }}</p>
        <p class="email">{{ contact.email }}</p>
        <span class="read" v-if="contact.unread">{{ contact.unread }}</span>
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  props: {
    contacts: {
      type: Array,
      require: true
    },
    select: {
      default: 0
    }
  },
  data(){
    return{
      selected: this.contacts.length ? this.contacts[0] : null
    }
  },
  methods: {
    selectContact(contact) {
      this.selected = contact;
      this.$emit('selected', contact);
      axios.get("/messages/get/" + contact.id)
          .then((response) => {
            this.$emit('new', response.data);
          });

    }
  },
  computed: {
    sortedContacts() {
      return _.sortBy(this.contacts,[(contact)=>{
        if (contact == this.selected){
          return Infinity;
        }
        return contact.unread;
      }]).reverse();
    }
  }
}
</script>
<style>
.contact-list {
  width: 30%;
  border-left: solid 1px #000;
  overflow: auto;
}

.contact-list ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.contact-list ul li {
  width: 100%;
  padding: 10px;
  border-bottom: 1px solid #000;
  cursor: pointer;
  position: relative;
}

.name {
  margin: 0;
  text-transform: capitalize;
}

.email {
  margin: 0;
}

.selected {
  background-color: #2a9055;
}

.selected p {
  color: white;
}

.read {
  position: absolute;
  padding: 0px 10px;
  background: red;
  border-radius: 10px;
  font-size: 20px;
  font-weight: bold;
  color: white;
  right: 10px;
  top: 12px;
}
</style>
