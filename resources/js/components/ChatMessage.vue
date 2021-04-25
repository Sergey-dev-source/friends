<template>
  <div class="chat-message">
    <div class="sender" v-if="selected">
      <input type="text" v-model="message" v-on:keyup="write(selected,user.id)" class="sen_inp">
      <button v-on:click="sendMessage">
        send
      </button>

    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      require: true
    },
    selected: {
      require: true
    }
  },
  data() {
    return {
      message: '',
      select: 0,
    }
  },

  methods: {
    sendMessage() {
      if (this.selected == null || this.message == '') {
        return;
      }
      axios.post('/message/create', {
        contact_id: this.selected,
        message: this.message
      })
          .then((response) => {
            this.$emit('new', response.data);
          })

      this.message = '';
    },
    write(id,user_id) {
      axios.post('/write', {
        a: id,
        b: user_id
      })
          .then((response) => {

          })
    },

  },

}
</script>

<style>
.sender {
  width: 100%;

}

.sen_inp {
  width: 88%;
  padding: 5px;
  border: none;
  background-color: cadetblue;
  outline: none;
  color: white;
}

.sender button {
  padding: 4px 21px;
  border-radius: 10px;
  text-transform: capitalize;
}
</style>
