<template>
    <div>
        <div class="dc-tabscontenttitle dc-addnew">
            <h3>{{trans('lang.add_slides')}}</h3>
            <a href="javascript:void(0);" @click="addSlide" class="add-slide-btn">{{trans('lang.add_new')}}</a>
        </div>
        <ul class="dc-experienceaccordion accordion" id="slides-list">
            <li class="slide-inner-list" v-for="(stored_slide, index) in stored_slides" :key="'stored_'+index" v-if="stored_slides.length > 0">
                <div class="slide-inner-list-item dc-settingscontent" :id="'slide-element-'+index">
                    <updateHomeSlider
                        :stored_image="stored_slide.hidden_slide_inner_image"
                        :stored_image_id="'stored_image_'+index"
                        :stored_slide_img="stored_slide.hidden_slide_inner_image"
                        :existed_img="stored_slide.hidden_slide_inner_image"
                        :img_url="slide.url+'/media/upload-temp-image/settings/slide'+index+'slide_inner_image'"
                        :stroed_img_url="slide.url+'/uploads/settings/home/'+stored_slide.hidden_slide_inner_image"
                        :img_name="'slide'+index+'slide_inner_image'"
                        :img_hidden_id ="'stored_hidden_banner_'+index"
                        :img_hidden_name="'slide['+[index]+'][hidden_slide_inner_image]'"
                        :img_ref="slide.img_ref+'_'+index"
                        :main_accordion_id="'existingslideaccordion['+index+']'"
                        :inner_accordion_id="'existingslideaccordioninner['+index+']'"
                        :stored_slide_title_one="stored_slide.slide_title_one"
                        :stored_slide_title_two="stored_slide.slide_title_two"
                        :stored_slide_title_three="stored_slide.slide_title_three"
                        :stored_slide_btn_title_one="stored_slide.slide_btn_title_one"
                        :stored_slide_btn_url_one="stored_slide.slide_btn_url_one"
                        :stored_slide_btn_title_two="stored_slide.slide_btn_title_two"
                        :stored_slide_btn_url_two="stored_slide.slide_btn_url_two"
                        :slide_title_one="'slide['+[index]+'][slide_title_one]'"
                        :slide_title_two="'slide['+[index]+'][slide_title_two]'"
                        :slide_title_three="'slide['+[index]+'][slide_title_three]'"
                        :slide_btn_title_one="'slide['+[index]+'][slide_btn_title_one]'"
                        :slide_btn_url_one="'slide['+[index]+'][slide_btn_url_one]'"
                        :slide_btn_title_two="'slide['+[index]+'][slide_btn_title_two]'"
                        :slide_btn_url_two="'slide['+[index]+'][slide_btn_url_two]'"
                        :remove_uploded_image_id="'upload_id-'+index"
                        :uploaded_image_remove_id="'remove_upload_id-'+index"
                        @removeElement="removeStoredSlide(index)"
                        :ph_edit_slide_title_one="ph_slide_title_one"
                        :ph_edit_slide_title_two="ph_slide_title_two"
                        :ph_edit_slide_title_three="ph_slide_title_three"
                        :ph_edit_slide_btn_title_one="ph_slide_btn_title_one"
                        :ph_edit_slide_btn_url_one="ph_slide_btn_url_one"
                        :ph_edit_slide_btn_title_two="ph_slide_btn_title_two"
                        :ph_edit_slide_btn_url_two="ph_slide_btn_url_two"
                    >
                    </updateHomeSlider>
                </div>
            </li>
            <li class="slide-inner-list" v-for="(slide, index) in slides" :key="index" ref="slidelistelement">
                <div class="slide-inner-list-item dc-settingscontent">
                    <div :id="'slideaccordion['+slide.count+']'" class="slide-inner-list-item dc-accordioninnertitle" data-toggle="collapse" :data-target="'#slideaccordioninner['+slide.count+']'">
                        <figure :class="slide.preview_class"></figure>
                        <span>{{ slide.slide_title_one }}</span>
                        <div class="dc-rightarea">
                        <div class="dc-btnaction">
                            <a href="javascript:void(0);" class="dc-editbtn" :id="'slideaccordion['+slide.count+']'" data-toggle="collapse" aria-expanded="true"><i class="lnr lnr-pencil"></i></a>
                            <a href="javascript:void(0);" class="dc-delbtn" :id="'del-slider'+slide.count" @click="removeSlide(slide.count, 'del-slider'+slide.count)"><i class="lnr lnr-trash"></i></a></div>
                        </div>
                    </div>
                    <div class="dc-collapseexp collapse hide" :id="'slideaccordioninner['+slide.count+']'" :aria-labelledby="'slideaccordion['+slide.count+']'" data-parent="#accordion">
                        <div class="dc-formtheme dc-userform">
                            <fieldset>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_title_one]'" class="form-control" :placeholder="ph_slide_title_one" v-model="slide.slide_title_one">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_title_two]'" class="form-control" :placeholder="ph_slide_title_two">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_title_three]'" class="form-control" :placeholder="ph_slide_title_three">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_btn_title_one]'" class="form-control" :placeholder="ph_slide_btn_title_one">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_btn_url_one]'" class="form-control" :placeholder="ph_slide_btn_url_one">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_btn_title_two]'" class="form-control" :placeholder="ph_slide_btn_title_two">
                                </div>
                                <div class="form-group form-group-half">
                                    <input type="text" v-bind:name="'slide['+[slide.count]+'][slide_btn_url_two]'" class="form-control" :placeholder="ph_slide_btn_url_two">
                                </div>
                                <div class="form-group">
                                    <upload-media
                                        :title="'Slide Inner Image'"
                                        :img="'slide_inner_image'"
                                        :img_id="'slide_inner_image-'+slide.count"
                                        :img_name="'slide'+slide.count+'slide_inner_image'"
                                        :img_ref="'slide_inner_image-'+slide.count"
                                        :img_hidden_name="'slide['+[slide.count]+'][hidden_slide_inner_image]'"
                                        :img_hidden_id="'hidden_slide_inner_image-'+slide.count"
                                        :url="slide.url+'/media/upload-temp-image/settings/slide'+slide.count+'slide_inner_image'"
                                    >
                                    </upload-media>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</template>
