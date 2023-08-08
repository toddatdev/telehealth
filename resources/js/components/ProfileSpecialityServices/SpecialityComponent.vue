<template>
    <div>
        <div class="pageloader-outer" v-if="loading" v-cloak>
            <div class="wt-preloader-holder">
                <div class="wt-loader"></div>
            </div>
        </div>
        <div class="dc-tabscontenttitle dc-addnew" v-if="db_specialities.length > 0">
            <h3>{{trans('lang.add_speciality')}}</h3>
            <a href="javascript:void(0);" @click="addSpeciality" class="add-service-btn">{{trans('lang.add_new')}}</a>
        </div>
        <div id="dc-accordion" class="dc-accordion dc-moreservice" role="tablist" aria-multiselectable="true">
            <div :class="'del-'+user_speciality.speciality.id" class="card" v-for="(user_speciality, selected_speciality_index) in user_specialities" :key="selected_speciality_index+'-separator'">
                <delete :title="trans('lang.ph_delete_confirm_title')" :id="user_speciality.speciality.id" :message="trans('lang.ph_speciality_delete_message')" :url="baseURL+'/user/speciality_delete/'+selected_speciality_index"></delete>
                <div class="dc-panel" v-bind:class="[selected_speciality_index == 0 ? 'panel-active' : '']">
                    <div class="form-group" :style="[selected_speciality_index != 0 ? {'display': 'none'} : {'display': 'blobk'}]">
                        <span class="dc-select">
                            <select class="form-control" :name="'services['+selected_speciality_index+'][speciality]'" :id="'selected_speciality'+selected_speciality_index" @change="getSpecialityServices('selected_speciality'+selected_speciality_index, selected_speciality_index, 'servicelistelement'+selected_speciality_index, 'user_speciality')">
                                <option v-for="(db_speciality, dblist_index) in db_specialities" :key="dblist_index" :value="db_speciality.id" :selected="user_speciality.speciality.id == db_speciality.id">{{db_speciality.title}} </option>
                            </select>
                        </span>
                    </div>
                    <a href="#" :id="'delete-speciality'+selected_speciality_index" class="dc-deleteinfo-child" v-on:click.prevent="deletedbSpeciality('del-'+user_speciality.speciality.id)">
                        <i class="lnr lnr-cross"></i>
                    </a>
                    <div class="dc-paneltitle" 
                        :ref="'servicelistelement'+selected_speciality_index" 
                        :id="'speciality-'+selected_speciality_index" 
                        v-bind:class="[selected_speciality_index == 0 ? 'active' : '']"
                        v-on:click="toggleCollapse('speciality-'+selected_speciality_index, speciality.user_speciality, selected_speciality_index)">
                        <figure class="dc-titleicon">
                            <img :id="'speciality_image' +selected_speciality_index" :src="user_speciality.speciality.image" :alt="trans('img_desc')">
                        </figure>
                        <span :id="'speciality_title' +selected_speciality_index"><em>{{user_speciality.speciality.title}}</em></span>
                    </div>
			
		<div class="dc-subpanel" v-for="(new_service, index) in user_speciality.speciality.services" :class="'del-'+index+'-'+selected_speciality_index" :id="'childcollapse-'+index+'-'+selected_speciality_index" :key="index">
		    <div class="dc-subpanelcontent">
                        <div class="dc-formtheme dc-userform 11">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <span class="dc-select">
                                        <select class="form-control" :placeholder="trans('lang.select_service')" :name="'services['+selected_speciality_index+'][service][0][service]'" @change="getSelectedServices(new_service.service, index, selected_speciality_index)">
                                           <!-- <option v-for="(service, service_index) in speciality_services" :key="service_index" :value="service.id" selected>{{service.title}} </option> -->
						<option v-if="user_speciality.speciality.id == 1" value="17" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 2" value="18" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 3" value="19" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 4" value="20" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 5" value="21" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 6" value="22" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 7" value="23" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 8" value="24" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 9" value="25" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 10" value="26" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 11" value="27" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 12" value="28" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 13" value="29" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 14" value="30" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 15" value="31" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 16" value="32" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 17" value="33" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 18" value="34" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 19" value="35" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 20" value="36" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 21" value="37" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 22" value="38" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 23" value="39" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 24" value="40" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 25" value="41" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 26" value="42" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 27" value="43" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 28" value="44" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 29" value="45" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 30" value="47" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 31" value="48" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 32" value="49" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 33" value="50" selected>Service price</option>
