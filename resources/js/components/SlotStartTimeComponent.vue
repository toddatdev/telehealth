<template>
    <div>
      <div class="form-group dc-datepicker form-group-half">
          <a-time-picker use12Hours v-on:change="onChange" format="h:mm a"/>
      </div>
      <input type="hidden" :id="start_time_id" :name="start_time_name" value="">
      <input type="hidden" :id="start_time_obj_id" value="">        
    </div>
</template>

<script>
export default {
  props: ['start_time_id', 'start_time_name', 'start_time_obj_id'],
  data() {
    return {
      
    }
  },
  methods: {
    onChange(time, timeString) {
      document.getElementById(this.start_time_id).value = timeString;
      document.getElementById(this.start_time_obj_id).value = time;
    }
  },
};
</script>