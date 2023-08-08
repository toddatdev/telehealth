<template>
  <div class="dc-chatpopup">
    <div class="dc-chatbox">
        <div class="dc-messages">
            <div v-for="(msg, index) in messages" :key="index" v-bind:class="[msg.type===1 ? 'dc-memessage dc-readmessage' : 'dc-offerermessage']">
                <figure v-if="image">
                    <img v-if="msg.type===1" :src="msg.by" :alt="image_name">
                    <img v-else :src="msg.image" :alt="image_name">
                </figure>
                <div class="dc-description">
                    <p>{{ msg.message }}</p>
                </div>
            </div>
        </div>
        <div class="dc-replaybox">
            <div class="form-group">
                <textarea class="form-control" name="reply" :placeholder="ph_new_msg" v-model="newmessage"></textarea>
            </div>
            <div class="dc-iconbox">
                <a href="javascript:void(0);" @click="sendMessage" class="dc-btnsendmsg">{{ trans('lang.btn_send') }}</a>
            </div>
        </div>
    </div>
    <a id="dc-getsupport" class="dc-themeimgborder"><img :src="this.receiver_profile_image" :alt="trans_image_alt"></a>
  </div>
</template>

<script>
import io from 'socket.io-client';
export default {
    props: ['receiver_id', 'receiver_profile_image', 'trans_image_alt', 'ph_new_msg', 'empty_error'],
    data() {
        return {
            user: Laravel.user.name,
            image:Laravel.user.image,
            image_name:Laravel.user.image_name,
            newmessage: '',
            messages: [],
            receiver: this.receiver_id,
            notificationSystem: {
                error: {
                    position: "topRight",
                    timeout: 4000
                }
            },
            //socket : io('localhost:3001')
        }
    },
    methods: {
        showError(error){
            return this.$toast.error(' ', error, this.notificationSystem.error);
        },
        sendMessage(e) {
            e.preventDefault();
            if (this.newmessage) {
                var self = this;
                //this.socket.emit('chat-message',{ message: this.newmessage, user_id: this.receiver, user: this.name, image: this.image })
                this.messages.push({ message: this.newmessage,image: this.image, type: 0, by: 'Me' })
                axios.post(APP_URL + '/message/send-private-message',{
                    author_id : Laravel.user.id,
                    receiver_id: self.receiver,
                    message: self.newmessage,
                    status: 0
                })
                .then(function (response) { })
                .catch(function (error) {});

                this.newmessage = null
            } else {
                this.showError(this.empty_error);
            }
        }
    },
    mounted() {
        let self = this;
        // this.socket.on('connected-users', function (data) {});
        jQuery('#dc-btnclosechat, #dc-getsupport').on('click', function () {
            jQuery('.dc-chatbox').slideToggle();
        });

    },
    created(){
        // this.socket.emit("add-user", {"userId": Laravel.user.id});
    }
}
</script>

<style>
</style>
