/**
 * Load all the javascript by using Vue.js and write all your JS code
 * in this file.
 */
import Vue from 'vue'
import 'izitoast/dist/css/iziToast.css'
import VueIziToast from 'vue-izitoast'
import VueSweetalert2 from 'vue-sweetalert2'
import BootstrapVue from 'bootstrap-vue'
import Verte from 'verte'
import 'vue-date-pick/dist/vueDatePick.css'
import VueBootstrapTypeahead from 'vue-bootstrap-typeahead'
import DatePick from 'vue-date-pick'
import { TimePicker } from 'ant-design-vue'
import { Calendar } from 'ant-design-vue'
import { VueStars } from 'vue-stars'
import { Printd } from 'printd'
// import 'ant-design-vue/dist/antd.css'
import * as VueGoogleMaps from 'vue2-google-maps'
import moment from 'moment'
import VueFormWizard from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

var Paginate = require('vuejs-paginate')

require('./bootstrap')
window.Vue = require('vue')
import 'verte/dist/verte.css'

Vue.prototype.trans = (key) => {
  return _.get(window.trans, key, key)
}

Vue.filter('two_digits', function (value) {
  if (value.toString().length <= 1) {
    return '0' + value.toString()
  }
  return value.toString()
})

Vue.use(VueGoogleMaps, {
  load: {
    key: Map_key,
    libraries: 'places',
  },
})
Vue.use(VueIziToast)
Vue.use(VueSweetalert2)
Vue.use(BootstrapVue)
Vue.use(TimePicker)
Vue.use(Calendar)
Vue.use(VueFormWizard)

window.flashVue = new Vue()
Vue.component('paginate', Paginate)
Vue.component('vue-bootstrap-typeahead', VueBootstrapTypeahead)
Vue.component('verte', Verte)
Vue.component('delete', require('./components/DeleteRecordComponent.vue').default)
Vue.component('multi-delete', require('./components/MultiDeleteComponent.vue').default)
Vue.component('flash_messages', require('./components/FlashMessages.vue').default)
Vue.component('upload-image', require('./components/AttachmentComponent.vue').default)
Vue.component('upload-file', require('./components/FileAttachmentComponent.vue').default)
Vue.component('upload-media', require('./components/UploadMediaComponent.vue').default)
Vue.component('home-slider', require('./components/HomeSliderComponent.vue').default)
Vue.component('switch_button', require('./components/SwitchButtonComponent.vue').default)
Vue.component('doctor_experience', require('./components/profileExperienceComponent.vue').default)
Vue.component('doctor_education', require('./components/profileEducationComponent.vue').default)
Vue.component('awards', require('./components/AwardsComponent.vue').default)
Vue.component('edit-roles', require('./components/EditRolesComponent.vue').default)
Vue.component('article-cats', require('./components/ArticleCategoriesComponent.vue').default)
// Vue.component('profile-service', require('./components/ProfileSpecialityComponent.vue').default)
// Vue.component('speciality-service', require('./components/ProfileServiceComponent.vue').default)
Vue.component('profile-service', require('./components/profileServicesComponent.vue').default)
Vue.component('search-hospital', require('./components/SearchHospitalsComponent.vue').default)
Vue.component('load-more-education', require('./components/LoadMoreEducationComponent.vue').default)
Vue.component('load-more-experience', require('./components/LoadMoreExperienceComponent.vue').default)
Vue.component('start-time', require('./components/SlotStartTimeComponent.vue').default)
Vue.component('custom-map', require('./components/map.vue').default)
Vue.component('book-appointment', require('./components/AppointmentBookingComponent.vue').default)
Vue.component('book-appointment-dialog', require('./components/AppointmentBookingComponentDialog.vue').default)
Vue.component('appointment-slots-dialog', require('./components/AppointmentBookingSlotsComponentDialog.vue').default)
Vue.component('appointment-slots', require('./components/AppointmentBookingSlotsComponent.vue').default)
Vue.component('dashboard-icon', require('./components/DashboardIconUploadComponent.vue').default)
Vue.component('appointments', require('./components/doctorAppointments/AppointmentsComponent.vue').default)
Vue.component('appointment-list', require('./components/doctorAppointments/AppointmentListComponent.vue').default)
Vue.component('appointment-detail', require('./components/doctorAppointments/DetailComponent.vue').default)
Vue.component('speciality-services', require('./components/SpecialityServicesComponent.vue').default)
Vue.component('vue-stars', VueStars)
Vue.component('chat', require('./components/chat/chat.vue').default)
Vue.component('chat-users', require('./components/chat/ChatUserComponent.vue').default)
Vue.component('chat-messages', require('./components/chat/ChatMessageComponent.vue').default)
Vue.component('chat-area', require('./components/chat/ChatAreaComponent.vue').default)
Vue.component('message-center', require('./components/chat/ChatComponent.vue').default)
Vue.component('emoji-textarea', require('./components/emojiTexeareaComponent.vue').default)
Vue.component('profile-speciality', require('./components/ProfileSpecialityServices/SpecialityComponent.vue').default)
Vue.component('profile-speciality-services', require('./components/ProfileSpecialityServices/ServicesComponent.vue').default)
Vue.component('edit-speciality-services', require('./components/ProfileSpecialityServices/EditServicesComponent.vue').default)
Vue.component('countdown', require('./components/CountDownComponent.vue').default)
Vue.component('upload-gallery', require('./components/GalleryUploadComponent.vue').default)

document.onreadystatechange = function () {
  if (document.readyState === 'complete') {
    jQuery('.preloader-outer').fadeOut()
  }
}

//dashboard menu init
jQuery(document).ready(function () {
  jQuery(document).on('click', '.dc-back', function (e) {
    e.preventDefault()
    jQuery('.dc-back').parents('.dc-messages-holder').removeClass('dc-openmsg')
  })

  jQuery(document).on('click', '.dc-userinbox', function (e) {
    e.preventDefault()
    jQuery('.dc-userinbox').parents('.dc-messages-holder').addClass('dc-openmsg')
  })

  /*  ADD CLASS*/
  jQuery(document).on('click', '.dc-removeform', function ($) {
    var _this = jQuery(this)
    _this.parents('.dc-headerform-holder').removeClass('show-sform')
  })

  jQuery(document).on('click', '.dc-headerform-holder .dc-searchbtn', function ($) {
    var _this = jQuery(this)
    _this.parents('.dc-headerform-holder').addClass('show-sform')
  })

  if (jQuery('.dc-verticalscrollbar').length > 0) {
    var _dc_verticalscrollbar = jQuery('.dc-verticalscrollbar')
    _dc_verticalscrollbar.mCustomScrollbar({
      axis: 'y',
    })
  }

  if (jQuery('.dc-horizontalthemescrollbar').length > 0) {
    var _dc_horizontalthemescrollbar = jQuery('.dc-horizontalthemescrollbar')
    _dc_horizontalthemescrollbar.mCustomScrollbar({
      axis: 'x',
      advanced: { autoExpandHorizontalScroll: true },
    })
  }

  if (jQuery('#dc-btnmenutoggle').length > 0) {
    jQuery('#dc-btnmenutoggle').on('click', function (event) {
      event.preventDefault()
      jQuery('#dc-wrapper').toggleClass('dc-closemenu')
      jQuery('body').toggleClass('dc-noscroll')
    })
  }

  jQuery('#dc-loginbtn, .dc-loginheader a').on('click', function (event) {
    event.preventDefault()
    jQuery('.dc-loginarea .dc-loginformhold').slideToggle()
  })

  /* MOBILE MENU*/
  jQuery('.dc-navigation ul li.menu-item-has-children').prepend('<span class="dc-dropdowarrow"><i class="lnr lnr-chevron-right"></i></span>')

  jQuery('.dc-navigation ul li.menu-item-has-children').on('click', function () {
    jQuery(this).toggleClass('dc-open')
    jQuery(this).find('.sub-menu').slideToggle(300)
  })

  jQuery('.dc-usernav ul li.menu-item-has-children').on('click', function () {
    jQuery(this).toggleClass('dc-useropen')
    jQuery(this).find('.sub-menu').slideToggle(300)
  })

  //menu display
  jQuery('.dc-wrapper.dc-haslayout .dc-navdashboard ul li.menu-item-has-children > a').on('click', function (event) {
    event.preventDefault()
    jQuery(this).parents('li').toggleClass('dc-open')
    //do nothing
    if (jQuery(this).parents('li').hasClass('dc-open')) {
      jQuery(this).parents('li').find('.sub-menu').slideDown()
    } else {
      jQuery(this).parents('li').find('.sub-menu').slideUp()
    }
  })

})

if (document.getElementById('message_center')) {
  const vmpassReset = new Vue({
    el: '#message_center',
    mounted: function () { },
    data: {},
    methods: {}
  })
}
if (document.getElementById('dashboard')) {
  const VueDashboard = new Vue({
    el: '#dashboard',
    mounted: function () { },
    data: {},
    methods: {
      remove_wishlist: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/remove-wishlist', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                //jQuery('#' + element_id).removeClass('wt-btndisbaled');
                //self.showMessage("Removed Saved Doctor");
                location.reload()
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
    }
  })
}
if (document.getElementById('home')) {
  const vuHome = new Vue({
    el: '#home',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {
      this.getWishlist()
    },
    data: {
      specialities: [],
      show_speciality: false,
      role_type: 'doctor',
      notificationSystem: {
        options: {
          theme: 'dark',
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) {
              //location.reload();
            }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              vuHome.showCompleted(vuHome.success_message)
            }
          }
        }
      },
    },
    methods: {
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      displayFilfer: function () {
        jQuery('.dc-home-advancedsearch').slideToggle(400)
        this.getSpecialities()
      },
      getSpecialities: function () {
        var self = this
        axios.get(APP_URL + '/get-specialities')
          .then(function (response) {
            if (response.data.type == 'success') {
              self.specialities = response.data.specialities
              self.show_speciality = true
            }
          })
      },
      searchByRole: function (value) {
        this.role_type = value
      },
      add_wishlist: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                jQuery('#' + element_id).addClass('wt-btndisbaled')
                jQuery('#' + element_id).addClass('wt-clicksave')
                jQuery('#' + element_id).addClass('dc-clicksave dc-btndisbaled')
                self.showMessage(response.data.message)
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      remove_wishlist: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/remove-wishlist', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                jQuery('#' + element_id).removeClass('dc-clicksave')
                self.showMessage('Removed Saved Doctor')
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      getWishlist: function () {
        var self = this
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var slug = segment_array[segment_array.length - 1]
        axios.post(APP_URL + '/profile/get-wishlist', {
          slug: slug
        })
          .then(function (response) {
            if (response.data.user_type == 'doctor') {
              if (response.data.current_doctor == 'true') {
                self.disable_btn = 'dc-btndisbaled'
                self.saved_class = 'fa fa-heart'
              }
            }
            if (response.data.current_hospital == 'true') {
              self.disable_follow = 'dc-btndisbaled'
              self.saved_class = 'fa fa-heart'
            }
          })
      },
      socialPopup: function (id) {
        jQuery('#dc-share-' + id + ' ul').slideToggle('100')
      },
      socialShare: function (url) {
        event.preventDefault()
        var popupMeta = {
          width: 400,
          height: 400
        }

        var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
          hPosition = Math.floor(($(window).height() - popupMeta.height) / 2)

        var popup = window.open(url, 'Social Share',
          'width=' + popupMeta.width + ',height=' + popupMeta.height +
          ',left=' + vPosition + ',top=' + hPosition +
          ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1')

        if (popup) {
          popup.focus()
          return false
        }

      },
    }
  })
}
if (document.getElementById('dc-header')) {
  const vueheader = new Vue({
    el: '#dc-header',
    mounted: function () { },
    data: {},
    methods: {}
  })
}
// Search bar
if (document.getElementById('dc_search_bar')) {
  const vSearchbar = new Vue({
    el: '#dc_search_bar',
    mounted: function () {
      jQuery('.dc-resetbtn').click(function () {
        document.getElementById('search_form').reset()
      })
    },
    created: function () { },
    data: {
      specialities: [],
      show_speciality: false,
      role_type: 'doctor',
    },
    methods: {
      displayFilfer: function () {
        jQuery('.dc-advancedsearch-holder').slideToggle(400)
        this.getSpecialities()
      },
      getSpecialities: function () {
        var self = this
        axios.get(APP_URL + '/get-specialities')
          .then(function (response) {
            if (response.data.type == 'success') {
              self.specialities = response.data.specialities
              self.show_speciality = true
            }
          })
      },
      searchByRole: function (value) {
        this.role_type = value
      },
    }

  })
}

