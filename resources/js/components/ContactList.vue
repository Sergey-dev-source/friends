<template>
    <div class="contact-list">
        <ul>
            <li v-for="contact in contacts" :key="contact.id" @click="selectContact(contact)" :class="{ 'selected': select == contact.id }">
                <p class="name">{{ contact.name }}</p>
                <p class="email">{{ contact.email }}</p>
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
        methods: {
            selectContact(contact){
                this.$emit('selected',contact);
              axios.get("/messages/get/" + contact.id)
                  .then((response) => {
                    this.$emit('new',response.data);
                  });

            }
        }
    }
</script>
<style>
    .contact-list{
        width: 20%;
        border-left: solid 1px #000;
      overflow: auto;
    }
    .contact-list ul{
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .contact-list ul li {
        width: 100%;
        padding: 10px;
        border-bottom: 1px solid #000;
        cursor: pointer;
    }
    .name{
        margin: 0;
        text-transform: capitalize;
    }

    .email{
        margin: 0;
    }

    .selected {
        background-color: #2a9055;
    }
    .selected p{
        color: white;
    }
</style>