<option v-else-if="user_speciality.speciality.id == 34" value="51" selected>Service price</option>
<option v-else value="52" selected>Service price</option>
                                        </select>
                                    </span>
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" :name="'services['+selected_speciality_index+'][service][0][price]'" class="form-control" :placeholder="trans('lang.ph.add_price')" v-model="new_service.price">
                                </div>
                                <div class="form-group">
                                    <textarea :name="'services['+selected_speciality_index+'][service][0][description]'" class="form-control" :placeholder="trans('lang.ph.desc')">{{new_service.description}}</textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>
</div>

                </div>
            </div>
            <div :class="'del-'+speciality.id" class="card" v-for="(speciality, index) in specialities" :key="index" v-if="show_accordion">
                <a  href="#" v-on:click.prevent="deleteSpeciality(index)" class="dc-deleteinfo">
                    <i class="lnr lnr-trash"></i>
                </a>
                <div class="dc-panel">
                    <div class="form-group">
                        <span class="dc-select">
                            <select class="form-control" :name="'services['+speciality.count+'][speciality]'" @change="getSpecialityServices(speciality.speciality, speciality.count, 'servicelistelement'+speciality.count)" v-model="speciality.speciality">
                                <option v-for="(speciality, list_index) in db_specialities" :key="list_index" :value="speciality.id">{{speciality.title}} </option>
                            </select>
                        </span>
                    </div>
                    <a href="#" :id="'delete-speciality'+speciality.count" class="dc-deleteinfo-child" v-on:click.prevent="deleteSpeciality(index)" v-show="speciality.del_show">
                        <i class="lnr lnr-cross"></i>
                    </a>
                    <div class="dc-paneltitle" v-bind:class="[speciality.count == 0 ? 'active' : '']" :ref="'servicelistelement'+speciality.count" :id="'speciality-'+speciality.count" v-on:click="toggleCollapse('speciality-'+speciality.count, speciality.speciality, speciality.count)">
                        <figure class="dc-titleicon">
                            <img :id="'speciality_image' +speciality.count" :src="default_image" :alt="trans('img_desc')">
                        </figure>
                        <span :id="'speciality_title' +speciality.count"><em>{{ trans('lang.add_your_speciality') }}</em></span>
                    </div>

		<div class="dc-subpanelcontent">
                        <div class="dc-formtheme dc-userform 12">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <span class="dc-select">
                                        <select class="form-control" :placeholder="trans('lang.select_service')" :name="'services['+speciality.count+'][service][0][service]'" @change="getSelectedServices(new_service.service, index, speciality.count)">
                                            <option v-for="(service, service_index) in speciality_services" :key="service_index" :value="service.id" selected>{{service.title}} </option>
                                        </select>
                                    </span>
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" :name="'services['+speciality.count+'][service][0][price]'" class="form-control" :placeholder="trans('lang.ph.add_price')">
                                </div>
                                <div class="form-group">
                                    <textarea :name="'services['+speciality.count+'][service][0][description]'" class="form-control" :placeholder="trans('lang.ph.desc')">{{new_service.description}}</textarea>
                                </div>
                            </fieldset>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Event from '../../event.js'
