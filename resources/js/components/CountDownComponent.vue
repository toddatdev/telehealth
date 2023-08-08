<template>
    <div>
        <div class="dc-insightsitem dc-dashboardbox">
            <span class="wt-pakagespinner" v-if="this.expire == false">
                <i class="fa fa-spinner wt-uploading"></i>
                D{{ days | two_digits }} : H{{ hours | two_digits }} : M{{ minutes | two_digits }} : S{{ seconds | two_digits }}
            </span>
            <figure class="dc-userlistingimg">
                <img :src="this.image_url" alt="trans('lang.img')" class="mCS_img_loaded" v-if='image_url'>
                <i class="fa fa-hourglass" v-else></i>
            </figure>
            <div class="dc-insightdetails">
                <div class="dc-title">
                    <h3>{{this.title}}</h3>
                    <a :href="this.package_url">{{ trans('lang.upgrade_now') }}</a> | <span class="current_package">{{this.current_package}} </span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    ready() {
        window.setInterval(() => {
            this.now = Math.trunc((new Date()).getTime() / 1000);
        },1000);
    },
    props : {
        date : {
            type: String,
            coerce: str => Math.trunc(Date.parse(str) / 1000)
        },
        image_url: {
            type: String,
        },
        trail: {
            type: String,
        },
        title: {
            type: String,
        },
        package_url: {
            type: String,
        },
        current_package: {
            type: String,
        }
    },
    data() {
        return {
            now: Math.trunc((new Date()).getTime() / 1000),
            system_date:'',
            updated_date:'',
            expire:false,
        }
    },
    computed: {
        dateInMilliseconds() {
            return Math.trunc(Date.parse(this.date) / 1000)
        },
        seconds() {
            return (this.dateInMilliseconds - this.now) % 60;
        },
        minutes() {
            return Math.trunc((this.dateInMilliseconds - this.now) / 60) % 60;
        },
        hours() {
            return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60) % 24;
        },
        days() {
            return Math.trunc((this.dateInMilliseconds - this.now) / 60 / 60 / 24);
        }
    },
    mounted() {
        console.log(this.image_url);
        this.updated_date = window.setInterval(() => {
                this.now = Math.trunc((new Date()).getTime() / 1000);
            },1000);
        var date = new Date();
        var day = ("0" + date.getDate()).slice(-2);
        var monthIndex = ("0" + (date.getMonth() + 1)).slice(-2);
        var year = date.getFullYear();
        this.system_date = year+'-'+monthIndex+'-'+day +' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds() ;
        if (this.system_date >= this.date) {
            clearInterval(this.updated_date);
            this.expire = true;
        }
    },
  updated() {
    var date = new Date();
    var day = ("0" + date.getDate()).slice(-2);
    var monthIndex = ("0" + (date.getMonth() + 1)).slice(-2);
    var year = date.getFullYear();
    this.system_date = year+'-'+monthIndex+'-'+day +' ' + date.getHours() + ':' + date.getMinutes() + ':' + date.getSeconds() ;
    if (this.system_date >= this.date) {
         clearInterval(this.updated_date);
         this.expire = true;
    }
  }
}
</script>