// Registration
if (document.getElementById('registration')) {
  const registration = new Vue({
    el: '#registration',
    mounted: function () { },
    data: {
      notificationSystem: {
        options: {
          error: {
            position: 'topRight',
            timeout: 4000
          }
        }
      },
      step: 1,
      user_email: '',
      first_name: '',
      last_name: '',
      form_step1: {
        email_error: '',
        is_email_error: false,
        first_name_error: '',
        is_first_name_error: false,
        last_name_error: '',
        is_last_name_error: false
      },
      form_step2: {
        locations_error: '',
        is_locations_error: false,
        password_error: '',
        is_password_error: false,
        password_confirm_error: '',
        is_password_confirm_error: false,
        termsconditions_error: '',
        is_termsconditions_error: false
      },
      loading: false,
      is_show: true,
      error_message: ''
    },
    methods: {
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      prev: function () {
        this.step--
      },
      next: function () {
        this.step++
      },
      checkStep1: function (e) {
        this.loading = true
        this.form_step1.first_name_error = ''
        this.form_step1.is_first_name_error = false
        this.form_step1.last_name_error = ''
        this.form_step1.is_last_name_error = false
        this.form_step1.email_error = ''
        this.form_step1.is_email_error = false
        var self = this
        let registerForm = document.getElementById('register_form')
        let formData = new FormData(registerForm)
        axios.post(APP_URL + '/register/form-step1-custom-errors', formData)
          .then(function (response) {
            self.loading = false
            self.next()
          })
          .catch(function (error) {
            self.loading = false
            if (error.response.data.errors.first_name) {
              self.form_step1.first_name_error = error.response.data.errors.first_name[0]
              self.form_step1.is_first_name_error = true
            }
            if (error.response.data.errors.last_name) {
              self.form_step1.last_name_error = error.response.data.errors.last_name[0]
              self.form_step1.is_last_name_error = true
            }
            if (error.response.data.errors.email) {
              self.form_step1.email_error = error.response.data.errors.email[0]
              self.form_step1.is_email_error = true
            }
          })
      },
      checkStep2: function (error_message) {
        this.loading = true
        this.error_message = error_message
        let register_Form = document.getElementById('register_form')
        let form_data = new FormData(register_Form)
        this.form_step2.password_error = ''
        this.form_step2.is_password_error = false
        this.form_step2.password_confirm_error = ''
        this.form_step2.is_password_confirm_error = false
        this.form_step2.termsconditions_error = ''
        this.form_step2.is_termsconditions_error = false
        var self = this
        axios.post(APP_URL + '/register/form-step2-custom-errors', form_data)
          .then(function (response) {
            self.loading = false
            self.submitUser()
          })
          .catch(function (error) {
            self.loading = false
            if (error.response.data.errors.password) {
              self.form_step2.password_error = error.response.data.errors.password[0]
              self.form_step2.is_password_error = true
            }
            if (error.response.data.errors.password_confirmation) {
              self.form_step2.password_confirm_error = error.response.data.errors.password_confirmation[0]
              self.form_step2.is_password_confirm_error = true
            }
            if (error.response.data.errors.termsconditions) {
              self.form_step2.termsconditions_error = error.response.data.errors.termsconditions[0]
              self.form_step2.is_termsconditions_error = true
            }
          })
      },
      submitUser: function () {
        this.loading = true
        let register_Form = document.getElementById('register_form')
        let form_data = new FormData(register_Form)
        form_data.append('email', this.user_email)
        form_data.append('first_name', this.first_name)
        form_data.append('last_name', this.last_name)
        var self = this
        axios.post(APP_URL + '/register', form_data)
          .then(function (response) {
            self.loading = false
            if (response.data.type === 'success') {
              if (response.data.email === 'not_configured') {
                window.location.replace(response.data.url)
              } else {
                self.next()
              }
            } else if (response.data.type === 'error') {
              self.loading = false
              self.custom_error = true
              if (response.data.email_error) self.form_errors.push(response.data.email_error)
              if (response.data.password_error) self.form_errors.push(response.data.password_error)
            } else if (response.data.type === 'server_error') {
              self.loading = false
              self.custom_error = true
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.status === 500) {
              self.showError(self.error_message)
            }
          })
      },
      verifyCode: function () {
        this.loading = true
        let register_Form = document.getElementById('verification_form')
        let form_data = new FormData(register_Form)
        var self = this
        axios.post(APP_URL + '/register/verify-user-code', form_data)
          .then(function (response) {
            self.loading = false
            if (response.data.type === 'success') {
              self.next()
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      loginRegisterUser: function () {
        var self = this
        axios.post(APP_URL + '/register/login-register-user')
          .then(function (response) {
            if (response.data.type === 'success') {
              window.location.href = APP_URL + '/' + response.data.role + '/dashboard'
            } else if (response.data.type === 'error') {
              self.error_message = response.data.message
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      scrollTop: function () {
        var _scrollUp = jQuery('html, body')
        _scrollUp.animate({ scrollTop: 0 }, 'slow')
        jQuery('.dc-loginarea .dc-loginformhold').slideToggle()
      },
    }
  })
}

// Specialites
if (document.getElementById('specialities')) {
  const vmspecialities = new Vue({
    el: '#specialities',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () { },
    data: {
      is_show: false,
    },
    methods: {
      selectAll: function () {
        this.is_show = !this.is_show
        jQuery('#dc-speciality').change(function () {
          jQuery('input:checkbox').prop('checked', jQuery(this).prop('checked'))
        })
      },
      selectRecord: function () {
        if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
          this.is_show = true
        } else {
          this.is_show = false
        }
      }
    }

  })
}

// Categories
if (document.getElementById('cats')) {
  const vmspecialities = new Vue({
    el: '#cats',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () { },
    data: {
      is_show: false
    },
    methods: {
      selectAll: function () {
        this.is_show = !this.is_show
        jQuery('#dc-cats').change(function () {
          jQuery('input:checkbox').prop('checked', jQuery(this).prop('checked'))
        })
      },
      selectRecord: function () {
        if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
          this.is_show = true
        } else {
          this.is_show = false
        }
      }
    }
  })
}

// Locations
if (document.getElementById('locations')) {
  const vmspecialities = new Vue({
    el: '#locations',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () { },
    data: {
      is_show: false
    },
    methods: {
      selectAll: function () {
        this.is_show = !this.is_show
        jQuery('#dc-locs').change(function () {
          jQuery('input:checkbox').prop('checked', jQuery(this).prop('checked'))
        })
      },
      selectRecord: function () {
        if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
          this.is_show = true
        } else {
          this.is_show = false
        }
      }
    }
  })
}

// Services
if (document.getElementById('services')) {
  const vmServices = new Vue({
    el: '#services',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () { },
    data: {
      is_show: false
    },
    methods: {
      selectAll: function () {
        this.is_show = !this.is_show
        jQuery('#dc-services').change(function () {
          jQuery('input:checkbox').prop('checked', jQuery(this).prop('checked'))
        })
      },
      selectRecord: function () {
        if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
          this.is_show = true
        } else {
          this.is_show = false
        }
      }
    }
  })
}

// Improvement Options
if (document.getElementById('impr_opts')) {
  const vmimpr_opts = new Vue({
    el: '#impr_opts',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () { },
    data: {
      is_show: false
    },
    methods: {
      selectAll: function () {
        this.is_show = !this.is_show
        jQuery('#dc-impr_opts').change(function () {
          jQuery('input:checkbox').prop('checked', jQuery(this).prop('checked'))
        })
      },
      selectRecord: function () {
        if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
          this.is_show = true
        } else {
          this.is_show = false
        }
      }
    }
  })
}

// Settings
if (document.getElementById('settings')) {
  const settings = new Vue({
    el: '#settings',
    mounted: function () {
      // Delete Tabs
      var countTabsLength = jQuery('.service-tab-content').find('.wrap-tab-icons').length
      countTabsLength = countTabsLength - 1
      this.service_tab.count = countTabsLength
      jQuery(document).on('click', '.delete-tab', function (e) {
        e.preventDefault()
        var _this = jQuery(this)
        _this.parents('.wrap-tab-icons').remove()
      })
      // Delete HwTabs
      // var countHwTabsLength = jQuery('.hwtabs-icons-content').find('.wrap-hwtabs-icons').length
      // countHwTabsLength = countHwTabsLength - 1
      // this.hwtab.count = countHwTabsLength
      jQuery(document).on('click', '.delete-hwtab', function (e) {
        e.preventDefault()
        var _this = jQuery(this)
        _this.parents('.wrap-hwtabs-icons').remove()
      })
      // Delete Socials
      var countSocialsLength = jQuery('.social-icons-content').find('.wrap-social-icons').length
      countSocialsLength = countSocialsLength - 1
      this.social.count = countSocialsLength
      jQuery(document).on('click', '.delete-social', function (e) {
        e.preventDefault()
        var _this = jQuery(this)
        _this.parents('.wrap-social-icons').remove()
      })
    },
    data: {
      display_sidebar: true,
      display_query_section: true,
      display_get_app_sec: true,
      display_get_ad_sec: true,
      show_how_work_tabs: true,
      show_doctors_slider: true,
      enable_breadcrumbs: true,
      enable_sandbox: false,
      is_loading: false,
      show_article_sec: true,
      show_search_banner: true,
      show_about_sec: true,
      show_how_work_sec: true,
      show_services_section: true,
      show_app_sec: true,
      show_tabs: true,
      show_hwtabs: true,
      primary_color: '#3fabf3',
      secondary_color: '#ff5851',
      tertiary_color: '#3d4461',
      enable_primary_color: false,
      enable_secondary_color: false,
      enable_tertiary_color: false,
      enable_color_text: '',
      enable_social_icons: true,
      enable_topbar: true,
      enable_booking: true,
      show_contact_info_sec: true,
      show_verify_document: true,
      enable_footer_socials: true,
      is_show: false,
      display_chat: true,
      display_registration: true,
      color: '#0000',
      stored_colors: {},
      rgb: '',
      success_message: '',
      clear_cache: false,
      clear_views: false,
      clear_routes: false,
      show_search_form: true,
      language: 'en',
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000,
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) {
              location.reload()
            }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              settings.showCompleted(settings.success_message)
            }
          }
        }
      },
      service_tab: {
        service_tab_title: '',
        service_tab_subtitle: '',
        service_tab_btn_title: '',
        service_tab_btn_url: '',
        color: '',
        count: 0,
        success_message: '',
        loading: false
      },
      hwtab: {
        hwtab_title: '',
        hwtab_subtitle: '',
        hwtab_url: '',
        hwtab_img: '',
        count: 0,
        success_message: '',
        loading: false
      },
      social: {
        social_name: 'Select social icon',
        social_url: '',
        count: 0,
        success_message: '',
        loading: false
      },
      service_tabs: [],
      first_service_tab_title: '',
      first_service_tab_subtitle: '',
      first_service_tab_btn_title: '',
      first_service_tab_btn_url: '',
      first_service_tab_color: '',
      hwtabs: [],
      first_hwtab_title: '',
      first_hwtab_subtitle: '',
      first_hwtab_img: '',
      socials: [],
      first_social_name: '',
      first_social_url: '',
      first_membership_title: '',
    },
    components: { Verte },
    created: function () {
      this.getHomeSectionsDisplaySettings()
      this.getThemeColorDisplaySetting()
      this.getTopBarSwitchSettings()
      this.getFooterSettings()
      this.getHomeServiceSectionColor()
      this.getChatDisplaySetting()
      this.getSitePaymentOptions()
      this.getInnerPageSettings()
      this.getSidebarDisplaySetting()
      this.getBookingSwitchSettings()
      this.getThemeLanguageSetting()
    },
    methods: {
      getHomeServiceSectionColor: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-home-service-section-color')
          .then(function (response) {
            if (response.data.type == 'success') {
              var sections = response.data.section
              for (var key in sections) {
                if (sections.hasOwnProperty(key)) {
                  self.$set(self.stored_colors, 'color' + key, sections[key]['color'])
                }
              }
            }
          })
      },
      getHomeSectionsDisplaySettings: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-home-sections-display-settings')
          .then(function (response) {
            // How work section
            if ((response.data.show_how_work_sec === 'true')) {
              self.show_how_work_sec = true
            } else {
              self.show_how_work_sec = false
            }
            // Download App Section
            if ((response.data.show_app_sec === 'true')) {
              self.show_app_sec = true
            } else {
              self.show_app_sec = false
            }
            // About Us Section
            if ((response.data.show_about_sec === 'true')) {
              self.show_about_sec = true
            } else {
              self.show_about_sec = false
            }
            // Search Banner Section
            if ((response.data.show_search_banner === 'true')) {
              self.show_search_banner = true
            } else {
              self.show_search_banner = false
            }
            // How Work Tabs Settings
            if ((response.data.show_how_work_tabs === 'true')) {
              self.show_how_work_tabs = true
            } else {
              self.show_how_work_tabs = false
            }
            // Show Services Sections
            if ((response.data.show_services_section === 'true')) {
              self.show_services_section = true
            } else {
              self.show_services_section = false
            }
            // Show Article Sections
            if ((response.data.show_article_sec === 'true')) {
              self.show_article_sec = true
            } else {
              self.show_article_sec = false
            }
          })
      },
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      addServiceTab: function () {
        this.service_tabs.push(Vue.util.extend(
            {}, this.service_tab, this.service_tab.count++, this.$set(this.stored_colors, 'color' + this.service_tab.count, '\"#0000\"'), this.service_tab.color = this.stored_colors['color' + this.service_tab.count]
          )
        )
      },
      removeServiceTab: function (index) {
        Vue.delete(this.service_tabs, index)
      },
      addHwTab: function () {
        var countHwTabsLength = jQuery('.how-it-tab-area').find('.wrap-hwtabs-icons').length
        if (this.$refs.howlistelement) {
          this.hwtab.count = countHwTabsLength + this.$refs.howlistelement.length
        } else {
          this.hwtab.count = countHwTabsLength
        }
        this.hwtabs.push(Vue.util.extend({}, this.hwtab, this.hwtab.count++))
      },
      removeHwTab: function (index) {
        Vue.delete(this.hwtabs, index)
      },
      addSocial: function () {
        this.socials.push(Vue.util.extend({}, this.social, this.social.count++))
      },
      removeSocial: function (index) {
        Vue.delete(this.socials, index)
      },
      submitHomeSliderSettings: function () {
        let settingsSliderForm = document.getElementById('home-banner-form')
        let formData = new FormData(settingsSliderForm)
        var self = this
        self.is_loading = true
        axios.post(APP_URL + '/admin/store/home-slider-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.is_loading = false
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.is_loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.is_loading = false
            if (error.response.data.errors.slide_title_one) {
              self.showError(error.response.data.errors.slide_title_one[0])
            }
          })
      },
      submitHomeSearchBannerSettings: function () {
        let settingsSearchBannerForm = document.getElementById('home-search-banner-form')
        let formData = new FormData(settingsSearchBannerForm)
        var self = this
        axios.post(APP_URL + '/admin/store/home-search-banner-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitHomeAboutUsSettings: function () {
        let settingsAboutUsSectionForm = document.getElementById('home-aboutus-section-form')
        let formData = new FormData(settingsAboutUsSectionForm)
        var self = this
        axios.post(APP_URL + '/admin/store/home-about-us-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.btn_one_url) {
              self.showError(error.response.data.errors.btn_one_url[0])
            }
            if (error.response.data.errors.btn_two_url) {
              self.showError(error.response.data.errors.btn_two_url[0])
            }
          })
      },
      submitRegFormSettings: function () {
        let settingsRegistrationForm = document.getElementById('registration-setting-form')
        let formData = new FormData(settingsRegistrationForm)
        var self = this
        axios.post(APP_URL + '/admin/store/reg-form-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitHomeHowItWorksSettings: function () {
        let settingsHowWorks = document.getElementById('home-howworks-section-form')
        let formData = new FormData(settingsHowWorks)
        var hw_desc = tinyMCE.get('dc-hw-desc').getContent()
        formData.append('hw_desc', hw_desc)
        var self = this
        axios.post(APP_URL + '/admin/store/home-how-works-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitServicesTabSettings: function () {
        let settingsServicesTab = document.getElementById('home-services-tabs-form')
        let formData = new FormData(settingsServicesTab)
        var self = this
        axios.post(APP_URL + '/admin/store/home-service-tabs-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitSeoSettings: function () {
        let homeSeoSettings = document.getElementById('homepage-seo-form')
        let formData = new FormData(homeSeoSettings)
        var self = this
        axios.post(APP_URL + '/admin/store/home-seo-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitHwTabSectionSettings: function () {
        let settingsHwTabSection = document.getElementById('home-hwtabs-section-form')
        let formData = new FormData(settingsHwTabSection)
        var self = this
        axios.post(APP_URL + '/admin/store/home-how-work-tabs-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitDownloadAppSettings: function () {
        let settingsDownloadAppSection = document.getElementById('home-downloadapp-form')
        let formData = new FormData(settingsDownloadAppSection)
        var description = tinyMCE.get('dc-tinymceeditor').getContent()
        formData.append('description', description)
        var self = this
        axios.post(APP_URL + '/admin/store/home-download-app-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      getThemeColorDisplaySetting: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-theme-color-display-setting')
          .then(function (response) {
            // Primary Color
            if (response.data.primary_color) {
              self.primary_color = response.data.primary_color
            }
            if (response.data.secondary_color) {
              self.secondary_color = response.data.secondary_color
            }
            if (response.data.tertiary_color) {
              self.tertiary_color = response.data.tertiary_color
            }
            if ((response.data.enable_primary_color === 'true')) {
              self.enable_primary_color = true
              self.enable_color_text = 'Primary Color'
            } else {
              self.enable_primary_color = false
            }
            // Secondary Color
            if ((response.data.enable_secondary_color === 'true')) {
              self.enable_secondary_color = true
              self.enable_color_text = 'Secondary Color'
            } else {
              self.enable_secondary_color = false
            }
            // Tertiary Color
            if ((response.data.enable_tertiary_color === 'true')) {
              self.enable_tertiary_color = true
              self.enable_color_text = 'Tertiary Color'
            } else {
              self.enable_tertiary_color = false
            }
          })
      },
      getThemeLanguageSetting: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-theme-language-setting')
          .then(function (response) {
            // Tertiary Color
            if ((response.data.type === 'success')) {
              self.language = response.data.language
            } else {
              self.language = 'en'
            }
          })
      },
      getTopBarSwitchSettings: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-topbar-switch-settings')
          .then(function (response) {
            // Enable TopBar
            if ((response.data.enable_topbar === 'true')) {
              self.enable_topbar = true
            } else {
              self.enable_topbar = false
            }
            // Enable Social Icons
            if ((response.data.enable_social_icons === 'true')) {
              self.enable_social_icons = true
            } else {
              self.enable_social_icons = false
            }
          })
      },
      getBookingSwitchSettings: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-booking-switch-settings')
          .then(function (response) {
            if ((response.data.enable_booking === 'true')) {
              self.enable_booking = true
            } else {
              self.enable_booking = false
            }
          })
      },
      submitGeneralSettings: function () {
        this.is_loading = true
        let settingsForm = document.getElementById('general-setting-form')
        let formData = new FormData(settingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.is_loading = false
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.is_loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.is_loading = false
          })
      },
      submitSidebarSettings: function () {
        let sidebarSettingsForm = document.getElementById('sidebar-setting-form')
        let formData = new FormData(sidebarSettingsForm)
        var description = tinyMCE.get('dc-tinymceeditor').getContent()
        formData.append('ad_content', description)
        var self = this
        axios.post(APP_URL + '/admin/store/sidebar-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitForumSettings: function () {
        let forumSettingsForm = document.getElementById('forum-setting-form')
        let formData = new FormData(forumSettingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/forum-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitTopBarSettings: function () {
        let settingsForm = document.getElementById('topbar-setting-form')
        let formData = new FormData(settingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/topbar-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitBookingSettings: function () {
        let settingsForm = document.getElementById('booking-setting-form')
        let formData = new FormData(settingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/booking-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      importUpdate: function () {
        this.$swal({
          title: Vue.prototype.trans('lang.imprt_tables'),
          type: 'warning',
          customClass: {
            container: 'la-warning-popup',
          },
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          closeOnConfirm: true,
          closeOnCancel: true,
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            self.is_loading = true
            axios.get(APP_URL + '/admin/import-update')
              .then(function (response) {
                if (response.data.type == 'success') {
                  self.loading = false
                  window.location.replace(APP_URL + '/admin/settings/general-settings')
                } else {
                  self.loading = false
                }
              })
          } else {

          }
        })
      },
      submitSocialSettings: function () {
        let socialSettings = document.getElementById('social-settings-form')
        let data = new FormData(socialSettings)
        var self = this
        axios.post(APP_URL + '/admin/store/social-settings', data)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitFooterSettings: function () {
        let footerSettings = document.getElementById('footer-setting-form')
        let data = new FormData(footerSettings)
        var about_us_note = tinyMCE.get('dc-footertinymceeditor').getContent()
        data.append('about_us_note', about_us_note)
        var self = this
        axios.post(APP_URL + '/admin/store/footer-settings', data)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      getFooterSettings: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-footer-settings')
          .then(function (response) {
            // Enable Contact Info Area
            if ((response.data.show_contact_info_sec === 'true')) {
              self.show_contact_info_sec = true
            } else {
              self.show_contact_info_sec = false
            }
            // Enable Footer Social icons
            if ((response.data.enable_footer_socials === 'true')) {
              self.enable_footer_socials = true
            } else {
              self.enable_footer_socials = false
            }
          })
      },
      submitArticleSettings: function () {
        let articleSettingsForm = document.getElementById('home-article-section-form')
        let formData = new FormData(articleSettingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/article-section-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.title) {
              self.showError(error.response.data.errors.title[0])
            }
            if (error.response.data.errors.description) {
              self.showError(error.response.data.errors.description[0])
            }
          })
      },
      submitHomeDoctorsSliderSettings: function () {
        let articleSettingsForm = document.getElementById('home-doctors-slider-form')
        let formData = new FormData(articleSettingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/doctor-slider-section-settings', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.title) {
              self.showError(error.response.data.errors.title[0])
            }
            if (error.response.data.errors.description) {
              self.showError(error.response.data.errors.description[0])
            }
          })
      },
      getChatDisplaySetting: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-chat-display-setting')
          .then(function (response) {
            if (response.data.display_chat == 'true') {
              self.display_chat = true
            } else if (response.data.display_chat == 'false') {
              self.display_chat = false
            }
            if (response.data.display_registration == 'true') {
              self.display_registration = true
            } else if (response.data.display_registration == 'false') {
              self.display_registration = false
            }
          })
      },
      getSidebarDisplaySetting: function () {
        let self = this
        axios.get(APP_URL + '/admin/get-sidebar-display-setting')
          .then(function (response) {
            if (response.data.display_sidebar == 'true') {
              self.display_sidebar = true
            } else if (response.data.display_sidebar == 'false') {
              self.display_sidebar = false
            }
            if (response.data.display_query_section == 'true') {
              self.display_query_section = true
            } else if (response.data.display_query_section == 'false') {
              self.display_query_section = false
            }
            if (response.data.display_get_app_sec == 'true') {
              self.display_get_app_sec = true
            } else if (response.data.display_get_app_sec == 'false') {
              self.display_get_app_sec = false
            }
            if (response.data.display_get_ad_sec == 'true') {
              self.display_get_ad_sec = true
            } else if (response.data.display_get_ad_sec == 'false') {
              self.display_get_ad_sec = false
            }
          })
      },
      uploadDashboardIcons: function () {
        let uploadIconForm = document.getElementById('upload_dashboard_icon')
        let formData = new FormData(uploadIconForm)
        var self = this
        axios.post(APP_URL + '/admin/store/upload-icons', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      clearCache: function () {
        var self = this
        var clearCacheForm = document.getElementById('form-cache-clear')
        let formData = new FormData(clearCacheForm)
        this.$swal({
          title: Vue.prototype.trans('lang.clear_selected_cache'),
          type: 'warning',
          customClass: {
            container: 'la-warning-popup',
          },
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/admin/clear-cache', formData)
              .then(function (response) {
                if (response.data.type == 'success') {
                  self.loading = false
                  self.$swal(window.trans.lang.cleared, window.trans.lang.cache_cleared, 'success')
                  if (document.querySelector('.swal2-shown')) {
                    jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                  }
                } else {
                  self.loading = false
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
      clearAllCache: function () {
        var self = this
        this.$swal({
          title: Vue.prototype.trans('lang.clr_all_cache'),
          type: 'warning',
          customClass: {
            container: 'la-warning-popup',
          },
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            axios.get(APP_URL + '/admin/clear-allcache')
              .then(function (response) {
                if (response.data.type == 'success') {
                  self.loading = false
                  self.$swal(window.trans.lang.cleared, window.trans.lang.cache_cleared, 'success')
                  if (document.querySelector('.swal2-shown')) {
                    jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                  }
                } else {
                  self.loading = false
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
      importDemo: function (text) {
        var self = this
        this.$swal({
          title: text,
          type: 'warning',
          customClass: {
            container: 'la-warning-popup',
          },
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: false
        }).then((result) => {
          if (result.value) {
            self.is_loading = true
            window.location.replace(APP_URL + '/admin/import-demo')
          } else {
            this.$swal.close()
          }
        })
      },
      removeDemoContent: function (text) {
        var self = this
        this.$swal({
          title: text,
          type: 'warning',
          customClass: {
            container: 'la-warning-popup',
          },
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: false
        }).then((result) => {
          if (result.value) {
            self.is_loading = true
            window.location.replace(APP_URL + '/admin/remove-demo')
          } else {
            this.$swal.close()
          }
        })
      },
      submitChatSettings: function () {
        let chatForm = document.getElementById('submit-chat-form')
        let form_data = new FormData(chatForm)
        var self = this
        axios.post(APP_URL + '/admin/store/chat-settings', form_data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitEmailSettings: function () {
        let settingsForm = document.getElementById('email-setting-form')
        let formData = new FormData(settingsForm)
        var self = this
        axios.post(APP_URL + '/admin/store/email-settings', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitPaymentSettings: function () {
        let paymentSettings = document.getElementById('payment-form')
        let data = new FormData(paymentSettings)
        var self = this
        axios.post(APP_URL + '/admin/store/payment-settings', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }

          })
          .catch(function (error) { })
      },
      submitPaypalSettings: function () {
        let paypalSettings = document.getElementById('paypal-form')
        let data = new FormData(paypalSettings)
        var self = this
        axios.post(APP_URL + '/admin/store/paypal-settings', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.client_id) {
              self.showError(error.response.data.errors.client_id[0])
            }
            if (error.response.data.errors.paypal_password) {
              self.showError(error.response.data.errors.paypal_password[0])
            }
            if (error.response.data.errors.paypal_secret) {
              self.showError(error.response.data.errors.paypal_secret[0])
            }
          })
      },
      emailContent: function (reference) {
        this.$refs[reference].show()
      },
      submitTemplateFilter: function () {
        document.getElementById('template_filter_form').submit()
      },
      submitStripeSettings: function () {
        let stripeSettings = document.getElementById('stripe-form')
        let data = new FormData(stripeSettings)
        var self = this
        axios.post(APP_URL + '/admin/store/stripe-settings', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.stripe_key) {
              self.showError(error.response.data.errors.stripe_key[0])
            }
            if (error.response.data.errors.stripe_secret) {
              self.showError(error.response.data.errors.stripe_secret[0])
            }
          })
      },
      getSitePaymentOptions: function () {
        let self = this
        axios.get(APP_URL + '/admin/get/site-payment-option')
          .then(function (response) {
            if (response.data.enable_sandbox == 'true') {
              self.enable_sandbox = true
            } else {
              self.enable_sandbox = false
            }
          })
      },
      submitInnerPage: function () {
        let settings_form = document.getElementById('inner-page-form')
        let form_data = new FormData(settings_form)
        var self = this
        axios.post(APP_URL + '/admin/store/innerpage-settings', form_data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      getInnerPageSettings: function () {
        let self = this
        axios.post(APP_URL + '/admin/get/innerpage-settings')
          .then(function (response) {
            if ((response.data.show_search_form == 'true')) {
              self.show_search_form = true
            } else {
              self.show_search_form = false
            }
            if ((response.data.enable_breadcrumbs == 'true')) {
              self.enable_breadcrumbs = true
            } else {
              self.enable_breadcrumbs = false
            }
          })
      },
    }
  })
}
// Profile Settings
if (document.getElementById('profile_settings')) {
  const VueProfileSettings = new Vue({
    el: '#profile_settings',
    mounted: function () {
      // Delete Memberships
      var countMembershipsLength = jQuery('.membership-content').find('.wrap-membership').length
      countMembershipsLength = countMembershipsLength - 1
      this.membership.count = countMembershipsLength
      // delete gallery video
      var countvideosLength = jQuery('.video-content').find('.wrap-video').length
      countvideosLength = countvideosLength - 1
      this.video.count = countvideosLength
      jQuery(document).on('click', '.delete-video', function (e) {
        e.preventDefault()
        var _this = jQuery(this)
        _this.parents('.wrap-video').remove()
      })
    },
    created: function () { },
    data: {
      check_other: '24_hours',
      show_other_time: false,
      memberships: [],
      videos: [],
      video: {
        url: '',
        count: 0,
      },
      is_show: false,
      loading: false,
      membership: {
        membership_title: 'Enter Membership Title',
        count: 0,
        success_message: '',
        loading: false
      },
      success_message: '',
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) {
              //location.reload();
            }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              VueProfileSettings.showCompleted(VueProfileSettings.success_message)
            }
          }

        }
      }
    },
    methods: {
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      submitAwardsDownloads: function () {
        let awardsDownloadsSettings = document.getElementById('awards-downloads-form')
        let formData = new FormData(awardsDownloadsSettings)
        var self = this
        axios.post(APP_URL + '/doctor/store-award-downloads', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            }
          })
          .catch(function (error) { })
      },
      addMembership: function () {
        this.memberships.push(Vue.util.extend({}, this.membership, this.membership.count++))
      },
      onChangeStartTimeImmediatefrom (time, timeString) {
        document.getElementById('immediatefrom').value = timeString
      },
      onChangeStartTimeImmediateto (time, timeString) {
        document.getElementById('immedicateto').value = timeString
      },
      removeMembership: function (index) {
        Vue.delete(this.memberships, index)
      },
      addVideo: function () {
        this.videos.push(Vue.util.extend({}, this.video, this.video.count++))
      },
      removeVideo: function (index) {
        Vue.delete(this.videos, index)
      },
      deleteAttachment: function (id) {
        jQuery('#' + id).remove()
      },
      checkOther: function (value) {
        console.log(value)
        if (value == 'other') {
          this.show_other_time = true
        } else {
          this.show_other_time = false
        }
      },
      submitPersonalDetails: function (role) {
        let docPersonalSettings = document.getElementById('submit-personal-details')
        let formData = new FormData(docPersonalSettings)
        var self = this
        axios.post(APP_URL + '/' + role + '/store-personal-detail', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.first_name) {
              self.showError(error.response.data.errors.first_name[0])
            }
            if (error.response.data.errors.last_name) {
              self.showError(error.response.data.errors.last_name[0])
            }
            if (error.response.data.errors.email && role == 'admin') {
              self.showError(error.response.data.errors.email[0])
            }
          })
      },
      uploadGallery: function (role) {
        let uploadGallery = document.getElementById('gallery-upload')
        let formData = new FormData(uploadGallery)
        var self = this
        axios.post(APP_URL + '/' + role + '/store-gallery', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
          })
      },
      submitRegistrationDetails: function () {
        let docRegistrationSettings = document.getElementById('submit-registration-details')
        let formData = new FormData(docRegistrationSettings)
        var self = this
        axios.post(APP_URL + '/user/store-registration-detail', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.registration_number) {
              self.showError(error.response.data.errors.registration_number[0])
            } else if (error.response.data.errors.registration_document) {
              self.showError(error.response.data.errors.registration_document[0])
            }
          })
      },
      submitExperiences: function () {
        let settingsExperiences = document.getElementById('experience-form')
        let formData = new FormData(settingsExperiences)
        var self = this
        axios.post(APP_URL + '/doctor/store/experiences', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitEducations: function () {
        let settingsEducation = document.getElementById('education-form')
        let formData = new FormData(settingsEducation)
        var self = this
        axios.post(APP_URL + '/doctor/store/educations', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      submitServices: function () {
        let settingsExperiences = document.getElementById('manage-services-form')
        let formData = new FormData(settingsExperiences)
        var self = this
        axios.post(APP_URL + '/user/store/services', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else if (response.data.type === 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
    }

  })
}
// Account Settings
if (document.getElementById('account_settings')) {
  const VueAccountSettings = new Vue({
    el: '#account_settings',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {
      this.getUserSearchableData()
    },
    ready: function () {
      this.deleteAccount()
    },
    data: {
      profile_searchable: true,
      disable_account: false,
      is_show: false,
      is_loading: false,
      role_updated: false,
      success_message: '',
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) {
              //location.reload();
            }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              VueAccountSettings.showCompleted(VueAccountSettings.success_message)
            }
          }
        }
      }
    },
    methods: {
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      submitSecuritySettings: function () {
        let docRegistrationSettings = document.getElementById('submit-registration-details')
        let formData = new FormData(docRegistrationSettings)
        var self = this
        axios.post(APP_URL + '/doctor/store-registration-detail', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.registration_number) {
              self.showError(error.response.data.errors.registration_number[0])
            } else if (error.response.data.errors.registration_document) {
              self.showError(error.response.data.errors.registration_document[0])
            }
          })
      },
      verifiedUser: function (element_id, id, type) {
        this.is_loading = true
        var self = this
        axios.post(APP_URL + '/admin/update/medical-verify', {
          user_id: id,
          type: type
        })
          .then(function (response) {
            self.is_loading = false
            if (response.data.type === 'success') {
              jQuery('#' + element_id).find('a').text(response.data.status_text)
              self.showMessage(response.data.message)
            }
          })
          .catch(function (error) {
            self.is_loading = false
          })
      },
      verifiedFeedback: function (element_id, id, type) {
        this.is_loading = true
        var self = this
        axios.post(APP_URL + '/admin/update/feedback-verify', {
          feedback_id: id,
          type: type
        })
          .then(function (response) {
            self.is_loading = false
            if (response.data.type === 'success') {
              jQuery('#' + element_id).find('a').text(response.data.status_text)
              self.showMessage(response.data.message)
            }
          })
          .catch(function (error) {
            self.is_loading = false
          })
      },
      getUserSearchableData: function () {
        let self = this
        axios.get(APP_URL + '/profile/settings/get-user-searchable-settings')
          .then(function (response) {
            if (response.data.type == 'success') {
              if ((response.data.profile_searchable == 'true')) {
                self.profile_searchable = true
              } else {
                self.profile_searchable = false
              }
              if ((response.data.disable_account == 'true')) {
                self.disable_account = true
              } else {
                self.disable_account = false
              }
            }
          })
      },
      deleteAccount: function (event) {
        var self = this
        var delete_acc_form = document.getElementById('delete_acc_form')
        let form_data = new FormData(delete_acc_form)
        this.$swal({
          title: 'Delete Account',
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          if (result.value) {
            VueAccountSettings.is_loading = true
            axios.post(APP_URL + '/user/settings/delete-account', form_data)
              .then(function (response) {
                if (response.data.type === 'warning') {
                  self.showError(response.data.msg)
                  VueAccountSettings.is_loading = false
                } else {
                  setTimeout(function () {
                      swal({
                        type: 'success',
                      })
                      VueAccountSettings.is_loading = false
                    },
                    self.showCompleted(response.data.acc_del), 1000)
                  window.location.href = APP_URL + '/'
                }
              })
              .catch(function (error) {
                self.is_loading = false
                if (error.response.data.errors.old_password) {
                  self.showError(error.response.data.errors.old_password[0])
                }
                if (error.response.data.errors.retype_password) {
                  self.showError(error.response.data.errors.retype_password[0])
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
      deleteUser: function (event) {
        var self = this
        var delete_acc_form = document.getElementById('delete_acc_form')
        let form_data = new FormData(delete_acc_form)
        this.$swal({
          title: Vue.prototype.trans('lang.delete_account'),
          type: 'warning',
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          closeOnConfirm: true,
          closeOnCancel: true,
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/admin/delete-user', form_data)
              .then(function (response) {
                if (response.data.type === 'warning') {
                  self.showError(response.data.msg)
                } else {
                  setTimeout(function () {
                      swal({
                        type: 'success'
                      })
                    },
                    self.showInfo(response.data.acc_del), 1000)
                  window.location.href = APP_URL + '/'
                }
              })
              .catch(function (error) {
                if (error.response.data.errors.old_password) {
                  self.showError(error.response.data.errors.old_password[0])
                }
                if (error.response.data.errors.retype_password) {
                  self.showError(error.response.data.errors.retype_password[0])
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
      changeRole: function (elementId, role) {
        let selectedRole = document.getElementById(elementId)
        if (selectedRole.value == role) {
          this.role_updated = false
        } else {
          this.role_updated = true
        }
      },
      updateUserProfile: function (id, roleWarningTitle, roleNote) {
        if (this.role_updated == true) {
          this.$swal({
            title: roleWarningTitle,
            text: roleNote,
            type: 'warning',
            showCancelButton: true,
            customClass: {
              container: 'la-warning-popup',
            },
            confirmButtonClass: 'btn-danger',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            showLoaderOnConfirm: true
          }).then(result => {
            var self = this
            if (result.value) {
              self.is_loading = true
              let PersonalSettings = document.getElementById('edit-user-details')
              let formData = new FormData(PersonalSettings)
              formData.append('id', id)
              axios.post(APP_URL + '/admin/edit-user-detail', formData)
                .then(function (response) {
                  if (response.data.type === 'success') {
                    self.is_loading = false
                    self.showInfo(response.data.progressing)
                    self.success_message = response.data.message
                    setTimeout(function () {
                      window.location.href = APP_URL + '/users'
                    }, 1000)

                  } else {
                    self.is_loading = false
                    self.showError(response.data.message)
                  }
                })
                .catch(function (error) {
                  self.is_loading = false
                  if (error.response.data.errors.email) {
                    self.showError(error.response.data.errors.email[0])
                  }
                })
            } else {
              this.$swal.close()
            }
          })
        } else {
          this.is_loading = true
          let PersonalSettings = document.getElementById('edit-user-details')
          let formData = new FormData(PersonalSettings)
          formData.append('id', id)
          var self = this
          axios.post(APP_URL + '/admin/edit-user-detail', formData)
            .then(function (response) {
              if (response.data.type === 'success') {
                self.is_loading = false
                self.showInfo(response.data.progressing)
                self.success_message = response.data.message
                window.location.href = APP_URL + '/users'
              } else {
                self.is_loading = false
                self.showError(response.data.message)
              }
            })
            .catch(function (error) {
              self.is_loading = false
              if (error.response.data.errors.email) {
                self.showError(error.response.data.errors.email[0])
              }
            })
        }
      },
      createUser: function () {
        this.is_loading = true
        let createUserForm = document.getElementById('create-user-details')
        let formData = new FormData(createUserForm)
        var self = this
        axios.post(APP_URL + '/admin/create-user', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.is_loading = false
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else {
              self.is_loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.is_loading = false
            if (error.response.data.errors.first_name) {
              self.showError(error.response.data.errors.first_name[0])
            }
            if (error.response.data.errors.last_name) {
              self.showError(error.response.data.errors.last_name[0])
            }
            if (error.response.data.errors.email) {
              self.showError(error.response.data.errors.email[0])
            }
            if (error.response.data.errors.password) {
              self.showError(error.response.data.errors.password[0])
            }
            if (error.response.data.errors.role) {
              self.showError(error.response.data.errors.role[0])
            }
          })
      },
    },
  })
}

// Articles
if (document.getElementById('articles')) {
  const vueArticles = new Vue({
    el: '#articles',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {
      this.getFeaturedArticle()
    },
    ready: function () {
    },
    data: {
      is_featured: false,
      is_show: false,
      loading: false,
      success_message: '',
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) {
              location.reload()
            }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              vueArticles.showCompleted(vueArticles.success_message)
            }
          }
        }
      }
    },
    methods: {
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      socialPopup: function (id) {
        jQuery('#dc-share-' + id + ' ul').slideToggle('100')
      },
      socialShare: function (url) {
        event.preventDefault()
        var popupMeta = {
          width: 400,
          height: 400
        }

        var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
          hPosition = Math.floor(($(window).height() - popupMeta.height) / 2)

        var popup = window.open(url, 'Social Share',
          'width=' + popupMeta.width + ',height=' + popupMeta.height +
          ',left=' + vPosition + ',top=' + hPosition +
          ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1')

        if (popup) {
          popup.focus()
          return false
        }

      },
      sendAppLink: function () {
        let form = document.getElementById('download-app')
        let data = new FormData(form)
        var self = this
        this.loading = true
        axios.post(APP_URL + '/send/app-link', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
            } else {
              self.loading = false
              self.showError(response.data.message)
            }
          })
      },
      postArticle: function () {
        let articleForm = document.getElementById('create-article-form')
        let formData = new FormData(articleForm)
        var description = tinyMCE.get('article-desc').getContent()
        formData.append('description', description)
        var self = this
        axios.post(APP_URL + '/post/article', formData)
          .then(function (response) {
            if (response.data.type === 'cat-required') {
              self.showError(response.data.message)
            }
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.title) {
              self.showError(error.response.data.errors.title[0])
            }
            if (error.response.data.errors.description) {
              self.showError(error.response.data.errors.description[0])
            }
          })
      },
      updateArticle: function (id) {
        let updateArticleForm = document.getElementById('update-article-form')
        let formData = new FormData(updateArticleForm)
        var description = tinyMCE.get('article-desc').getContent()
        formData.append('description', description)
        formData.append('article_id', id)
        var self = this
        axios.post(APP_URL + '/update/article', formData)
          .then(function (response) {
            if (response.data.type === 'cat-required') {
              self.showError(response.data.message)
            }
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
              window.location.replace(APP_URL + '/create-article')
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.title) {
              self.showError(error.response.data.errors.title[0])
            }
            if (error.response.data.errors.description) {
              self.showError(error.response.data.errors.description[0])
            }
          })
      },
      getFeaturedArticle: function () {
        let self = this
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var slug = segment_array[segment_array.length - 1]
        axios.post(APP_URL + '/get/featured-article', {
          article_slug: slug
        })
          .then(function (response) {
            if ((response.data.is_featured == '1')) {
              self.is_featured = true
            } else {
              self.is_featured = false
            }
          })
      },
      add_wishlist: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                jQuery('#' + element_id).addClass('wt-btndisbaled')
                jQuery('#' + element_id).addClass('wt-clicksave')
                jQuery('#' + element_id).addClass('dc-clicksave dc-btndisbaled')
                self.showMessage(response.data.message)
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      getWishlist: function () {
        var self = this
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var slug = segment_array[segment_array.length - 1]
        axios.post(APP_URL + '/profile/get-wishlist', {
          slug: slug
        })
          .then(function (response) {
            if (response.data.user_type == 'doctor') {
              if (response.data.current_doctor == 'true') {
                self.disable_btn = 'dc-btndisbaled'
                self.saved_class = 'fa fa-heart'
              }
            }
            if (response.data.current_hospital == 'true') {
              self.disable_follow = 'dc-btndisbaled'
              self.saved_class = 'fa fa-heart'
            }
          })
      },
    }
  })
}

// Show Profile
if (document.getElementById('user-profile')) {
  const vueUserProfile = new Vue({
    el: '#user-profile',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }

      if (document.getElementById('sessionparametercheck').value != '') {
        //   console.log("Mounted time");
        // setTimeout(function() {
        //     	this.showModal('appointment_modal', '', '1', '1' );

        this.$session.start()
        if (this.$session.exists('sessionparametercheck')) {
          this.$session.destroy()
        }
        // }, 3000);
      }
    },
    data: {
      step: 1,
      is_featured: false,
      is_show: false,
      loading: false,
      success_message: '',
      click_to_save: 'dc-like',
      disable_btn: '',
      saved_class: '',
      heart_class: 'far fa-heart',
      text: 'Click to Save',
      follow_text: 'Click To Follow',
      article_likes: 0,
      show_likes: false,
      disable_follow: '',
      selected_hospital: '',
      hospital_services: [],
      services_prices: [],
      password_mismatch: true,
      loadingWizard: false,
      appointment_last_id: '',
      sort_by: null,
      order: 'asc',
      AppointmentmodalShow: true,
      step: 1,
      app: {
        email: '',
      },
      appointment: {
        user_id: '',
        patient: '',
        patient_name: '',
        relation: '',
        hospital: '',
        speciality: [],
        total_charges: '',
        comments: '',
        day: '',
        date: '',
        time: '',
        password: '',
        retry_password: '',
        code: '',
      },
      report: {
        email: '',
        description: '',
        id: '',
        user_id: '',
        model: 'App\\User',
        report_type: '',
      },
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            id: 'info_notify'
          }
        }
      }
    },
    methods: {
      displayServices: function (id) {
        console.log(id)
        jQuery('#' + id).css('display', 'none')
        jQuery('#' + id).parents('.dc-tags').find('ul li').css('display', 'block')
      },
      socialPopup: function (id) {
        jQuery('#dc-share-' + id + ' ul').slideToggle('100')
      },
      socialShare: function (url) {
        event.preventDefault()
        var popupMeta = {
          width: 400,
          height: 400
        }

        var vPosition = Math.floor(($(window).width() - popupMeta.width) / 2),
          hPosition = Math.floor(($(window).height() - popupMeta.height) / 2)

        var popup = window.open(url, 'Social Share',
          'width=' + popupMeta.width + ',height=' + popupMeta.height +
          ',left=' + vPosition + ',top=' + hPosition +
          ',location=0,menubar=0,toolbar=0,status=0,scrollbars=1,resizable=1')

        if (popup) {
          popup.focus()
          return false
        }

      },
      prev: function () {
        this.step--
      },
      next: function () {
        this.step++
      },
      resultSortBy: function (key, value) {
        var params = new URLSearchParams(window.location.search)
        if (key == 'sort_by') {
          this.sort_by = value
        } else if (key == 'order_by') {
          this.order = value
        }
        params.delete(key)
        params.append(key, value)
        window.location.replace(APP_URL + '/search-results?' + params)
      },

      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      profiledialogsetting: function (immediatebooking = '') {
        console.log('start run')
        setTimeout(function () {
          console.log('time run')
          this.showModal('appointment_modal', '', '', immediatebooking)
        }, 3000)
      },
      showModal: function (reference, authentication = '', count = '', immediatebooking = '') {
        if (authentication == 'not_authorise') {
          return this.showError(Vue.prototype.trans('lang.login_as_regular'))
        }
        if (reference == 'appointment_modal') {
          if (count == 0) {
            return this.showError(Vue.prototype.trans('lang.cannot_perform'))
          } else {
            this.step = 1
            this.appointment = {},
              this.$refs[reference].show()
          }
        } else if (reference == 'search_appointment_modal') {
          console.log(count)
          console.log('press appointment')
          this.$refs[reference].show()
        } else if (reference == 'feedback_modal') {
          this.$refs[reference].show()
        } else {
          this.$refs[reference].show()
        }
      },
      add_wishlist: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/add-wishlist', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                if (column == 'saved_doctors') {
                  jQuery('#' + element_id).addClass('wt-btndisbaled')
                  jQuery('#' + element_id).addClass('wt-clicksave')
                  jQuery('#' + element_id).addClass('dc-clicksave dc-btndisbaled')
                } else if (column == 'saved_hospitals') {
                  jQuery('#' + element_id).addClass('wt-btndisbaled')
                  jQuery('#' + element_id).addClass('wt-clicksave')
                  jQuery('#' + element_id).addClass('dc-clicksave dc-btndisbaled')
                } else if (column == 'saved_articles') {
                  self.article_likes = response.data.likes
                  self.show_likes = true
                  jQuery('#' + element_id).addClass('wt-btndisbaled')
                  jQuery('#' + element_id).addClass('wt-clicksave')
                  jQuery('#' + element_id).addClass('dc-clicksave dc-btndisbaled')
                }
                self.showMessage(response.data.message)
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      remove_wishlist: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/remove-wishlist', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                jQuery('#' + element_id).removeClass('dc-clicksave')
                self.showMessage('Removed Saved Doctor')
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      getWishlist: function () {
        var self = this
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var slug = segment_array[segment_array.length - 1]
        axios.post(APP_URL + '/profile/get-wishlist', {
          slug: slug
        })
          .then(function (response) {
            if (response.data.user_type == 'doctor') {
              if (response.data.current_doctor == 'true') {
                self.disable_btn = 'dc-btndisbaled'
                self.saved_class = 'fa fa-heart'
              }
            }
            if (response.data.current_hospital == 'true') {
              self.disable_follow = 'dc-btndisbaled'
              self.saved_class = 'fa fa-heart'
            }
          })
      },
      submitReport: function (id) {
        var self = this
        self.report.user_id = id
        self.loading = true
        axios.post(APP_URL + '/submit-report', self.report)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
              self.report = ''
            } else if (response.data.type == 'error') {
              self.loading = false
              self.showError(response.data.message)
            }
          })
          .catch(error => {
            self.loading = false
            if (error.response.status == 422) {
              if (error.response.data.errors.name) {
                self.showError(error.response.data.errors.name[0])
              }
              if (error.response.data.errors.email) {
                self.showError(error.response.data.errors.email[0])
              }
              if (error.response.data.errors.description) {
                self.showError(error.response.data.errors.description[0])
              }
            }
          })
      },
      refreshAppointmentForm: function () {
        // this.$refs.appointment_form.reset();
      },
      checkAppointmentStep1: function () {
        var patient = jQuery('input[name=\'patient\']:checked').val()
        if (patient == 'someone') {
          var patient_name = document.getElementById('patient_name').value
          var form_errors = []
          if (!patient_name) form_errors.push(Vue.prototype.trans('lang.patient_name_req'))
          if (!document.getElementById('relation').value) form_errors.push(Vue.prototype.trans('lang.select_relation_req'))
          form_errors.forEach(element => {
            this.showError(element)
          })
          if (form_errors.length > 0) {
            return false
          }
          form_errors = []
        }
        // if (document.getElementById('appointment_hospital').selectedIndex > 0) {
        var timeSlot = document.getElementsByName('appointment[time]')
        var isTimeSlot = false
        for (var i = 0; i < timeSlot.length; i++) {
          if (timeSlot[i].checked) {
            isTimeSlot = true
            break
          }
        }
        if (isTimeSlot == true) {
          let submitAppointmentForm = document.getElementById('submit_appointment_form')
          let formData = new FormData(submitAppointmentForm)
          console.log(formData)
          var self = this
          axios.post(APP_URL + '/store-appointment-data', formData)
            .then(function (response) {
              self.appointment.patient = response.data.patient
              self.appointment.comments = response.data.comments
              self.appointment.date = response.data.date
              self.appointment.day = response.data.day
              self.appointment.hospital = response.data.hospital
              self.appointment.patient_name = response.data.patient_name
              self.appointment.relation = response.data.relation
              self.appointment.speciality = response.data.speciality
              self.appointment.time = response.data.time
              self.appointment.total_charges = response.data.total_charges
              self.next()
            })
        } else {
          this.showError(Vue.prototype.trans('lang.select_appointment_time'))
          return false
        }
        // } else {
        //     if (document.getElementById('appointment_hospital').selectedIndex <= 0) {
        //         this.showError(Vue.prototype.trans('lang.hospital_req'))
        //         return false;
        //     }
        // }
      },
      checkAppointmentStep2: function (id, submitid) {
        if (id && this.appointment.password && this.appointment.retry_password) {
          if (this.appointment.password != this.appointment.retry_password) {
            this.showError(Vue.prototype.trans('lang.pass_mismatched'))
            return false
          }
          var self = this
          self.loading = true
          axios.post(APP_URL + '/verify-appointment-password', {
            user_id: id,
            password: self.appointment.password,
            retry_password: self.appointment.retry_password,
          })
            .then(function (response) {
              if (response.data.type == 'success') {
                self.loading = false
                //self.next();
                self.submitAppointment(submitid)
              } else if (response.data.type == 'error') {
                self.loading = false
                self.showError(response.data.message)
              }
            }).catch(error => {
            self.loading = false
          })
        } else {
          var form_errors = []
          if (!id) form_errors.push(Vue.prototype.trans('lang.something_wrong'))
          if (!this.appointment.password) form_errors.push(Vue.prototype.trans('lang.password_required'))
          if (!this.appointment.retry_password) form_errors.push(Vue.prototype.trans('lang.retry_password_required'))
          form_errors.forEach(element => {
            this.showError(element)
          })
        }
      },
      selectconferenceplatform: function (platformname) {
        document.getElementById('videoconferenceseting').value = platformname
        if (platformname == 'zoom') {
          var elementzoom = document.getElementById('gotomeetingimgid')
          elementzoom.classList.remove('selected')
          var elementzoom = document.getElementById('zoomimgid')
          elementzoom.classList.add('selected')
        } else {
          var elementzoom = document.getElementById('gotomeetingimgid')
          elementzoom.classList.add('selected')
          var elementzoom = document.getElementById('zoomimgid')
          elementzoom.classList.remove('selected')
        }
      },
      checkAppointmentStep3: function (user_id) {
        var self = this
        axios.post(APP_URL + '/verify-appointment-code', {
          code: self.appointment.code,
        })
          .then(function (response) {
            if (response.data.type == 'success') {
              self.submitAppointment(user_id)
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
      },
      submitAppointment: function (id) {
        var self = this
        console.log(id)
        self.loading = true
        self.appointment.user_id = id
        self.appointment.videoplatform = document.getElementById('videoconferenceseting').value
        if (document.getElementById('booknowoptioncheck').value == 'now') {
          self.appointment.meetingtime = 'now'
        } else {
          self.appointment.meetingtime = 'later'
        }
        axios.post(APP_URL + '/submit-appointment', self.appointment)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.appointment_last_id = response.data.appointment_id
              self.finalStep()
            } else if (response.data.type == 'error') {
              self.loading = false
              self.showError(response.data.message)
            }
          })
          .catch(error => {

          })
      },
      finalStep: function () {
        var selectconferenceitems = document.getElementById('videoconferenceseting').value
        if (document.getElementById('booknowoptioncheck').value == 'now') {
          //window.location.replace(APP_URL + '/checkout/' + this.appointment_last_id + '/true/' + selectconferenceitems);
          window.open(APP_URL + '/checkout/' + this.appointment_last_id + '/true/' + selectconferenceitems, 'payment')
        } else {
          // window.location.replace(APP_URL + '/checkout/' + this.appointment_last_id + '/false/' + selectconferenceitems);
          window.open(APP_URL + '/checkout/' + this.appointment_last_id + '/false/' + selectconferenceitems, 'payment')
        }
        this.$refs['appointment_modal'].hide()
        // if (online_appointment == true) {
        //window.open(APP_URL + '/checkout/' + this.appointment_last_id)
        //	  var delayInMilliseconds = 1000; //1 second
        //	setTimeout(function() {
        //		window.location.replace(APP_URL + '/paypal/ec-checkout');
        //	}, delayInMilliseconds);
        //    window.location.replace(APP_URL + '/paypal/ec-checkout')
        // } else {
        //   window.location.replace(APP_URL + '/patient/appoinements/' + this.appointment_last_id)
        // }

      },
      getStriprForm: function () {
        var self = this
        axios.post(APP_URL + '/stripe/generate-order')
          .then(function (response) {
            console.log(response.data)
            if (response.data.type == 'success') {
              self.$refs.appointmentCheckout.show()
            }
          })
          .catch(function (error) {
            console.log(error)
          })

      },
      submitStripeFrom: function () {
        this.loading = true
        let stripe_payment = document.getElementById('stripe-payment-form')
        let data = new FormData(stripe_payment)
        var self = this
        axios.post(APP_URL + '/addmoney/stripe', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
              setTimeout(function () {
                window.location.replace(response.data.url)
              }, 3000)
            } else if (response.data.type == 'error') {
              self.loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.loading = false
            console.log(error)
          })
      },
      submitFeedback: function (user_id) {

        this.loading = true
        let feedbackForm = document.getElementById('submit-feedback')
        let data = new FormData(feedbackForm)
        var time = jQuery('#time').val()
        //var radioValue = $("input[name='votes']:checked").val();
        data.append('waiting_time', time)
        data.append('doctor_id', user_id)
        var self = this
        axios.post(APP_URL + '/submit-feedback', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.$refs['feedback_modal'].hide()
              self.showMessage(response.data.message)
            } else if (response.data.type == 'error') {
              self.loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.loading = false
            console.log(error)
          })
      },
      sendAppLink: function () {
        // let form = document.getElementById('download-app');
        // let data = new FormData(form);
        var self = this
        this.loading = true
        axios.post(APP_URL + '/send/app-link', {
          email: self.app.email
        })
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
              self.app.email = ''
            } else {
              self.loading = false
              self.showError(response.data.message)
            }
          })
      },
    }
  })
}
// appointments
if (document.getElementById('appointment_locations')) {
  const vappointments = new Vue({
    el: '#appointment_locations',
    components: { DatePick },
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {

    },
    data: {
      start_time: '',
      duration: Vue.prototype.trans('lang.select_duration'),
      no_of_slot: 1,
      appointment_days: [],
      intervals: Vue.prototype.trans('lang.select_interval'),
      end_time: null,
      is_show: false,
      loading: false,
      appointment_space: 1,
      custom_time: '',
      success_message: '',
      show_slot_form_mon: false,
      show_slot_form_tue: false,
      show_slot_form_wed: false,
      show_slot_form_thu: false,
      show_slot_form_fri: false,
      show_slot_form_sat: false,
      show_slot_form_sun: false,
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) { }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              vappointments.showCompleted(vappointments.success_message)
            }
          }
        }
      },
    },
    methods: {
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      moment,
      selectedSpace: function (space) {
        if (space == 'other') {
          this.is_show = true
        } else {
          this.is_show = false
        }
      },
      showAddSlotForm: function (day) {
        this[day] = true
      },
      submitAppointmentLocation: function () {
        this.loading = true
        var hospital = ''
        var search_hospital = document.getElementById('hospital_hidden_field')
        if (search_hospital) {
          hospital = document.getElementById('hospital_hidden_field').value
        }
        var custom_appt_spaces = ''
        var custom_appt = document.getElementById('custom_appt_spaces')
        if (custom_appt) {
          custom_appt_spaces = document.getElementById('custom_appt_spaces').value
        }
        // let service = document.getElementById('location_service').value;
        var start_time = document.getElementById('location_start_time').value
        var consultation_fee = document.getElementById('consultation_fee').value
        let settingsSliderForm = document.getElementById('appointment-location-form')
        let formData = new FormData(settingsSliderForm)
        formData.append('hospital_id', hospital)
        var self = this
        if (hospital && start_time && (self.duration || self.duration != 'Select Duration')
          && (self.intervals || self.intervals == Vue.prototype.trans('lang.select_interval'))
          && self.appointment_space && self.appointment_days.length > 0 && consultation_fee) {
          axios.post(APP_URL + '/doctor/store/appointment-location', formData)
            .then(function (response) {
              if (response.data.type === 'success') {
                self.loading = false
                self.showInfo(response.data.progressing)
                self.success_message = response.data.message
                location.reload()
              } else {
                self.loading = false
                self.showError(response.data.message)
              }
            })
            .catch(function (error) {

            })
        } else {
          this.loading = false
          var form_errors = []
          if (!hospital) form_errors.push(Vue.prototype.trans('lang.hospital_req'))
          if (!consultation_fee) form_errors.push(Vue.prototype.trans('lang.consultation_fee_req'))
          if (!custom_appt_spaces) form_errors.push(Vue.prototype.trans('lang.appt_spaces_req'))
          //if (!service) form_errors.push(Vue.prototype.trans('lang.service_req'));
          if (!start_time) form_errors.push(Vue.prototype.trans('lang.start_time_req'))
          if (!self.duration || self.duration == Vue.prototype.trans('lang.select_duration')) form_errors.push(Vue.prototype.trans('lang.duration_req'))
          if (!self.intervals || self.intervals == Vue.prototype.trans('lang.select_interval')) form_errors.push(Vue.prototype.trans('lang.interval_field_req'))
          if (!self.appointment_space) form_errors.push(Vue.prototype.trans('lang.appt_spaces_req'))
          if (self.appointment_days.length == 0) form_errors.push(Vue.prototype.trans('lang.select_appt_days'))
          form_errors.forEach(element => {
            self.showError(element)
          })
        }

      },
      deleteSlot: function (element_id, slot_id, day, id, delete_title, final_msg, message) {
        this.$swal({
          title: delete_title,
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then(result => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/doctor/delete-slots/' + slot_id + '/' + day + '/' + id)
              .then(function (response) {
                if (response.data.type === 'success') {
                  self.$swal(final_msg, message, 'success')
                  jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                  jQuery('#' + element_id).remove()
                } else {
                  self.showError(response.data.message)
                }
              })
              .catch(function (error) { })
          } else {
            this.$swal.close()
          }
        })
      },
      deleteAppointSet: function (id, delete_title, final_msg, message) {
        this.$swal({
          title: delete_title,
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then(result => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/doctor/delete-appointset/' + id)
              .then(function (response) {
                if (response.data.type === 'success') {
                  self.$swal(final_msg, message, 'success')
                  jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                  jQuery('#appointsetidcheck' + id).remove()
                } else {
                  self.showError(response.data.message)
                }
              })
              .catch(function (error) { })
          } else {
            this.$swal.close()
          }
        })
      },
      deleteAllSlot: function (element_id, day, id, delete_title, final_msg, message) {
        this.$swal({
          title: delete_title,
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then(result => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/doctor/delete-all-slots/' + day + '/' + id)
              .then(function (response) {
                if (response.data.type === 'success') {
                  jQuery('#' + element_id).remove()
                  location.reload()
                } else {
                  self.showError(response.data.message)
                }
              })
              .catch(function (error) { })
          } else {
            this.$swal.close()
          }
        })
      },
      updateSlots: function (day, id, form_id, start_time_id) {
        this.is_loading = true
        var custom_appt_spaces = ''
        var custom_appt = document.getElementById('custom_appt_spaces-' + day)
        if (custom_appt) {
          custom_appt_spaces = document.getElementById('custom_appt_spaces-' + day).value
        }
        var start_time = document.getElementById(start_time_id + day).value
        let slot_update_form = document.getElementById(form_id)
        let formData = new FormData(slot_update_form)
        formData.append('day', day)
        var self = this
        if (start_time && (self.duration || self.duration == Vue.prototype.trans('lang.select_duration'))) {
          axios.post(APP_URL + '/doctor/update/slots/' + id, formData)
            .then(function (response) {
              if (response.data.type === 'success') {
                self.is_loading = false
                self.showInfo(response.data.progressing)
                self.success_message = response.data.message
                setTimeout(function () {
                  location.reload()
                }, 4000)
              } else {
                self.is_loading = false
                self.showError(response.data.message)
              }
            })
            .catch(function (error) {
              self.is_loading = false
            })
        } else {
          this.is_loading = false
          var form_errors = []
          if (custom_appt) {
            if (!custom_appt_spaces) form_errors.push(Vue.prototype.trans('lang.appt_spaces_req'))
          }
          if (!start_time) form_errors.push(Vue.prototype.trans('lang.start_time_req'))
          if (!self.duration || self.duration == Vue.prototype.trans('lang.select_duration')) form_errors.push(Vue.prototype.trans('lang.duration_req'))
          form_errors.forEach(element => {
            self.showError(element)
          })
        }
      },
      updateDaySlots: function (day, id, form_id, start_time_id) {
        this.is_loading = true
        var custom_appt_spaces = ''
        var custom_appt = document.getElementById('custom_appt_spaces-' + day)
        if (custom_appt) {
          custom_appt_spaces = document.getElementById('custom_appt_spaces-' + day).value
        }
        var start_time = document.getElementById(start_time_id + day).value
        let slot_update_form = document.getElementById(form_id)
        let formData = new FormData(slot_update_form)
        formData.append('day', day)
        var self = this
        if (start_time && (self.duration || self.duration == Vue.prototype.trans('lang.select_duration'))) {
          axios.post(APP_URL + '/doctor/update-day-slots/' + id, formData)
            .then(function (response) {
              if (response.data.type === 'success') {
                self.is_loading = false
                self.showInfo(response.data.progressing)
                self.success_message = response.data.message
                setTimeout(function () {
                  location.reload()
                }, 4000)
              } else {
                self.is_loading = false
                self.showError(response.data.message)
              }
            })
            .catch(function (error) {
              self.is_loading = false
            })
        } else {
          this.is_loading = false
          var form_errors = []
          if (custom_appt) {
            if (!custom_appt_spaces) form_errors.push(Vue.prototype.trans('lang.appt_spaces_req'))
          }
          if (!start_time) form_errors.push(Vue.prototype.trans('lang.start_time_req'))
          if (!self.duration || self.duration == Vue.prototype.trans('lang.select_duration')) form_errors.push(Vue.prototype.trans('lang.duration_req'))
          form_errors.forEach(element => {
            self.showError(element)
          })
        }
      },
      updateLocationServices: function (id) {
        this.is_loading = true
        let location_service_form = document.getElementById('update_location_service')
        let formData = new FormData(location_service_form)
        var self = this
        axios.post(APP_URL + '/doctor/update-location-services/' + id, formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.is_loading = false
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
            } else {
              self.is_loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.is_loading = false
          })
      },
      onChangeStartTime (time, timeString) {
        document.getElementById('location_start_time').value = timeString
        document.getElementById('start_time_obj').value = time
        this.onChangeDuration()
      },
      onChangeDuration () {
        var selected_time = document.getElementById('start_time_obj').value
        if (selected_time) {
          var startdate = moment(selected_time)
          var duration = parseInt(this.duration) * this.no_of_slot
          if (this.intervals != Vue.prototype.trans('lang.select_interval')) {
            var intervals = parseInt(this.intervals) * this.no_of_slot
            var slot = duration + intervals
          } else {
            var slot = duration
          }
          var date = startdate.add(slot, 'minutes')
          this.end_time = date.format('h:m a')
        }
      },
      onChangeTime (time_obj_id, end_time_id) {
        if (time_obj_id) {
          var selected_time = document.getElementById(time_obj_id).value
          var startdate = moment(selected_time)
          var duration = parseInt(this.duration) * this.no_of_slot
          if (this.intervals != Vue.prototype.trans('lang.select_interval')) {
            var intervals = parseInt(this.intervals) * this.no_of_slot
            var slot = duration + intervals
          } else {
            var slot = duration
          }
          var date = startdate.add(slot, 'minutes')
          document.getElementById(end_time_id).value = date.format('h:mm a')
        }
      },
    }
  })
}

