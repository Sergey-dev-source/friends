<template>
    <div class="chat-body" ref="feed">
        <ul>
            <li v-for="message in messages" :key="message.id" :class="{'right': message.to == selected}"  >
                {{ message.message }}
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            messages: {
                type: Array,
                default: []
            },
          selected:{
              default: ''
          }
        },
      methods: {
          scrollToBottom(){
            setTimeout(()=>{
              this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
            },50)
          }
      },
      watch: {
          messages(messages){
            this.scrollToBottom();
          }
      }
    }
</script>

<style>
  .chat-body{
    height: 80%;
    overflow: auto;
    width: 100%;
  }
  .right{
    margin-left: 50%!important;
    background-color: #4e555b!important;
    color: white!important;
  }

  .chat-body ul{
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .chat-body ul li{
    background-color: lavender;
    padding: 20px;
    max-width: 42%;
    margin: 20px 0;
    border-radius: 20px;
  }

</style>
