<template>
  <div class="dc-haslayout dc-appointment-detail-wraper" v-if="is_show">
    <div class="dc-preloader-section" v-if="is_loading" v-cloak>
      <div class="dc-preloader-holder">
        <div class="dc-loader"></div>
      </div>
    </div>
    <div class="dc-dashboardbox">
      <div class="dc-user-header">
        <figure class="dc-user-img">
          <img :src="appointment.user_image" alt="img description">
        </figure>
        <div class="dc-title">
          <h3>{{ appointment.user_name }} <i class="fa fa-check-circle"></i></h3>
          <span>{{ appointment.user_location }}</span>
        </div>
        <div class="dc-rightarea dc-status" v-if="accepted == true">
          <span>{{ this.appointment_status }}</span>
          <em>{{ trans('lang.status') }}</em>
        </div>
        <div class="dc-rightarea dc-status" v-else>
          <i class="fas fa-spinner fa-spin" v-if="appointment.status == 'pending'"></i>
          <span>{{ appointment.status }}</span>
          <em>{{ trans('lang.status') }}</em>
        </div>
      </div>
      <div class="dc-user-details">
        <div class="dc-user-info" v-if="appointment.patient_name">
          <div class="dc-title">
            <h4>{{ trans('lang.patient_name') }}</h4>
            <span>{{ appointment.patient_name }}</span>
          </div>
        </div>
        <div class="dc-user-info" v-if="appointment.relation">
          <div class="dc-title">
            <h4>{{ trans('lang.relation_with_user') }}</h4>
            <span>{{ appointment.relation }}</span>
          </div>
        </div>
        <div class="dc-user-info" v-if="appointment.hospital">
          <div class="dc-title">
            <h4>{{ trans('lang.appoint_location') }}</h4>
            <span>{{ appointment.hospital }}</span>
          </div>
        </div>
        <div class="dc-user-info">
          <div class="dc-title">
            <h4>{{ trans('lang.appointment_date') }}</h4>
            <span>{{ appointment.appointment_date }} - {{ appointment.appointment_time }}</span>
          </div>
        </div>
        <div class="dc-user-info dc-info-required" v-if="appointment.appointment_services">
          <div class="dc-title">
            <h4>{{ trans('lang.services') }}</h4>
          </div>
          <ul class="dc-required-details" v-for="(appointment_service, index) in appointment.appointment_services"
              :key="index">
            <span>{{ appointment_service.speciality }}</span>
            <li v-for="(service, service_index) in appointment_service.services" :key="service_index">
              <span>{{ service.title }}</span></li>
          </ul>
        </div>
        <div class="dc-required-info" v-if="appointment.comments">
          <div class="dc-title">
            <h4>{{ trans('lang.comment') }}</h4>
          </div>
          <div class="dc-description">
            {{ appointment.comments }}
          </div>
        </div>
        <div class="dc-required-info">
          <div class="dc-title">
            <h4>Meeting Link</h4>
          </div>
          <div class="dc-description" v-if="appointment.video_conference === 'zoom'">
            <a href="#" @click="gotoLink(appointment.zoomlink)" target="_blank"
               class="dc-btn goto_link">{{ trans('lang.goto_link') }}</a>
          </div>
          <div class="dc-description" v-else>
            <a href="#" @click="gotoLink(appointment.gotomeetinglink)" target="_blank"
               class="dc-btn goto_link">{{ trans('lang.goto_link') }}</a>
          </div>
        </div>
      </div>
      <div v-if="accepted === false">
        <div class="dc-user-steps" v-if="appointment.status === 'pending'">
          <div class="dc-btnarea" v-if="user_type !== 'patient'">
            <a href="javascript:void(0);" class="dc-btn dc-deleteinfo"
               v-on:click="declineAppointment(appointment)">{{ trans('lang.decline') }}</a>
            <a href="javascript:void(0);" class="dc-btn"
               v-on:click="acceptAppointment(appointment)">{{ trans('lang.accept') }}</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Event from '../../event.js'

export default {
  props: ['user_type'],
  data: function () {
    return {
      is_show: false,
      is_loading: false,
      accepted: false,
      patient_id: '',
      appointment_status: '',
      appointment_id: '',
      appointment: {},
      notificationSystem: {
        success: {
          position: 'topRight',
          timeout: 4000
        },
        error: {
          position: 'topRight',
          timeout: 7000
        },
      }
    }
  },
  methods: {
    showMessage (message) {
      return this.$toast.success(' ', message, this.notificationSystem.success)
    },
    showError (error) {
      return this.$toast.error(' ', error, this.notificationSystem.error)
    },
    acceptAppointment (appointment) {
      if (appointment) {
        var self = this
        self.is_loading = true
        axios.post(APP_URL + '/doctor/accept-appointment', { appointment: appointment, patient_id: self.patient_id })
            .then(function (response) {
              if (response.data.type === 'success') {
                self.is_loading = false
                self.appointment_status = response.data.status
                self.accepted = true
                jQuery('#' + self.appointment_id).text(response.data.status)
                self.showMessage(response.data.message)
              } else {
                self.is_loading = false
                self.showError(response.data.message)
              }
            })
            .catch(function (error) {
              self.is_loading = false
            })
      }
    },
    declineAppointment (appointment) {
      if (appointment) {
        var self = this
        self.is_loading = true
        axios.post(APP_URL + '/doctor/decline-appointment', { appointment: appointment, patient_id: self.patient_id })
            .then(function (response) {
              if (response.data.type === 'success') {
                self.is_loading = false
                self.accepted = true
                self.appointment_status = response.data.status
                jQuery('#' + self.appointment_id).text(response.data.status)
                self.showMessage(response.data.message)
              } else {
                self.is_loading = false
                self.showError(response.data.message)
              }
            })
            .catch(function (error) {
              self.is_loading = false
            })
      }
    },
    gotoLink(meeting_link) {
      window.open(meeting_link);
      var self = this
      if (self.user_type === 'patient'){
        self.is_loading = true
        axios.post(APP_URL + '/api/doctor/notify-patient-waiting', { appointment: this.appointment, meeting_link})
            .then(function (response) {
              if (response.data.type === 'success') {
                self.is_loading = false
              } else {
                self.is_loading = false
              }
            })
            .catch(function (error) {
              self.is_loading = false
            })
      }
    }
  },
  mounted: function () {
    let self = this
    Event.$on('display-detail', (data) => {
      self.appointment = data.appointments
      self.is_show = true
      self.accepted = false
      self.patient_id = data.patient_id
      self.appointment_id = data.appointment_id
      jQuery('.dc-appointment-detail-wraper').css('display', 'block')
    })
  }
}
</script>