// Hospitals
if (document.getElementById('hospitals')) {
  const vhospitals = new Vue({
    el: '#hospitals',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {

    },
    data: {
      is_loading: false,
      success_message: '',
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            id: 'info_notify'
          }
        }
      },
    },
    methods: {
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      approveUser: function (main_title, message, final_msg, user_id) {
        this.$swal({
          title: main_title,
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            vhospitals.is_loading = true
            axios.post(APP_URL + '/hospital/approve-user', {
              id: user_id
            })
              .then(function (response) {
                if (response.data.type == 'success') {
                  self.is_loading = false
                  self.$swal(final_msg, message, 'success')
                  window.location.replace(APP_URL + '/manage-team')
                } else {
                  self.is_loading = false
                  self.showError(response.data.message)
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
      rejectUser: function (main_title, message, final_msg, user_id) {
        this.$swal({
          title: main_title,
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/hospital/reject-user', {
              id: user_id
            })
              .then(function (response) {
                if (response.data.type == 'success') {
                  self.$swal(final_msg, message, 'success')
                  window.location.replace(APP_URL + '/manage-team')
                } else {
                  self.showError(response.data.message)
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
      deleteUser: function (main_title, message, final_msg, user_id) {
        this.$swal({
          title: main_title,
          type: 'warning',
          showCancelButton: true,
          customClass: {
            container: 'la-warning-popup',
          },
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/hospital/delete-user', {
              id: user_id
            })
              .then(function (response) {
                if (response.data.type == 'success') {
                  self.$swal(final_msg, message, 'success')
                  window.location.replace(APP_URL + '/manage-team')
                } else {
                  self.showError(response.data.message)
                }
              })
          } else {
            this.$swal.close()
          }
        })
      },
    }
  })
}

// Forum
if (document.getElementById('forum')) {
  const vmforum = new Vue({
    el: '#forum',
    mounted: function () {
      jQuery(function () {
        jQuery('#filtered-questions').change(function () {
          this.form.submit()
        })
      })
    },
    created: function () {
      this.getLikedAnswer()
    },
    data: {
      loading: false,
      sort_by: 'null',
      like_answer_text: Vue.prototype.trans('lang.like_answer'),
      success_message: '',
      app: {
        email: '',
      },
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000
          },
          error: {
            position: 'topRight',
            timeout: 7000
          },
          completed: {
            position: 'center',
            timeout: 1000,
            progressBar: false,
            onClosing: function (instance, toast, closedBy) {
              //location.reload();
            }
          },
          info: {
            overlay: true,
            zindex: 999,
            position: 'center',
            timeout: 3000,
            class: 'iziToast-info',
            onClosing: function (instance, toast, closedBy) {
              vmforum.showCompleted(vmforum.success_message)
            }
          }
        }
      },
    },
    methods: {
      submitReport: function (id) {
        let submitReport = document.getElementById('submit-report')
        let formData = new FormData(submitReport)
        formData.append('user_id', id)
        var self = this
        axios.post(APP_URL + '/submit-report', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showMessage(response.data.message)
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            }
          })
          .catch(error => {
            if (error.response.status == 422) {
              if (error.response.data.errors.name) {
                self.showError(error.response.data.errors.name[0])
              }
              if (error.response.data.errors.email) {
                self.showError(error.response.data.errors.email[0])
              }
              if (error.response.data.errors.description) {
                self.showError(error.response.data.errors.description[0])
              }
            }
          })
      },
      showCompleted (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.completed)
      },
      showInfo (message) {
        return this.$toast.info(' ', message, this.notificationSystem.options.info)
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      showModal: function (reference) {
        this.$refs[reference].show()
      },
      resultSortBy: function () {
        var sort = document.getElementById('forum_sort').value
        var params = new URLSearchParams(window.location.search)
        params.delete('sort_by')
        params.append('sort_by', sort)
        window.location.replace(APP_URL + '/health-forum/search-query?' + params)
      },
      postQuestion: function () {
        let postQuestionForm = document.getElementById('post-question-form')
        let formData = new FormData(postQuestionForm)
        var self = this
        axios.post(APP_URL + '/health-forum/post-question', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.$refs['postQuestion'].hide()
              self.showCompleted(response.data.message)
              window.location.replace(APP_URL + '/health-forum')
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.speciality) {
              self.showError(error.response.data.errors.speciality[0])
            }
            if (error.response.data.errors.question_title) {
              self.showError(error.response.data.errors.question_title[0])
            }
            if (error.response.data.errors.question_desc) {
              self.showError(error.response.data.errors.question_desc[0])
            }
          })
      },
      postAnswer: function (id) {
        let postAnswerForm = document.getElementById('post-answer-form')
        let formData = new FormData(postAnswerForm)
        formData.append('forum_id', id)
        var self = this
        axios.post(APP_URL + '/health-forum/post-answer', formData)
          .then(function (response) {
            if (response.data.type === 'success') {
              self.showInfo(response.data.progressing)
              self.success_message = response.data.message
              window.location.replace(APP_URL + '/health-forum')
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.forum_answer) {
              self.showError(error.response.data.errors.forum_answer[0])
            }
          })
      },
      addLikedAnswer: function (element_id, id, column) {
        var self = this
        axios.post(APP_URL + '/user/add-liked-answer', {
          id: id,
          column: column,
        })
          .then(function (response) {
            if (response.data.authentication == true) {
              if (response.data.type == 'success') {
                jQuery('#' + element_id).addClass('wt-clicksave dc-btndisbaled dc-likans')
                jQuery('#' + element_id).find('span').addClass('wt-clicksave dc-btndisbaled dc-likans')
                self.like_answer_text = response.data.liked_text
                self.showMessage(response.data.message)
              } else {
                self.showError(response.data.message)
              }
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            console.log(error)
          })
      },
      getLikedAnswer: function () {
        var self = this
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var id = segment_array[segment_array.length - 1]
        axios.post(APP_URL + '/profile/get-liked-answer', {
          id: id
        })
          .then(function (response) {
            if (response.data.answer == 'true') {
              self.disable_btn = 'dc-btndisbaled'
              self.saved_class = 'fa fa-heart'
            }
          })
      },
      sendAppLink: function () {
        // let form = document.getElementById('download-app');
        // let data = new FormData(form);
        var self = this
        this.loading = true
        axios.post(APP_URL + '/send/app-link', {
          email: self.app.email
        })
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
              self.app.email = ''
            } else {
              self.loading = false
              self.showError(response.data.message)
            }
          })
      },
    }
  })
}
if (document.getElementById('pages')) {
  const vmpageList = new Vue({
    el: '#pages',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {
      this.getPageOption()
    },
    data: {
      show_page: true,
      page_banner: false,
      pageID: '',
      is_show: false,
      title: '',
      slug: '',
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000,
            class: 'success_notification'
          },
          error: {
            position: 'topRight',
            timeout: 4000,
            class: 'error_notification'
          },
        }
      },
    },
    methods: {
      updateSlug: function (title) {
        var str = title
        str = str.replace(/\s+/g, '-').toLowerCase()
        this.slug = str
        return this.slug
      },
      removeImage: function (id) {
        this.page_banner = true
        document.getElementById(id).value = ''
      },
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      submitPage: function () {
        let pageForm = document.getElementById('page-form')
        let formData = new FormData(pageForm)
        var description = tinyMCE.get('page-desc').getContent()
        formData.append('content', description)
        var self = this
        axios.post(APP_URL + '/admin/store-page', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showMessage(response.data.message)
              setTimeout(function () {
                window.location.replace(APP_URL + '/admin/pages')
              }, 4000)
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.title) {
              self.showError(error.response.data.errors.title[0])
            }
            if (error.response.data.errors.content) {
              self.showError(error.response.data.errors.content[0])
            }
          })
      },
      updatePage: function (id) {
        let pageEditForm = document.getElementById('page-edit-form')
        let formData = new FormData(pageEditForm)
        var description = tinyMCE.get('page-desc').getContent()
        formData.append('content', description)
        formData.append('page_id', id)
        var self = this
        axios.post(APP_URL + '/admin/pages/update-page', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showMessage(response.data.message)
              setTimeout(function () {
                window.location.replace(APP_URL + '/admin/pages')
              }, 4000)
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.title) {
              self.showError(error.response.data.errors.title[0])
            }
            if (error.response.data.errors.content) {
              self.showError(error.response.data.errors.content[0])
            }
          })
      },
      getPageOption: function () {
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var id = segment_array[segment_array.length - 1]
        if (segment_str == '/admin/pages/edit-page/' + id) {
          let self = this
          axios.post(APP_URL + '/admin/get-page-option', {
            page_id: id
          })
            .then(function (response) {
              if (response.data.type == 'success') {
                if (response.data.show_page == 'true') {
                  self.show_page = true
                } else {
                  self.show_page = false
                }
              }
            })
        }
      },
      selectAll: function () {
        this.is_show = !this.is_show
        jQuery('#dc-pages').change(function () {
          jQuery('input:checkbox').prop('checked', jQuery(this).prop('checked'))
        })
      },
      selectRecord: function () {
        if (document.querySelectorAll('input[type="checkbox"]:checked').length > 0) {
          this.is_show = true
        } else {
          this.is_show = false
        }
      },
      deleteChecked: function (msg, text) {
        var deleteIDs = jQuery('#checked-val input:checkbox:checked').map(function () {
          return jQuery(this).val()
        }).get()
        console.log(deleteIDs)
        var self = this
        this.$swal({
          title: msg,
          type: 'warning',
          customClass: {
            container: 'la-warning-popup',
          },
          showCancelButton: true,
          confirmButtonClass: 'btn-danger',
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          showLoaderOnConfirm: true
        }).then((result) => {
          var self = this
          if (result.value) {
            axios.post(APP_URL + '/admin/delete-checked-pages', {
              ids: deleteIDs
            })
              .then(function (response) {
                if (response.data.type == 'success') {
                  setTimeout(function () {
                    self.$swal({
                      title: this.title,
                      text: text,
                      type: 'success'
                    })
                  }, 500)
                  window.location.replace(APP_URL + '/admin/pages')
                } else {
                  self.showError(response.data.message)
                }
              })
          } else {
            this.$swal.close()
          }
        })
      }
    }
  })
}
if (document.getElementById('doctor_appointments')) {
  const vmDoctorAppointments = new Vue({
    el: '#doctor_appointments',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {

    },
    //components: {calender},
    data: {
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 4000,
            class: 'success_notification'
          },
          error: {
            position: 'topRight',
            timeout: 4000,
            class: 'error_notification'
          },
        }
      },
    },
    methods: {}
  })
}

