<template>
  <div class="dc-appointment-holder">
    <div class="dc-title">
        <h4>{{ trans('lang.select_best_time') }} ({{startendtime}}) </h4>
    </div>
    <div class="dc-appointment-content">
      <div class="dc-appointment-calendar">
        <div :style="{ width: '300px', border: '1px solid #d9d9d9', borderRadius: '4px' }">
          <a-calendar :fullscreen="false" @panelChange="onPanelChange" @select="onSelect" v-model="selected_day" />
        </div>
        <input type="hidden" :value="day" name="appointment[day]">
        <input type="hidden" :value="appointment_date" name="appointment[date]">
      </div>
      <div class="dc-timeslots">
        <span class="dc-radio next-step" v-for="(slot, index) in slots" :key="index">
            <input type="radio" :id="'availableslot-'+index" name="appointment[time]" :value="slot.start_time" v-if="slot.space > 0">
            <input type="radio" :id="'availableslot-'+index" name="appointment[time]" :value="slot.start_time" disabled v-else>
            <label :for="'availableslot-'+index"><span> {{slot.start_time}}</span><em>Spaces: {{slot.space}}</em></label>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import Event from '../event.js'
// import 'ant-design-vue/dist/antd.css'
export default {
  props: ['doctor_id', 'hospital_id'],
  data: function () {
      return {
        selected_day:moment(),
        appointment_date:'',
        day:'',
	startendtime:'',
        slots:[],
      }
    },
  methods: {
    onSelect(value) {
      var day = this.getDay(value);
      this.displaySlots(day);
    },
    onPanelChange(value, mode) {
      var day = this.getDay(value);
      this.displaySlots(day);
    },
    displaySlots(day) {
      this.appointment_date = this.selected_day.year() +'-'+this.selected_day.format('M')+'-'+this.selected_day.date();
      this.day = day;
      var self = this;
      axios.post(APP_URL + '/doctor/get-appointment-slots', {doctor_id:self.doctor_id, hospital_id:self.hospital_id, day:day, date:this.appointment_date})
      .then(function (response) {
        if (response.data.type === 'success') {
            self.slots = response.data.slots;
	    self.startendtime = response.data.startendtime;
        } else {
          
        }
      })
      .catch(function (error) {

      })
    
    },
    getDay: function(value) {
      var weekday = new Array(7);
      weekday[0] = "sun";
      weekday[1] = "mon";
      weekday[2] = "tue";
      weekday[3] = "wed";
      weekday[4] = "thu";
      weekday[5] = "fri";
      weekday[6] = "sat";
      var n = weekday[value.day()];
      return n;
    },
  },
  mounted: function() {
    var selected_day  = this.getDay(this.selected_day);
    Event.$on('display-slots', (data) => {
      this.doctor_id = data.doctor;
      this.hospital_id = data.hospital;
      this.displaySlots(selected_day);
    })
    this.displaySlots(selected_day);
  }
}
</script>