<script>
import updateHomeSlider from './EditHomeSliderComponent'
export default{
    components: {updateHomeSlider},
    props: ['upload_url', 'ph_slide_title_one', 'ph_slide_title_two', 'ph_slide_title_three', 'ph_slide_btn_title_one', 'ph_slide_btn_url_one', 'ph_slide_btn_title_two', 'ph_slide_btn_url_two'],
        data(){
            return {
                stored_slides:[],
                slide: {
                    url: APP_URL,
                    slide_title_one: 'First Title',
                    count: 0,
                },
                slides: [],
            }
        },
        methods: {
            getSlides(){
                let self = this;
                axios.get(APP_URL + '/admin/get-homeslider-slides')
                .then(function (response) {
                    console.log(response.data.slides);
                    if(response.data.type == 'success') {
                        self.stored_slides = response.data.slides;
                    }
                });
            },
            addSlide: function () {
                var slides_list_count = jQuery('#slides-list').find('.slide-inner-list').length
                if(this.$refs.slidelistelement) {
                    this.slide.count = slides_list_count + this.$refs.slidelistelement.length;
                } else {
                    this.slide.count = slides_list_count -1;
                }
                this.slides.push(Vue.util.extend({}, this.slide, this.slide.count++ ))
            },
            removeStoredSlide: function (index) {
                this.stored_slides.splice(index, 1);
            },
            removeSlide: function (index, element_id) {
                this.slides.splice(index, 1);
                jQuery('#' + element_id).parents('.slide-inner-list').remove();
            },
            removeUploadedImage: function (event) {
                var element = event.currentTarget;
                var elementID = element.getAttribute('id');
                jQuery('#'+elementID).parents('.image_uploaded_placeholder').css("display","none");
                jQuery('#'+elementID).parents('.slide-inner-list-item').find('.dc-uploadingbox').remove();
                jQuery('#'+elementID).parents('.slide-inner-list-item').find('.vue-dropzone').css("display","block");
            }
        },
        created: function() {
            this.getSlides();
        }
    }
</script>
