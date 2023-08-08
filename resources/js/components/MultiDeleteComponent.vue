<template>
     <!-- <a  href="#" v-on:click.prevent="deleteRecord($event,title,message,'deleted', url)"
        class="dc-deleteinfo" :id="id">
        <i class="lnr lnr-trash"></i>
    </a> -->

    <a href="#" @click="deleteChecked($event,title,message,'deleted', url, redirect_url)" class="dc-skilldel" :id="id">
        <i class="lnr lnr-trash"></i>
        <span>{{ trans('lang.del_all_selected_rec') }}</span>
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
        deleteChecked: function (event, delete_title, delete_message, deleted, delete_url, redirect_url) {
                var element = event.currentTarget;
                this.elementID = element.getAttribute('id');
                var deleteIDs = jQuery('#checked-val input:checkbox:checked').map(function () {
                    return jQuery(this).val()
                }).get()
                console.log(deleteIDs);
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
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        var element_id = element.getAttribute('id');
                        axios.post(delete_url, {
                            ids: deleteIDs
                        })
                        .then(function (response) {
                            if (response.data.type == 'success') {
                                setTimeout(function () {
                                    self.$swal({
                                        title: this.title,
                                        text: text,
                                        type: 'success'
                                    })
                                    jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                                }, 500)
                                window.location.replace(redirect_url)
                            } else {
                                self.showError(response.data.message);
                            }
                        })
                    } else {
                        this.$swal.close()
                    }
                  })
            },
    },
    mounted:function(){},
    created() {

    },
}
</script>