export default{
    props: [],
        data(){
            return {
                baseURL:APP_URL,
                show_accordion:false,
                loading: false,
                default_image : APP_URL+'/images/icon-imgs/img-02.png',
                speciality: {
                    url: APP_URL,
                    speciality:'',
                    del_show:false,
                    count: 0,
                },
                specialities: [],
		new_service:{ 
                    service:'',
                    price:'',
                    description:'',
                    services:[],
                    selected_service: {
                        title:window.trans.lang.add_service,
                    },
                    count:0,
                },
                new_services:[],
                db_specialities:[],
                speciality_services:[],
                selected_speciality:'',
                user_specialities:[],
            }
        },
        methods: {
            getSpecialities() {
                let self = this;
                axios.get(APP_URL + '/get-specialities')
                .then(function (response) {
                    if(response.data.type == 'success') {
                        self.db_specialities = response.data.specialities;
                    }
                });
            },
            getUserSpecialities() {
                let self = this;
                axios.get(APP_URL + '/get-user-specialities')
                .then(function (response) {
                    if(response.data.type == 'success') {
                        self.user_specialities = response.data.user_specialities;
                    }
                });
            },
            getSpecialityServices(selected_id, index, ref, type) {
                var title = document.getElementById('speciality_title'+index);
                var img = document.getElementById('speciality_image'+index);
                if (type == 'user_speciality') {
                    var id = document.getElementById(selected_id).value;
                } else {
                    var id = selected_id;
                }
                if (id) {
                    this.loading = true
                    let self = this;
                    axios.post(APP_URL + '/get-speciality-service',{
                        id:id,
                    })
                    .then(function (response) {
                        if(response.data.type == 'success') {
                            self.loading = false
                            if (response.data.speciality.services.length > 0) {
                                self.speciality_services = response.data.speciality.services;
                            }
                            if (response.data.speciality) {
                                title.innerHTML = response.data.speciality.title;
                                if(response.data.speciality.image) {
                                    img.src =  APP_URL+'/uploads/specialities/'+'extra-small-'+response.data.speciality.image;
                                } else {
                                    img.src =  APP_URL+'/images/default-speciality.png';
                                }
                                
                            }
                        } else {
                            self.loading = false
                        }
                    });
                }
            },
            getSelectedServices: function(id, index, service_index) {
                var index = this.speciality_services.findIndex(function(service) {
                   return service.id == id
                });
                var title = document.getElementById('inner_service_title'+service_index);
                title.innerHTML = this.speciality_services[index].title;
            },
	    getSpecialityServicesInitLoad(id) {
                if (id) {
                    let self = this;
                    axios.post(APP_URL + '/get-speciality-service',{
                        id:id,
                    })
                    .then(function (response) {
                        if(response.data.type == 'success') {
                            if (response.data.speciality.services.length > 0) {
                                self.speciality_services = response.data.speciality.services;
                            }
                        } else {
                        }
                    });
                }
            },
            addSpeciality: function () {
                var speciality_list_count = jQuery('#dc-accordion').find('.dc-panel').length
                if(speciality_list_count) {
                    this.speciality.count = speciality_list_count;
                } else {
                    this.speciality.count = 0;
                }
                this.specialities.push(
                    Vue.util.extend({}, 
                    this.speciality, 
                    ))
                this.speciality.count++
                this.show_accordion = true;
            },
            deleteSpeciality: function (index) {
                this.$swal({
                    title: window.trans.lang.do_you_want_delete_speciality,
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
                        this.specialities.splice(index, 1);
                        this.$swal('deleted', window.trans.lang.ph_speciality_delete_message, 'success')
                        jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                    } else {
                        this.$swal.close()
                    }
                  })
                
            },
            deletedbSpeciality: function (element_id) {
                this.$swal({
                    title: window.trans.lang.do_you_want_delete_speciality,
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
                        jQuery('.'+element_id).remove();
                        this.$swal('deleted', window.trans.lang.ph_speciality_delete_message, 'success')
                        jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                    } else {
                        this.$swal.close()
                    }
                  })
                
            },
            IntParentAccordion: function() {
                jQuery('.dc-panelcontent').hide();
            },
            toggleCollapse: function(element_id, speciality_id, parent_index) {
                if (document.getElementById(element_id).classList.contains('active')) {
                    return false;
                }
                jQuery('.active.dc-paneltitle').siblings().slideUp("slow");
                jQuery('.active.dc-paneltitle').parents('.dc-panel').find('.dc-deleteinfo-child').slideDown("slow");
                jQuery('.active.dc-paneltitle').removeClass('active');
                jQuery('.dc-panel').removeClass('panel-active');
                jQuery('#'+element_id).addClass('active');
                jQuery('#'+element_id).parents('.dc-panel').addClass('panel-active');
                jQuery('#'+element_id).siblings().slideDown("slow");
                // jQuery('#'+element_id).find('.active').siblings('.dc-deleteinfo-child').css('display', 'none');
                //jQuery('#'+element_id).siblings('.dc-deleteinfo-child').css('display', 'block');
                jQuery('#'+element_id).next('.dc-panelcontent.dc-moreservice-content').attr('id', 'parent_'+parent_index);
                Event.$emit('display-parent', { parent: 'parent_'+parent_index, index:parent_index });
            },

        },
        created: function() {
            this.getSpecialities();
            this.getUserSpecialities();
        },
        mounted: function () {
            jQuery(document).on('click', '.delete-exp', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.parents('.service-inner-list-item').remove();
            });
        },
    }
</script>
<style scoped>
.dc-panel.panel-active .dc-deleteinfo-child {
    display: none !important;
}
</style>
