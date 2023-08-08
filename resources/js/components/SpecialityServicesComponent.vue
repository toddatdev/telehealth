<template>
    <div>
      <div class="form-group">
            <div class="dc-select">
                <select :data-placeholder="trans('lang.select_speciality')" name="speciality" v-on:change="getServices(speciality)" v-model="speciality">
                    <option value="">{{ trans('lang.ph.select_speciality') }}</option>
                    <option v-for="(speciality, index) in specialities" :key="index" :value="speciality_value_type == 'slug' ? speciality.slug : speciality.id">{{speciality.title}}</option>
                </select>
            </div>
        </div>
        <div class="form-group" v-if="services.length > 0">
          <div class="dc-typeoptions">
              <div class="dc-select">
                  <select :data-placeholder="trans('lang.select_service')" name="service">
                    <option value="">{{ trans('lang.select_service') }}</option>
                    <option v-for="(service, serviceIndex) in services" :key="serviceIndex" :value="service_value_type == 'slug' ? service.slug : service.id">{{service.title}}</option>
                  </select>
              </div>
          </div>
        </div>
    </div>
</template>

<script>
export default {
  props: ['specialities', 'service_value_type', 'speciality_value_type'],
  data() {
    return {
      services:[],
      speciality:''
    }
  },
  methods: {
    getServices: function(speciality) {
      var self = this;
      axios.post(APP_URL + '/get-speciality-services', {id:speciality, type:self.speciality_value_type})
          .then(function (response) {
              if (response.data.type == 'success') {
                  self.services = response.data.services;
              }
          })
    },
  },
  mounted: function() {
    
  }
};
</script>