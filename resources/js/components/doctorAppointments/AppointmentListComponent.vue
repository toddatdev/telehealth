<template>
  <div class="appointment-list-area">
    <div class="dc-recentapoint" v-for="(commentIndex, index) in appointment_list.length" :key="index">
      <div class="dc-apoint-date" v-if="index < appointment_list.length && appointment_list[index]">
        <span>{{appointment_list[index][appointment_list[index].user_id].patient_appointment_date}}</span>
        <em>{{appointment_list[index][appointment_list[index].user_id].patient_appointment_month.substring(0,3)}}</em>
      </div>
      <div class="dc-recentapoint-content dc-apoint-noti dc-noti-colorone" v-if="index < appointment_list.length && appointment_list[index]">
        <figure><img :src="appointment_list[index][appointment_list[index].user_id].user_image" :alt="trans('lang.img_desc')"></figure>
        <div class="dc-recent-content">
          <span>{{appointment_list[index][appointment_list[index].user_id].user_name}} <em>Status: <i :id="'appointment-status-'+appointment_list[index][appointment_list[index].user_id].id">{{appointment_list[index][appointment_list[index].user_id].status}}</i></em></span>
          <a href="javascript:void(0);" v-on:click="getAppointmentDetail(index, appointment_list[index].user_id, 'appointment-status-'+appointment_list[index][appointment_list[index].user_id].id)" class="dc-btn dc-btn-sm">{{ trans('lang.view_details') }}</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Event from '../../event.js'
export default {
  props: ['appointment_list', 'paginated_index'],
  data: function () {
      return {
        // appointments: this.appointment,
      }
    },
  methods: {
    getAppointmentDetail: function(index, patient, appointment_id) {
      let self = this;
      Event.$emit('display-detail', { appointments: self.appointment_list[index][patient], patient_id:self.appointment_list[index].user_id, appointment_id: appointment_id });
    }
  },
  mounted: function() {
    console.log()
    // console.log(Object.keys(this.appointment_list).length)
  }
}
</script>