<template>
    <div>
        <div class="dc-education-holder dc-aboutinfo">
            <div class="dc-infotitle">
                <h3>{{ this.title }}</h3>
            </div>
            <ul class="dc-expandedu">
                <li v-for="(showposts, index) in showposts" :key="index" v-if = "items[index]">
                    <span v-if="items[index].company_title">{{ items[index].company_title }}
                        <em v-if="items[index].start_date || items[index].end_date">( {{ items[index].start_date }} - {{ items[index].end_date }} )</em>
                    </span>
                    <em v-if="items[index].job_title">{{ items[index].job_title }}
                    (<a href="javascript:void(0);" @click="showModal(modal_ref+'-'+index)">{{ trans('lang.view_details') }}</a>)</em>
                    <b-modal :ref="modal_ref+'-'+index" hide-footer :title="modal_title" v-cloak>
                        <div class="d-block text-left">
                            <div class="wt-formtheme wt-formfeedback">
                                <ul class="dc-expandedu">
                                    <li>
                                        <span><strong>{{ trans('lang.company_title') }}:</strong><em> {{ items[index].company_title }}</em></span>
                                    </li>
                                    <li>
                                        <span><strong>{{ trans('lang.job_title') }}:</strong><em> {{ items[index].job_title }}</em></span>
                                    </li>
                                    <li>
                                        <span><strong>{{ trans('lang.desc') }}:</strong></span>
                                        <p>{{ items[index].job_desc }}</p>
                                    </li>
                                </ul>
                            </div>
                            </div>
                    </b-modal>
                </li>
                <li><a href="javascript:void(0);" @click="showposts += 3" v-if="showposts < items.length">{{ trans('lang.more') }}</a></li>
            </ul>

        </div>
    </div>
</template>
<script>
    export default{
        props: ['no_of_post', 'modal_ref', 'url', 'doctor_id', 'modal_title', 'title'],
        data() {
            return {
                items: [],
                showposts: this.no_of_post,
                ref: this.modal_ref,
            }
        },
        methods: {
            getItems() {
                let self = this;
                axios.post(APP_URL + this.url, {
                    doctor_id: self.doctor_id
                })
                .then(function (response) {
                    self.items = response.data.item;
                });
            },
            showModal: function (reference) {
                this.$refs[reference][0].show();
            },
        },
        mounted:function(){
        },
        created: function(){
            this.getItems();
        },
    }
</script>
