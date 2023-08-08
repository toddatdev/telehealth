<template>
    <a href="#" v-on:click.prevent="deleteRecord($event,title, message, 'deleted', url, redirect_url)"
        class="dc-deleteinfo" :id="id">
        <i class="lnr lnr-trash"></i>
    </a>
</template>
<script>
export default {
    props: ['title', 'message', 'id', 'url', 'redirect_url'],
    components: {

    },
    data: function () {
        return {
            error: {
                    position: "topRight",
                    timeout: 4000
                },
        }
    },
    methods: {
        showError(error){
            return this.$toast.error(' ', error, this.error);
        },
        deleteRecord: function (event, delete_title, delete_message, deleted, delete_url, redirect_url='') {
                var element = event.currentTarget;
                this.elementID = element.getAttribute('id');
                this.$swal({
                    title: delete_title,
                    type: "warning",
                    showCancelButton: true,
                    customClass: {
                        container: 'la-warning-popup',
                    },
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        var element_id = element.getAttribute('id');
                        axios.post(delete_url, {
                            id: element_id
                        })
                        .then(function (response) {
                            if (response.data.type == 'success') {
                                jQuery('.del-' + element_id).remove();
                                self.$swal(deleted, delete_message, 'success')
                                jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                                // setTimeout(function(){ 
                                // if(document.querySelector('.swal2-shown')){
                                //         jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                                //     }
                                // }, 1000);
                                if (redirect_url) {
                                    window.location.replace(redirect_url)
                                }
                            } else {
                                self.showError(response.data.message);
                            }
                        })
                    } else {
                        
                    }
                  })
            },
    },
    mounted:function(){
    },
    created() {

    },
}
</script>
