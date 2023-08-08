<template>
  <div>
    <div class="dc-title">
        <span>{{ trans('lang.who_visiting_doc') }}</span>
        <div class="dc-tabbtns">
            <input id="dc-myself" type="radio" name="patient" value="myself" checked="" v-model="patient_type" v-on:change="selectedPatient(patient_type)">
            <label for="dc-myself">
                {{ trans('lang.myself') }}
            </label>
            <input id="dc-someone" type="radio" name="patient" value="someone" v-model="patient_type" v-on:change="selectedPatient(patient_type)">
            <label for="dc-someone">
                {{ trans('lang.else') }}
            </label>
        </div>
    </div>
    <div class="dc-reason-holder">
      <transition name="fade">
        <fieldset v-if="show_myself">
          <div class="form-group form-group-half">
              <input type="text" id="patient_name" name="patient_name" class="form-control" :placeholder="trans('lang.patient_name')">
          </div>
          <div class="form-group form-group-half">
            <span class="dc-select">
                <select :data-placeholder="trans('lang.relation_with_you')" name="relation" id="relation">
                    <option value="">{{ trans('lang.relation_with_you') }}</option>
                    <option value="brother">{{ trans('lang.brother') }}</option>
                    <option value="wife">{{ trans('lang.wife') }}</option>
                    <option value="mother">{{ trans('lang.mother') }}</option>
                    <option value="sister">{{ trans('lang.sister') }}</option>
                </select>
            </span>
          </div>
        </fieldset>
      </transition>
      <fieldset>
		<input type="hidden" name="hospital" id="appointment_hospital" v-model="selected_hospital" placeholder="select hospital" value="15">
        <!-- <div class="form-group form-group-half">
              <span class="dc-select">
                  <select v-if="doctor_hospitals.length > 0" name="hospital" id="appointment_hospital" v-on:change="getHospitalServices(user_id)" v-model="selected_hospital" placeholder="select hospital">              
                      <option v-for="(hospital, index) in doctor_hospitals" :key="index" :value="hospital.id">{{hospital.name}}</option>
                  </select>
              </span>
          </div> -->
      </fieldset>
    </div>
    <div id="dc-appointment-accordion" class="dc-appointment-accordion dc-moreservice" role="tablist" aria-multiselectable="true" v-if="showServices">
      <div class="dc-panel" v-for="(speciality, index) in hospital_services.specialities" :key="index">
        <div v-bind:class="[index == 0 ? 'active' : '', 'dc-paneltitle']" :id="'service-tab-'+index" v-on:click="toggleCollapse('service-tab-'+index)">
            <figure class="dc-titleicon">
                <img :src="speciality.speciality_image" :alt="trans('lang.img_desc')">
            </figure>
            <span>{{speciality.speciality_title}}</span>
            <input type="hidden" :name="'speciality['+index+'][speciality]'" :value="speciality.speciality_id">
        </div>
        <div class="dc-appointmentpanelcontent">
            <div class="dc-subtitle">
                <h4>{{ trans('lang.services') }}:</h4>
            </div>
            <div class="dc-checkbox-holder">
                <span class="dc-checkbox" v-for="(service, service_index) in speciality.services" :key="service_index">
                    <input 
                      :id="'dc-mo-'+index+'-'+service_index" type="checkbox" 
                      :name="'speciality['+index+']'+'[service]['+service_index+']'" 
                      :value="service.service_id" 
                      v-on:change="displayServicePrice(service.service_price, service.service_title, 'dc-mo-'+index+'-'+service_index)"
                    >
                    <label :for="'dc-mo-'+index+'-'+service_index">{{service.service_title}}</label>
                </span>
            </div>
        </div>
      </div>
      <div class="dc-hospital_charges la-hospital-charges" v-if="showServices">
          <ul class="dc-taxesfees">
          <!--  <li class="hospital-price">{{ trans('lang.hospital_charges') }} <em>{{ hospital_services.price }}</em></li> -->
            <li class="service-price" v-for="(service, charges_index) in charges" :key="charges_index">{{service.title}}: <em>{{currency}}{{parseInt(parseFloat(service.price) * 1.2)}}</em></li>
            <li class="total-price">{{ trans('lang.total_charges') }} <em>{{currency}}{{parseInt(this.total_charges * 1.2)}}</em></li>
          </ul>
          <input type="hidden" :value="parseInt(this.total_charges * 1.2)" name="total_charges">
      </div>
    </div>
    <textarea name="comments" class="form-control" :placeholder="trans('lang.enter_appoint_desc')"></textarea>
    <appointment-slots-dialog :doctor_id="user_id" :hospital_id="selected_hospital" v-if="show_slots"></appointment-slots-dialog>
  </div>
</template>

<script>
import Event from '../event.js'
export default {
  props: ['user_id', 'speciality', 'hospitals', 'currency'],
  data: function () {
      return {
        doctor_hospitals: JSON.parse(this.hospitals),
        hospital_services:[],
        base_url:APP_URL,
        selected_hospital:15,
        showServices : false,
        charges:[],
        selected_services:{
          title:'',
          price:'',
        },
        patient_type:'myself',
        total_charges:'',
        show_myself:false,
        show_slots:false,
      }
    },
  methods: {
    selectedPatient: function(type) {
      if (type == 'someone') {
        this.show_myself = true;
      } else {
        this.show_myself = false;
      }
    },
    getHospitalServices: function (doctor_id) {
        if(doctor_id) {
          this.show_slots = true
          var self = this;
          axios.post(APP_URL + '/doctor/get-hospital-services', {hospital:self.selected_hospital, doctor:doctor_id})
          .then(function (response) {
            if (response.data.type == 'success') {
              self.hospital_services = response.data.services;
              console.log(self.hospital_services);
              if (self.hospital_services.price) {
                self.total_charges = self.hospital_services.price;
              } else {
                self.total_charges = 0;
              }
              Event.$emit('display-slots', { doctor: doctor_id, hospital:self.selected_hospital });
              self.showServices = true;
            } else if (response.data.type == 'error') {
              console.log('hello');
              self.showServices = false;
            }
          })
          .catch(error => {

          });
        } else {
          this.showServices = false;
        }
      },
      toggleCollapse: function(element_id) {
        jQuery('.active.dc-paneltitle').siblings().hide('slow');
        jQuery('.active.dc-paneltitle').removeClass('active');
        jQuery('#'+element_id).addClass('active');
        jQuery('#'+element_id).siblings().show('slow');
			
      },
      displayServicePrice: function (price, title, element_id) {
        if (document.getElementById(element_id).checked == true) {
          this.total_charges = parseInt(this.total_charges) + parseInt(price);
          this.charges.push(Vue.util.extend(
            {}, this.selected_services, this.selected_services.title = title, this.selected_services.price = price)
          )
        } else {
            this.total_charges = parseInt(this.total_charges) - parseInt(price);
            this.charges = this.charges.filter(function( obj ) {
              return obj.title !== title;
            });
        }
      }
  },
  mounted: function() {
	this.getHospitalServices(this.user_id);
  }
}
</script>
<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .3s ease;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

</style>