if (document.getElementById('packages')) {
  const packages = new Vue({
    el: '#packages',
    mounted: function () {
      if (document.getElementsByClassName('flash_msg') != null) {
        flashVue.$emit('showFlashMessage')
      }
    },
    created: function () {
      this.getOptions()
    },
    data: {
      private_chat: false,
      bookings: false,
      featured: false,
      packageID: '',
      loading: false,
      duration: false,
      package: {
        duration: ''
      },
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 3000
          },
          error: {
            position: 'topRight',
            timeout: 4000
          },
        }
      },
    },
    methods: {
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      packageDuration () {
        if (this.package.duration == 'other') {
          this.duration = true
        } else {
          this.duration = false
        }
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      submitPackage: function () {
        let submitPackageForm = document.getElementById('package_form')
        let formData = new FormData(submitPackageForm)
        var self = this
        axios.post(APP_URL + '/admin/store/package', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showMessage(response.data.message)
              setTimeout(function () {
                window.location.replace(APP_URL + '/admin/packages')
              }, 4000)
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.package_title) {
              self.showError(error.response.data.errors.package_title[0])
            }
            if (error.response.data.errors.package_price) {
              self.showError(error.response.data.errors.package_price[0])
            }
            if (error.response.data.errors.package_subtitle) {
              self.showError(error.response.data.errors.package_subtitle[0])
            }
          })
      },
      updatePackage: function (id) {
        let submitPackageForm = document.getElementById('update-package')
        let formData = new FormData(submitPackageForm)
        formData.append('pkg_id', id)
        var self = this
        axios.post(APP_URL + '/admin/packages/update', formData)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.showMessage(response.data.message)
              setTimeout(function () {
                window.location.replace(APP_URL + '/admin/packages')
              }, 4000)
            } else {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            if (error.response.data.errors.package_title) {
              self.showError(error.response.data.errors.package_title[0])
            }
            if (error.response.data.errors.package_price) {
              self.showError(error.response.data.errors.package_price[0])
            }
            if (error.response.data.errors.package_subtitle) {
              self.showError(error.response.data.errors.package_subtitle[0])
            }
          })
      },
      getOptions: function () {
        let self = this
        var segment_str = window.location.pathname
        var segment_array = segment_str.split('/')
        var id = segment_array[segment_array.length - 1]
        if (window.location.pathname == '/admin/packages/edit/' + id) {
          axios.post(APP_URL + '/package/get-package-options', {
            id: id
          })
            .then(function (response) {
              if (response.data.type == 'success') {
                if ((response.data.bookings == 'true')) {
                  self.bookings = true
                } else {
                  self.bookings = false
                }
                if ((response.data.private_chat == 'true')) {
                  self.private_chat = true
                } else {
                  self.private_chat = false
                }
                if ((response.data.featured == 'true')) {
                  self.featured = true
                } else {
                  self.featured = false
                }
              }
            }).catch(function (error) {
            console.log(error)
          })
        }
      },
      getPurchasePackage: function (id) {
        var self = this
        axios.get(APP_URL + '/package/get-purchase-package')
          .then(function (response) {
            if (response.data.type == 'success') {
              window.location.replace(APP_URL + '/user/package/checkout/' + id)
            } else if (response.data.type == 'error') {
              self.showError(response.data.message)
            } else if (response.data.type == 'server_error') {
              self.showError(response.data.message)
            }
          })
          .catch(function (error) { })
      },
      getStriprForm: function () {
        var self = this
        axios.post(APP_URL + '/stripe/generate-order')
          .then(function (response) {
            if (response.data.type == 'success') {
              self.$refs.myModalRef.show()
            }
          })
          .catch(function (error) {
            console.log(error)
          })

      },
      submitStripeFrom: function () {
        this.loading = true
        let stripe_payment = document.getElementById('stripe-payment-form')
        let data = new FormData(stripe_payment)
        var self = this
        axios.post(APP_URL + '/addmoney/stripe', data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
              setTimeout(function () {
                window.location.replace(response.data.url)
              }, 3000)
            } else if (response.data.type == 'error') {
              self.loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.loading = false
            console.log(error)
          })
      },
    }
  })
}
if (document.getElementById('invoice_list')) {
  new Vue({
    el: '#invoice_list',
    created () {
      this.getUserPayoutSettings()
    },
    data: {
      show_paypal_fields: false,
      show_bank_fields: false,
      loading: false,
      notificationSystem: {
        options: {
          success: {
            position: 'topRight',
            timeout: 3000
          },
          error: {
            position: 'topRight',
            timeout: 4000
          },
        }
      },
    },
    methods: {
      showMessage (message) {
        return this.$toast.success(' ', message, this.notificationSystem.options.success)
      },
      showError (error) {
        return this.$toast.error(' ', error, this.notificationSystem.options.error)
      },
      print: function () {
        const cssText = `
                .dc-transactionhold{
                    float: left;
                    width: 100%;
                }
                .dc-borderheadingvtwo a{font-size: 18px;}
                .dc-transactiondetails{
                    float: left;
                    width: 100%;
                    list-style:none;
                    margin-bottom:20px;
                    line-height: 28px;
                }
                .dc-transactiondetails li{
                    float: left;
                    width: 100%;
                    margin-bottom: 10px;
                    line-height: inherit;
                    list-style-type:none;
                }
                .dc-transactiondetails li:last-child{margin: 0;}
                .dc-transactiondetails li span{
                    font-size: 16px;
                    line-height: inherit;
                }
                .dc-transactiondetails li span.dc-grossamount {float: right;}
                .dc-transactiondetails li span em{
                    font-weight:500;
                    font-style:normal;
                    line-height: inherit;
                }
                .dc-transactionid{
                    margin-left:80px;
                    padding-left:10px;
                    border-left:2px solid #ddd;
                }
                .dc-grossamountusd{font-size: 24px !important;}
                .dc-paymentstatus{
                    color: #21ce93;
                    padding:3px 10px;
                    margin-left:10px;
                    font-size: 14px !important;
                    text-transform: uppercase;
                    border:1px solid #21ce93;
                }
                .dc-createtransactionhold{
                    float: left;
                    width: 100%;
                }
                .dc-createtransactionholdvtwo{
                    padding:0 20px;
                }
                .dc-createtransactionheading{
                    float: left;
                    width: 100%;
                    padding-bottom:15px;
                    border-bottom:1px solid #ddd;
                }
                .dc-createtransactionheading span{
                    display: block;
                    color: #1070c4;
                    font-size: 16px;
                    line-height: 20px;
                }
                .dc-createtransactioncontent{
                    float: left;
                    width: 100%;
                    padding:27px 0;
                    border-bottom: 1px solid #ddd;
                }
                .dc-createtransactioncontent a{
                    padding:0 10px;
                    color: #1070c4;
                    font-size: 14px;
                    line-height: 16px;
                    display: inline-block;
                    vertical-align: middle;
                    border-left:1px solid #ddd;
                }
                .dc-createtransactioncontent a:first-child{
                    border-left:0;
                    padding-left:0;
                }
                .dc-addresshold{
                    float: left;
                    width: 100%;
                    padding:18px 0;
                }
                .dc-addresshold h4{
                    margin: 0;
                    display: block;
                    font-size: 16px;
                    font-weight: 500;
                }
                table.dc-carttable{ margin-bottom:0;}
                table.dc-carttable thead{
                    border:0;
                    font-size:14px;
                    line-height:18px;
                    background: #f5f7fa;
                }
                table.dc-carttable thead tr th{
                    border:0;
                    text-align:left;
                    font-weight: 500;
                    font-weight:normal;
                    padding:20px 4px 20px 160px;
                    font:500 16px/18px 'Montserrat', Arial, Helvetica, sans-serif;
                }
                table.dc-carttable thead tr th + th{
                    text-align:center;
                    padding:20px 4px;
                }
                table.dc-carttable tbody td{
                    width:50%;
                    border:0;
                    font-size:16px;
                    text-align:left;
                    line-height: 20px;
                    display:table-cell;
                    vertical-align:middle;
                    padding:10px 4px 10px 0;
                }
                table.dc-carttable tbody td span,
                table.dc-carttable tbody td img{
                    display:inline-block;
                    vertical-align:middle;
                }
                table.dc-carttable tbody td em{
                    margin: 0;
                    font-size: 16px;
                    line-height: 16px;
                    font-style: normal;
                    vertical-align: middle;
                    display: inline-block;
                }
                table.dc-carttable > thead > tr > th{
                    padding: 6px 20px;
                    width: 25%;
                }
                table.dc-carttable > thead:first-child > tr:first-child > th{
                    border:0;
                    width: 25%;
                    padding: 6px 20px;
                }
                table.dc-carttable tbody td > em{
                    display: block;
                    text-align: center;
                }
                table.dc-carttable tbody td img{
                    width: 116px;
                    height: 116px;
                    margin-right:20px;
                    border-radius:10px;
                }
                table.dc-carttable tbody td + td{
                    width:15%;
                    text-align:center;
                }
                table.dc-carttable tbody td:last-child{
                    width:10%;
                    text-align:right;
                    padding:20px 20px 20px 4px;
                }
                table.dc-carttable tbody td .btn-delete-item{
                    float:right;
                    font-size:24px;
                }
                table.dc-carttable tbody td .btn-delete-item a{color: #fe6767}
                table.dc-carttable tbody td .quantity-sapn{
                    padding:0;
                    width:80px;
                    position:relative;
                    border-radius: 10px;
                    border: 1px solid #e7e7e7;
                }
                table.dc-carttable tbody td .quantity-sapn input[type="text"]{
                    width: 100%;
                    height: 42px;
                    padding: 0 15px;
                    border-radius: 0;
                    box-shadow: none;
                    background: none;
                    line-height: 42px;
                }
                table.dc-carttable tbody td .quantity-sapn input{border:0;}
                table.dc-carttable tbody td .quantity-sapn em{
                    width:10px;
                    display:block;
                    position:absolute;
                    right:10px;
                    cursor:pointer;
                }
                table.dc-carttable tbody td .quantity-sapn em.fa-caret-up{top:8px;}
                table.dc-carttable tbody td .quantity-sapn em.fa-caret-down{ bottom:8px;}
                table.dc-carttable tfoot tr td{ width:50%;}
                table.dc-carttable tbody tr{border-bottom: 1px solid #ddd;}
                table.dc-carttable tbody tr:last-child{border-bottom:0; }
                table.dc-carttablevtwo tbody td > em{
                    color: #636c77;
                    font-weight:500;
                    text-align: left;
                    display: inline-block;
                }
                table.dc-carttablevtwo tbody td > span{
                    float: right;
                }
                table.dc-carttablevtwo tbody td{padding:20px;}

                .dc-refundscontent{
                    float: left;
                    width: 100%;
                }
                .dc-refundsdetails{
                    float: left;
                    width: 100%;
                    list-style:none;
                }
                .dc-refundsdetails li{
                    float: left;
                    width: 100%;
                    padding:15px 0;
                    list-style-type:none;
                }
                .dc-refundsdetails li + li{border-top: 1px solid #ddd;}
                .dc-refundsdetails li strong{
                    width: 300px;
                    float:left;
                }
                .dc-refundsdetails li .dc-rightarea{float: left;}
                .dc-refundsdetails li .dc-rightarea span{
                    display: block;
                }
                .dc-refundsdetails li .dc-rightarea em{
                    font-weight:500;
                    font-style: normal;
                }
                .dc-refundsdetails li:nth-child(3){
                    border:0;
                    padding-top:0;
                }
                .dc-refundsinfo{
                        width:100%;
                        clear:both;
                    display: block;
                }
                table.dc-carttable tbody tr:nth-child(6){border:0;}
                table.dc-carttablevtwo tbody tr:nth-child(6) td{padding: 20px 20px 0px;}
              `
        const d = new Printd()
        d.print(document.getElementById('printable_area'), cssText)
      },
      changePayout (payment_method) {
        if (payment_method == 'paypal') {
          this.show_paypal_fields = true
          this.show_bank_fields = false
        } else if (payment_method == 'bacs') {
          this.show_paypal_fields = false
          this.show_bank_fields = true
        } else {
          this.show_paypal_fields = false
          this.show_bank_fields = false
        }
      },
      submitPayoutsDetail: function (id) {
        this.loading = true
        var self = this
        let Form = document.getElementById('profile_payout_detail')
        let form_data = new FormData(Form)
        form_data.append('id', id)
        axios.post(APP_URL + '/user/update-payout-detail', form_data)
          .then(function (response) {
            if (response.data.type == 'success') {
              self.loading = false
              self.showMessage(response.data.message)
            } else {
              self.loading = false
              self.showError(response.data.message)
            }
          })
          .catch(function (error) {
            self.loading = false
          })
      },
      getUserPayoutSettings: function () {
        var self = this
        axios.get(APP_URL + '/user/get-payout-detail')
          .then(function (response) {
            if (response.data.type == 'success') {
              if (response.data.payouts.type == 'paypal') {
                self.show_paypal_fields = true
              } else if (response.data.payouts.type == 'bacs') {
                self.show_bank_fields = true
              }
            } else {

            }
          })
          .catch(function (error) {

          })
      },
      getPayouts: function () {
        var year = document.getElementById('payout_year').value
        var month = document.getElementById('payout_month').value
        if (year && month) {
          document.getElementById('payout_year_filter').submit()
        }

      }
    }
  })
}
