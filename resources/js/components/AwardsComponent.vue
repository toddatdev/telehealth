<template>
    <div>
        <div class="dc-formtheme dc-skillsform">
            <transition name="fade">
                <div v-if="isShow" class="sj-jump-messeges">{{ trans('lang.no_record') }}</div>
            </transition>
            <fieldset>
                <div class="form-group">
                    <div class="form-group-holder dc-datepicker">
                        <input type="text" id="award-title" name="award_title" :placeholder="trans('lang.add_title_here')" class="form-control">
                        <date-pick v-model="award_year"></date-pick>
                        <input type="hidden" v-bind:name="'award_year'" class="form-control" :placeholder="select_year" :value="award_year">
                    </div>
                </div>
                <div class="form-group dc-btnarea">
                    <a href="javascript:void(0);" class="dc-btn" @click="addAwards(award_year)">{{trans('lang.add_awards')}}</a>
                </div>
            </fieldset>
        </div>
        <div class="dc-myskills">
            <ul id="award_list" class="sortable list">
                <li v-for="(award, index) in stored_awards" :key="'stored_'+index" v-if="stored_awards" :id="'award-'+index" class="award-element" :ref="'award-'+index">
                    <div class="dc-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">{{ award.title }} ({{ award.year }})</span>
                    <span class="skill-dynamic-field">
                        <input type="hidden" v-bind:name="'awards['+index+'][title]'" :value="award.title">
                        <input type="hidden" v-bind:name="'awards['+index+'][year]'" :value="award.year">
                        <input type="text" v-bind:name="'awards['+index+'][title]'" v-model="award.title">
                    </span>
                    <div class="dc-rightarea">
                        <a href="javascript:void(0);" class="dc-addinfo" v-on:click="editInput(index)"><i class="lnr lnr-pencil"></i></a>
                        <a href="javascript:void(0);" class="dc-deleteinfo" @click="deActiveStoredAwards(index)" v-if="stored_edit_class"><i class="lnr lnr-trash"></i></a>
                        <a href="javascript:void(0);" class="dc-deleteinfo delete-award" @click="removeStoredAwards('award-'+index)" v-else><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
                <li v-for="(award, index) in awards" :key="index+award.count" v-bind:class="{ 'dc-skillsaddinfo': award.edit_class }">
                    <div class="dc-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">{{ award.title }} ({{ award.year }})</span>
                    <span class="skill-dynamic-field">
                        <input type="hidden" v-bind:name="'awards['+[award.count]+'][title]'" :value="award.title">
                        <input type="hidden" v-bind:name="'awards['+[award.count]+'][year]'" :value="award.year">
                        <input type="text" v-bind:name="'awards['+[award.count]+'][title]'" v-model="award.title">
                    </span>
                    <div class="dc-rightarea">
                        <a href="javascript:void(0);" class="dc-addinfo" v-on:click="award.edit_class = !award.edit_class"><i class="lnr lnr-pencil"></i></a>
                        <a href="javascript:void(0);" class="dc-deleteinfo" v-on:click="award.edit_class = !award.edit_class" v-if="award.edit_class"><i class="lnr lnr-trash"></i></a>
                        <a href="javascript:void(0);" class="dc-deleteinfo" @click="removeAward(index)" v-else><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
<script>
import DatePick from 'vue-date-pick';
 export default{
    components: {DatePick},
    props: ['widget_title', 'select_year'],
        data(){
            return {
                dc_awardsactive:false,
                isShow: false,
                stored_awards:[],
                award_title: '',
                award_year:this.getCurrentDate(),
                selected_award_text:'',
                edit_class: [],
                stored_edit_class:false,
                edit_award: '',
                award: {
                    id: '',
                    year: '',
                    title:'',
                    count: 0,
                    edit_class: false,
                },
                awards: [],
                counts:0,
                notificationSystem: {
                    error: {
                        position: "topRight",
                        timeout: 4000
                    }
                },
            }
        },
        methods: {
            getCurrentDate() {
                var date = new Date();
                var day = ("0" + date.getDate()).slice(-2);
                var monthIndex = ("0" + (date.getMonth() + 1)).slice(-2);
                var year = date.getFullYear();
                return year+'-'+monthIndex+'-'+day ;
            },
            showError(error){
                return this.$toast.error(' ', error, this.notificationSystem.error);
            },
            getawards(){
                let self = this;
                axios.get(APP_URL + '/doctor/get-awards')
                .then(function (response) {
                    self.stored_awards = response.data.awards;
                });
            },
            addAwards: function (date) {
                console.log(date);
                var awardsSelect = document.getElementById("award-title");
                if (awardsSelect.value === "") {
                    this.showError('empty field not allow');
                } else {
                    var award_list_count = jQuery('.dc-btn').parents('.dc-skillsform').next('.dc-myskills').find('ul#award_list li').length;
                    award_list_count = award_list_count - 1;
                    this.award.count = award_list_count;
                    this.award_title = document.getElementById("award-title").value;
                    var year = date.split('-'); 
                    console.log(year[0]);
                    this.award.count++;
                    this.awards.push(Vue.util.extend({}, this.award, this.award.count++, this.award.title = this.award_title, this.award.id = this.award_title, this.award.year = year[0] ))
                }
            },
            removeAward: function (index) {
                var self = this;
                this.$swal({
                    title: window.trans.lang.ph_delete_confirm_title,
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
                        self.awards.splice(index, 1);
                        self.$swal(window.trans.lang.award_deleted, '', 'success')
                        jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                    } else {
                        this.$swal.close()
                    }
                  })
            },
            removeStoredAwards: function (id) {
                jQuery('#' + id).remove();
            },
            editInput: function (index) {
                this.stored_edit_class = true;
                // this.$set(this.edit_class, index, 'edit_class'+index);
                // this.stored_edit_class  = this.edit_class[index];
                if (this.$refs['award-'+index][0].classList.contains('dc-skillsaddinfo')) {
                    this.$refs['award-'+index][0].classList.remove('dc-skillsaddinfo');
                } else {
                    this.$refs['award-'+index][0].classList.add('dc-skillsaddinfo');
                }
            },
            deActiveStoredAwards: function (index) {
                this.stored_edit_class = false;
                if (this.$refs['award-'+index][0].classList.contains('dc-skillsaddinfo')) {
                    this.$refs['award-'+index][0].classList.remove('dc-skillsaddinfo');
                }
            }
        },
        mounted: function () {
            
        },
        created: function() {
            this.getawards();
        }
    }
</script>
