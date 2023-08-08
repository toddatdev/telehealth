<template>
    <div>
        <div class="pageloader-outer" v-if="loading" v-cloak>
            <div class="wt-preloader-holder">
                <div class="wt-loader"></div>
            </div>
        </div>
        <div class="dc-tabscontenttitle dc-addnew">
            <h3>{{trans('lang.add_speciality')}}</h3>
            <a href="javascript:void(0);" @click="addSpeciality" class="add-service-btn">{{trans('lang.add_new')}}</a>
        </div>
        <ul class="dc-experienceaccordion accordion" id="service-list">
            <li class="service-inner-list"  v-if="speciality_list.length > 0">
                <div v-for="(speciality, index) in specialities" :key="index" :ref="'servicelistelement'+index" class="service-inner-list-item dc-settingscontent">
                    <div class="form-group">
                        <span class="dc-select">
                            <select class="form-control" placeholder="add speciality" :id="'select-service-'+index" @change="getSpecialityServices(speciality.speciality, speciality.count, 'servicelistelement'+index)" v-model="speciality.speciality">
                                <option value="">{{ trans('lang.select_speciality') }}</option>
                                <option v-for="(speciality, list_index) in speciality_list" :key="list_index" :value="speciality.id">{{speciality.title}} </option>
                            </select>
                        </span>
                    </div>
                    <div :id="'serviceaccordion['+speciality.count+']'" data-toggle="collapse" :data-target="'#serviceaccordioninner['+speciality.count+']'">
                        <div class="dc-paneltitle active">
                            <figure class="dc-titleicon">
                                <img :id="'speciality_image' +speciality.speciality" :src="default_image" :alt="trans('lang.img_desc')">
                            </figure>
                            <span :id="'speciality_title' +speciality.speciality">{{ trans('lang.add_speciality') }}</span> 
                            <div class="dc-rightarea">
                                <div class="dc-btnaction">
                                    <a href="javascript:void(0);" class="dc-editbtn" :id="'serviceaccordion['+speciality.count+']'" data-toggle="collapse" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                                    <a href="javascript:void(0);" class="dc-delbtn delete-exp"><i class="lnr lnr-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dc-collapseexp collapse hide" :id="'serviceaccordioninner['+speciality.count+']'" :aria-labelledby="'serviceaccordion['+speciality.count+']'" data-parent="#accordion">
                        <speciality-service :services="speciality.services" :parent_index="index" v-if="speciality.services"></speciality-service>
                        <div class="not_selected" v-else>
                            <p> {{ trans('lang.select_speciality') }}</p>
                        </div>
                    </div>
                </div>
            </li>
            <div class="on-record" v-else>
                <p>{{ trans('lang.no_specialty_found') }}</p>
            </div>
        </ul>
    </div>
</template>
<script>
export default{
    props: [],
        data(){
            return {
                loading: false,
                default_image : APP_URL+'/images/icon-imgs/img-02.png',
                speciality_list:[], // get speciality from db
                speciality: {
                    url: APP_URL,
                    speciality:'',
                    count: 0,
                    services:[],
                },
                specialities: [],
                
            }
        },
        methods: {
            getSpecialities() {
                let self = this;
                axios.get(APP_URL + '/get-specialities')
                .then(function (response) {
                    if(response.data.type == 'success') {
                        self.speciality_list = response.data.specialities;
                    }
                });
            },
            getSpecialityServices(id, index, ref) {
                this.speciality.services = [];
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
                                // self.speciality.speciality_services[index] = response.data.speciality.services;
                                // console.log(ref);
                                // console.log(self.$refs[ref]);
                                self.speciality.services.push({ services: response.data.speciality.services});
                                console.log(self.speciality.services);
                            }
                            if (response.data.speciality) {
                                var title = document.getElementById('speciality_title'+id);
                                title.innerHTML = response.data.speciality.title;
                                var img = document.getElementById('speciality_image'+id);
                                img.src =  APP_URL+'/uploads/specialities/'+response.data.speciality.image;
                            }
                        } else {
                            self.loading = false
                        }
                    });
                }
            },
            getSelectedServices: function(id, index, service_index) {
                var index = this.speciality.speciality_services[index].findIndex(function(service) {
                   return service.id == id
                });
                var title = document.getElementById('inner_service_title'+service_index);
                title.innerHTML = this.speciality.speciality_services[0][index].title;
            },
            addSpeciality: function () {
                var services_list_count = jQuery('#service-list').find('.service-inner-list .service-inner-list-item').length
                if(services_list_count) {
                    this.speciality.count = services_list_count;
                } else {
                    this.speciality.count = 0;
                }
                this.specialities.push(
                    Vue.util.extend({}, 
                    this.speciality, 
                    // this.$set(this.speciality, this.speciality.speciality, 'speciality'+this.speciality.count),
                    //this.$set(this.speciality, this.speciality.speciality_services, 'speciality_services'+this.speciality.count),
                    //this.$set(this.speciality, this.speciality.new_services, 'new_services'+this.speciality.count)
                    ))
                this.speciality.count++
            },
            removeStoredexperience: function (index) {
                // this.stored_services.splice(index, 1);
            },
            addService: function (index) {
                var new_services_list_count = jQuery('#service-list').find('.new-service-inner-list .new-service-inner-list-item').length
                if(new_services_list_count) {
                    this.new_service.count = new_services_list_count;
                } else {
                    this.new_service.count = 0;
                }
                this.speciality.new_services.push(
                    Vue.util.extend({}, 
                    this.new_service, 
                     
                    // this.$set(this.new_service, this.new_service.service, 'service'+this.new_service.count),
                )),
                this.new_service.count++
            },
        },
        created: function() {
            this.getSpecialities();
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
