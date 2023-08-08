<template>
    <div class="slide-inner-list-item dc-settingscontent">
        <div :id="this.main_accordion_id" class="slide-inner-list-item dc-accordioninnertitle" data-toggle="collapse" :data-target="'#'+this.inner_accordion_id">
            <span>{{ this.stored_slide_title_one }}</span>
            <div class="dc-rightarea">
            <div class="dc-btnaction">
                <a href="javascript:void(0);" class="dc-editbtn" :id="this.main_accordion_id" data-toggle="collapse" aria-expanded="true">
                    <i class="lnr lnr-pencil"></i>
                </a>
                <a href="javascript:void(0);" @click="removeElement()"  class="dc-delbtn"><i class="lnr lnr-trash"></i></a></div>
            </div>
        </div>
        <div class="dc-collapseexp collapse hide" :id="this.inner_accordion_id" :aria-labelledby="this.inner_accordion_id" data-parent="#accordion">
            <div class="dc-formtheme dc-userform">
                <fieldset>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_title_one" v-bind:name="this.slide_title_one" class="form-control" :placeholder="ph_edit_slide_title_one">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_title_two" v-bind:name="this.slide_title_two" class="form-control" :placeholder="ph_edit_slide_title_two">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_title_three" v-bind:name="this.slide_title_three" class="form-control" :placeholder="ph_edit_slide_title_three">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_btn_title_one" v-bind:name="this.slide_btn_title_one" class="form-control" :placeholder="ph_edit_slide_btn_title_one">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_btn_url_one" v-bind:name="this.slide_btn_url_one" class="form-control" :placeholder="ph_edit_slide_btn_url_one">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_btn_title_two" v-bind:name="this.slide_btn_title_two" class="form-control" :placeholder="ph_edit_slide_btn_title_two">
                    </div>
                    <div class="form-group form-group-half">
                        <input type="text" :value="this.stored_slide_btn_url_two" v-bind:name="this.slide_btn_url_two" class="form-control" :placeholder="ph_edit_slide_btn_url_two">
                    </div>
                    <div class="form-group" v-if="this.stored_slide_img">
                        <upload-media
                            :title="'Slide Inner Image'"
                            :img="this.stored_slide_img"
                            :img_id="this.stored_image_id"
                            :img_name="this.img_name"
                            :img_ref="this.img_ref"
                            :img_hidden_name="this.img_hidden_name"
                            :img_hidden_id="this.img_hidden_id"
                            :existed_img="this.stored_image"
                            :url="this.img_url"
                            :existing_img_url="this.stroed_img_url"
                            :existing_img_name="this.stored_slide_img"
                            >
                        </upload-media>
                    </div>
                    <div class="form-group" v-else>
                        <upload-media
                            :title="'Slide Inner Image'"
                            :img="this.stored_slide_img"
                            :img_id="this.stored_slide_img"
                            :img_name="this.img_name"
                            :img_ref="this.img_ref"
                            :img_hidden_name="this.img_hidden_name"
                            :img_hidden_id="this.img_hidden_id"
                            :url="this.img_url"
                            >
                        </upload-media>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</template>

<script>
import vue2Dropzone from 'vue2-dropzone'
export default {
    props: [
        'slide_title_one', 'slide_title_two', 'img_ref', 'stored_image_id','stored_image', 
        'img_hidden_name', 'img_hidden_id', 'img_url', 'stroed_img_url', 
        'img_name', 'main_accordion_id', 'inner_accordion_id', 'stored_slide_title_one', 
        'stored_slide_title_two', 'stored_slide_title_three', 'stored_slide_btn_title_one', 
        'stored_slide_btn_url_one', 'stored_slide_btn_title_two', 'stored_slide_btn_url_two', 
        'remove_uploded_image_id', 'uploaded_image_remove_id', 'slide_title_two', 'slide_title_three', 
        'slide_btn_title_one', 'slide_btn_url_one', 'slide_btn_title_two', 'slide_btn_url_two',
        'remove_uploded_image_id', 'uploaded_image_remove_id', 'ph_edit_slide_title_one',
        'ph_edit_slide_title_two', 'ph_edit_slide_title_three', 'ph_edit_slide_btn_title_one',
        'ph_edit_slide_btn_url_one', 'ph_edit_slide_btn_title_two', 'ph_edit_slide_btn_url_two', 'stored_slide_img', 'stroed_img_url'
        ],
    components: {
        vueDropzone: vue2Dropzone
    },
    data: function () {
        return {
            options: {
            error: {
                position: 'center',
                    timeout: 3000,
                },
            },
            image_url:'',
            uploaded_slide_image:false,
            stored_slides:[],
        }
    },
    methods: {
        showError(message){
            return this.$toast.error(' ', message, this.options.error);
        },
        removeElement() {
            this.$emit('removeElement');
        },
    },
    mounted: function () {
        if(this.stored_slide_img){
            this.image_url = APP_URL+"/uploads/settings/home/"+this.stored_slide_img;
        }
    },
    created: function() {}
}
</script>
