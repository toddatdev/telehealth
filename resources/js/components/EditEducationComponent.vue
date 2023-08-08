<template>
    <li class="edu-inner-list">
        <div class="edu-inner-list-item dc-settingscontent">
            <div :id="this.main_accordion_id" class="edu-inner-list-item dc-accordioninnertitle" data-toggle="collapse" :data-target="'#'+this.inner_accordion_id">
                <span>{{ this.stored_degree_title }}</span>
                <div class="dc-rightarea">
                <div class="dc-btnaction">
                    <a href="javascript:void(0);" class="dc-editbtn" :id="this.main_accordion_id" data-toggle="collapse" aria-expanded="true">
                        <i class="lnr lnr-pencil"></i>
                    </a>
                    <a href="javascript:void(0);" @click="removeElement()"  class="dc-delbtn"><i class="lnr lnr-trash"></i></a></div>
                </div>
            </div>
            <div class="dc-collapseexp collapse hide" :id="this.inner_accordion_id" :aria-labelledby="this.inner_accordion_id" data-parent="#accordion">
                <div class="dc-formtheme dc-userform">
                    <fieldset>
                        <div class="form-group form-group-half">
                            <input type="text" :value="this.stored_degree_title" v-bind:name="this.degree_title" class="form-control" :placeholder="ph_company_title">
                        </div>
                        <div class="form-group form-group-half">
                            <date-pick v-model="this.stored_start_date"></date-pick>
                            <input type="hidden" :value="this.stored_start_date" v-bind:name="this.start_date" class="form-control" :placeholder="ph_start_date">
                        </div>
                        <div class="form-group form-group-half">
                            <date-pick v-model="this.stored_end_date"></date-pick>
                            <input type="hidden" :value="this.stored_end_date" v-bind:name="this.end_date" class="form-control" :placeholder="ph_end_date">
                        </div>
                        <div class="form-group form-group-half">
                            <input type="text" :value="this.stored_job_title" v-bind:name="this.job_title" class="form-control" :placeholder="ph_job_title">
                        </div>
                        <div class="form-group form-group-half">
                            <input type="text" :value="this.stored_job_desc" v-bind:name="this.job_desc" class="form-control" :placeholder="ph_job_desc">
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </li>
</template>

<script>
import DatePick from 'vue-date-pick';
export default {
    components: {DatePick},
    props: [
        'degree_title', 'start_date', 'end_date',
        'job_title', 'job_desc', 'main_accordion_id', 'inner_accordion_id',
        'stored_start_date', 'stored_end_date', 'stored_job_title',
        'stored_job_desc', 'stored_degree_title',
        'ph_company_title', 'ph_start_date', 'ph_end_date',
        'ph_job_title', 'ph_job_desc'
        ],
    data: function () {
        return {
            options: {
            error: {
                position: 'center',
                    timeout: 3000,
                },
            },
            stored_educations:[],
        }
    },
    methods: {
        showError(message){
            return this.$toast.error(' ', message, this.options.error);
        },
        removeElement() {
            this.$emit('removeElement');
        },
    },
    mounted: function () {},
    created: function() {}
}
</script>
