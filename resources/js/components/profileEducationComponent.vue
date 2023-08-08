<template>
    <div>
        <div class="dc-tabscontenttitle dc-addnew">
            <h3>{{trans('lang.add_education')}}</h3>
            <a href="javascript:void(0);" @click="addEducation" class="add-edu-btn">{{trans('lang.add_new')}}</a>
        </div>
        <ul class="dc-experienceaccordion accordion" id="edu-list">
            <li class="edu-inner-list" v-for="(stored_education, index) in stored_educations" :id="'edu-list-'+index" :key="'db'+index" v-if="stored_educations.length > 0">
                <div class="edu-inner-list-item dc-settingscontent" :id="'education-element-'+index">
                    <div class="edu-inner-list-item dc-settingscontent">
                        <div :id="'existingeducationaccordion['+index+']'" class="edu-inner-list-item dc-accordioninnertitle">
                            <span>{{ stored_education.degree_title }}</span>
                            <div class="dc-rightarea">
                            <div class="dc-btnaction">
                                <a href="javascript:void(0);" class="dc-editbtn" :id="'existingeducationaccordion['+index+']'" 
                                data-toggle="collapse" aria-expanded="true" v-on:click="toggleChildCollapse('edu-list-'+index)">
                                    <i class="lnr lnr-pencil"></i>
                                </a>
                                <a href="javascript:void(0);" @click="removeStoredEducation(index)"  class="dc-delbtn"><i class="lnr lnr-trash"></i></a></div>
                            </div>
                        </div>
                        <div class="dc-collapseexp collapse hide" :id="'existingeducationaccordioninner['+index+']'">
                            <div class="dc-formtheme dc-userform">
                                <fieldset>
                                    <div class="form-group form-group-half">
                                        <input type="text" :value="stored_education.degree_title" v-bind:name="'education['+[index]+'][degree_title]'" class="form-control" :placeholder="degree_title">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <date-pick v-model="stored_education.start_date"></date-pick>
                                        <input type="hidden" :value="stored_education.start_date" v-bind:name="'education['+[index]+'][start_date]'" class="form-control" :placeholder="ph_start_date">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <date-pick v-model="stored_education.end_date"></date-pick>
                                        <input type="hidden" :value="stored_education.end_date" v-bind:name="'education['+[index]+'][end_date]'" class="form-control" :placeholder="ph_end_date">
                                    </div>
                                    <div class="form-group form-group-half">
                                        <input type="text" :value="stored_education.job_title" v-bind:name="'education['+[index]+'][job_title]'" class="form-control" :placeholder="ph_job_title">
                                    </div>
                                    <div class="form-group">
                                        <textarea :value="stored_education.job_desc" v-bind:name="'education['+[index]+'][job_desc]'" class="form-control" :placeholder="ph_job_desc"></textarea>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <li class="edu-inner-list" v-for="(education, index) in educations" :id="'edu-list-'+education.count" :key="index">
                <div ref="educationlistelement" class="edu-inner-list-item dc-settingscontent">
                    <div :id="'educationaccordion['+education.count+']'" class="edu-inner-list-item dc-accordioninnertitle">
                        <span>{{ education.degree_title }} ({{ education.start_date }} - {{ education.end_date }})</span>
                        <div class="dc-rightarea">
                        <div class="dc-btnaction">
                            <a href="javascript:void(0);" class="dc-editbtn" :id="'educationaccordion['+education.count+']'"
                                data-toggle="collapse" aria-expanded="true"><i class="lnr lnr-pencil"  v-on:click="toggleChildCollapse('edu-list-'+education.count)"></i></a>
                            <a href="javascript:void(0);" class="dc-delbtn delete-edu"><i class="lnr lnr-trash"></i></a></div>
                        </div>
                    </div>
                    <div class="dc-collapseexp collapse hide" :id="'educationaccordioninner['+education.count+']'">
                        <div class="dc-formtheme dc-userform">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'education['+[education.count]+'][degree_title]'" class="form-control" :placeholder="ph_degree_title" v-model="education.degree_title">
                                </div>
                                <div class="form-group form-group-half">
                                    <date-pick v-model="education.start_date"></date-pick>
                                    <input type="hidden" v-bind:name="'education['+[education.count]+'][start_date]'" :value="education.start_date">
                                </div>
                                <div class="form-group form-group-half">
                                    <date-pick v-model="education.end_date"></date-pick>
                                    <input type="hidden" v-bind:name="'education['+[education.count]+'][end_date]'" :value="education.end_date">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'education['+[education.count]+'][job_title]'" class="form-control" :placeholder="ph_job_title">
                                </div>
                                <div class="form-group">
                                    <textarea v-bind:name="'education['+[education.count]+'][job_desc]'" class="form-control" :placeholder="ph_job_desc"></textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
import DatePick from 'vue-date-pick';
export default{
    components: {DatePick},
    props: ['ph_degree_title', 'ph_start_date', 'ph_end_date', 'ph_job_title', 'ph_job_desc'],
        data(){
            return {
                stored_educations:[],
                degree_title: window.trans.lang.degree_title,
                start_date: window.trans.lang.start_date,
                end_date: window.trans.lang.end_date,
                job_title: window.trans.lang.job_title,
                description: window.trans.lang.desc,
                education: {
                    url: APP_URL,
                    degree_title: this.ph_degree_title,
                    start_date: this.ph_start_date,
                    end_date: this.ph_end_date,
                    job_title: this.ph_job_title,
                    description: this.ph_job_desc,
                    count: 0,
                },
                educations: [],
            }
        },
        methods: {
            toggleChildCollapse: function(element_id) {
                jQuery('#'+element_id).find('.dc-collapseexp').toggleClass('show')
            },
            getCurrentDate() {
                var date = new Date();
                var day = ("0" + date.getDate()).slice(-2);
                var monthIndex = ("0" + (date.getMonth() + 1)).slice(-2);
                var year = date.getFullYear();
                return year+'-'+monthIndex+'-'+day ;
            },
            getEducations(){
                let self = this;
                axios.get(APP_URL + '/doctor/get-educations')
                .then(function (response) {
                    if(response.data.type == 'success') {
                        self.stored_educations = response.data.educations;
                    }
                });
            },
            addEducation: function () {
                var date = this.getCurrentDate();
                var educations_list_count = jQuery('#edu-list').find('.edu-inner-list').length
                console.log(educations_list_count);
                if(this.$refs.educationlistelement) {
                    this.education.count = educations_list_count + this.$refs.educationlistelement.length;
                } else {
                    this.education.count = educations_list_count -1;
                }
                this.educations.push(Vue.util.extend({}, this.education, this.education.count++, this.education.start_date = date, this.education.end_date = date ))
            },
            removeStoredEducation: function (index) {
                this.stored_educations.splice(index, 1);
            },
        },
        created: function() {
            this.getEducations();
        },
        mounted: function () {
            jQuery(document).on('click', '.delete-edu', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.parents('.edu-inner-list-item').remove();
            });
        },
    }
</script>
