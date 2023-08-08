<template>
    <div id="dc-childaccordion" class="dc-childaccordion" role="tablist" aria-multiselectable="true">
        <div class="dc-tabscontenttitle dc-addnew">
            <h3>{{trans('lang.add_service')}}</h3>
            <a href="javascript:void(0);" :id="'child-service'+speciality_index" v-on:click="addService($event)" class="add-service-btn">{{trans('lang.add_new')}}</a>
        </div>
        <div class="dc-subpanel" v-for="(new_service, index) in new_services" :id="'childcollapse-'+speciality_index+'-'+new_service.count" :key="index">
            <div v-bind:class="[new_service.count == 0 ? 'active' : '', 'dc-subpaneltitle dc-subpaneltitlevtwo']">
                <span :id="'inner_service_title-'+speciality_index+'-'+new_service.count"><em>Add your service</em></span>
                <div class="dc-rightarea">
                    <em>{{new_service.price}}</em>
                    <div class="dc-btnaction">
                        <a href="javascript:void(0);" class="dc-editbtn"
                        data-toggle="collapse" aria-expanded="true" :id="'childcollapse-edit-'+speciality_index+'-'+new_service.count" v-on:click="toggleChildCollapse('childcollapse-edit-'+speciality_index+'-'+new_service.count, 'childcollapse-'+speciality_index+'-'+new_service.count)">
                            <i class="lnr lnr-pencil"></i>
                        </a>
                        <a href="javascript:void(0);" class="dc-delbtn delete-exp" v-on:click.prevent="deleteService(index)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </div>
            </div>
            <div class="dc-subpanelcontent" v-bind:style="[new_service.count == 0 ? {'display' : 'block'} : {'display' : 'none'}]">
                <div class="dc-formtheme dc-userform">
                    <fieldset>
                        <div class="form-group form-group-half">
                            <span class="dc-select">
                                <select class="form-control" :placeholder="trans('lang.select_service')" v-model="new_service.service" :name="'services['+speciality_index+'][service]['+new_service.count+'][service]'" @change="getSelectedServices(new_service.service, parent_speciality_index, new_service.count, speciality_index)">
                                    <option value="">{{ trans('lang.select_service') }}</option>
                                    <option v-for="(service, service_index) in new_service.services" :key="service_index" :value="service.id">{{service.title}} </option>
                                </select>
                            </span>
                        </div>
                        <div class="form-group form-group-half">
                            <input type="text" :name="'services['+speciality_index+'][service]['+new_service.count+'][price]'" class="form-control" :placeholder="trans('lang.ph.add_price')" v-model="new_service.price">
                        </div>
                        <div class="form-group">
                            <textarea :name="'services['+speciality_index+'][service]['+new_service.count+'][description]'" class="form-control" :placeholder="trans('lang.ph.desc')"></textarea>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import Event from '../../event.js'
export default{
    props: ['speciality_services', 'speciality_index', 'stored_speciality_services'],
        data(){
            return {
                parent_speciality_index:'',
                parent_id:'',
                new_service:{ 
                    service:'',
                    price:'',
                    description:'',
                    services:[],
                    selected_service: {
                        title:'Add Service',
                    },
                    count:0,
                },
                new_services:[],
            }
        },
        methods: {
            addService: function (event) {
                var parent_id = jQuery('#'+event.target.id).parents('.dc-panelcontent').attr('id');
                var new_services_list_count = jQuery('#'+parent_id).find('.dc-childaccordion .dc-subpanel').length;
                if (new_services_list_count) {
                    this.new_service.count = new_services_list_count;
                } else {
                    this.new_service.count = 0;
                }
                this.new_services.push(
                    Vue.util.extend({}, 
                    this.new_service, 
                    this.new_service.services = this.speciality_services,
                )),
                this.new_service.count++
            },
            toggleChildCollapse: function(element_id, child_collapse_id) {
                var has_active = jQuery('#'+element_id).parents('.dc-subpanel').find('.dc-subpaneltitle.dc-subpaneltitlevtwo').hasClass('active')
                if (has_active) {
                    return false;
                }
                jQuery('#'+child_collapse_id).parents('.dc-childaccordion').find('.dc-subpanel').children().removeClass('active');
                jQuery('#'+child_collapse_id).parents('.dc-childaccordion').find('.dc-subpanel .dc-subpanelcontent').slideUp("slow");
                jQuery('#'+child_collapse_id).find('.dc-subpaneltitle.dc-subpaneltitlevtwo').addClass('active');
                jQuery('#'+child_collapse_id).find('.dc-subpaneltitle.dc-subpaneltitlevtwo').siblings().slideDown("slow");
                
            },
            getSelectedServices: function(id, index, service_index, parent_index) {
                var index = this.speciality_services.findIndex(function(service) {
                   return service.id == id
                });
                var title = document.getElementById('inner_service_title-'+parent_index+'-'+service_index);
                title.innerHTML = this.speciality_services[index].title;
            },
            deleteService: function (index) {
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
                        this.new_services.splice(index, 1);
                        this.$swal('deleted', window.trans.lang.ph_loc_service_del_msg, 'success')
                        jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                    } else {
                        this.$swal.close()
                    }
                  })
                
            },
        },
        created: function() {
            
        },
        mounted: function () {
            Event.$on('display-parent', (data) => {
                jQuery('#'+data.parent).find('.dc-childaccordion').attr('id', 'subpanel-'+data.parent);
                jQuery('#'+data.parent).find('.dc-childaccordion .dc-tabscontenttitle a').attr('id', 'subpanelbtn-'+data.parent);
            })
            if (this.services) {
                this.has_services = true;
            }
        },
    }
</script>
