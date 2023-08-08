<template>
    <div>
        <div class="dc-formtheme dc-userform">
            <div class="dc-tabscontenttitle dc-addnew">
                <h3>{{trans('lang.add_service')}}</h3>
                <a href="javascript:void(0);" @click="addService" class="add-service-btn">{{trans('lang.add_new')}}</a>
            </div>
            <div v-for="(service, index) in services" :key="index" :ref="'serviceslistelement'+index" class="new-service-inner-list-item">
                <div :id="'newserviceaccordion['+parent_index+']['+index+']'" data-toggle="collapse" :data-target="'#newserviceaccordioninner['+parent_index+']['+index+']'">
                    <div class="dc-paneltitle active">
                        <span :id="'inner_service_title'+index">{{ trans('lang.add_service') }}</span> 
                        <div class="dc-rightarea">
                            <div class="dc-btnaction">
                                {{service.price}}
                                <a href="javascript:void(0);" class="dc-editbtn" :id="'newserviceaccordion['+parent_index+']['+index+']'" data-toggle="collapse" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                                <a href="javascript:void(0);" class="dc-delbtn delete-exp"><i class="lnr lnr-trash"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dc-collapseexp collapse hide" :id="'newserviceaccordioninner['+parent_index+']['+index+']'" :aria-labelledby="'newserviceaccordion['+parent_index+']['+index+']'" data-parent="#accordion">
                    <div class="dc-formtheme dc-userform">
                        <fieldset>
                            <div class="form-group form-group-half">
                                <span class="dc-select">
                                    <select class="form-control" :placeholder="trans('lang.select_service')" v-model="service.service" @change="getSelectedServices(service.service, index, index)">
                                        <option value="">{{ trans('lang.select_service') }}</option>
                                        <option v-for="(speciality_service, speciality_services_index) in services.services" :key="speciality_services_index" :value="speciality_service.id">{{speciality_service.title}} </option>
                                    </select>
                                </span>
                            </div>
                            <div class="form-group form-group-half">
                                <input type="text" name="price" class="form-control" :placeholder="trans('lang.ph.add_price')" v-model="service.price">
                            </div>
                            <div class="form-group">
                                <textarea name="description" class="form-control" :placeholder="trans('lang.desc')" v-model="service.description"></textarea>
                            </div>
                            <div class="form-group dc-btnarea">
                                <input type="button" class="dc-btn" value="Add Now">
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default{
    props: ['services', 'parent_index'],
        data(){
            return {
                service:this.services,
            }
        },
        methods: {
            addService: function(){

            },
            getSelectedServices: function(){

            },
        },
        created: function() {
            
        },
        mounted: function () {
            console.log(this.services);
        },
    }
</script>
