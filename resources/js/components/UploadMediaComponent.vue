<template>
    <div>
        <div class="dc-tabscontenttitle" v-if="this.title">
            <h3>{{ this.title }}</h3>
        </div>
        <div class="dc-profilephotocontent">
            <div class="dc-formtheme dc-formprojectinfo dc-formcategory" v-if="this.existed_img">
                <fieldset>
                    <div class="form-group form-group-label">
                        <div class="dc-downloads-files" v-if="this.file_type">
                            <div v-if="this.no_of_files > 1">
                                <ul>
                                    <li :id="this.img_hidden_id">
                                        <div class="dc-files-content">
                                            <img :src="base_url+'/images/file-icon.png'">
                                            <div class="dc-filecontent">
                                                <span>{{this.existed_img}}<em>{{ trans('lang.file_size') }} {{this.size}} </em></span>
                                                <a href="javascript:void(0);" @click="removeImage(img_hidden_id)" class="dc-closediv">
                                                    <i class="lnr lnr-cross"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id" :value="this.existed_img">
                                    </li>
                                </ul>   
                            </div>
                            <div v-else>
                                <div v-if="this.uploaded_img">
                                    <upload-file
                                        :id="this.img_id"
                                        :img_ref="this.img_ref"
                                        :url="this.temp_url"
                                        :name="this.img_name"
                                        :type="this.file_type"
                                    >
                                    </upload-file>
                                    <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id">
                                </div>
                                <ul v-else>
                                    <li :id="this.img_hidden_id">
                                        <div class="dc-files-content">
                                            <img :src="base_url+'/images/file-icon.png'">
                                            <div class="dc-filecontent">
                                                <span>{{this.existed_img}}<em v-if="this.size">{{ trans('lang.file_size') }} {{this.size}} </em></span>
                                                <a href="javascript:void(0);" @click="removeImage(img_hidden_id)" class="dc-closediv">
                                                    <i class="lnr lnr-cross"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id" :value="this.existed_img">
                                    </li>
                                </ul>   
                            </div>
                        </div>
                        <div v-else>
                            <div v-if="this.uploaded_img">
                                <upload-image
                                    :id="this.img_id"
                                    :img_ref="this.img_ref"
                                    :url="this.temp_url"
                                    :name="this.img_name"
                                    :type="this.file_type"
                                    :image_width="this.width"
                                    :image_height="this.height"
                                >
                                </upload-image>
                                <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id">
                            </div>
                            <div class="dc-uploadingbox" v-else>
                                <figure><img :src="this.image_url" alt=""></figure>
                                <div class="dc-uploadingbar">
                                    <div class="dz-filename">{{this.existing_img_name}}</div>
                                    <span v-if="this.size">{{ trans('lang.file_size') }} {{this.size}}</span>
                                    <a href="javascript:void(0);" class="lnr lnr-cross"  @click="removeImage(img_hidden_id)"></a>
                                </div>
                                <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id" :value="this.existed_img">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="dc-formtheme dc-formprojectinfo dc-formcategory" v-else>
                <fieldset>
                    <div class="form-group form-group-label" v-if="file_type == 'multiple_types'">
                        <upload-file
                            :id="this.img_id"
                            :img_ref="this.img_ref"
                            :url="this.temp_url"
                            :name="this.img_name"
                            :type="this.file_type"
                            :maxFiles="no_of_files">
                        </upload-file>
                        <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id">
                    </div>
                    <div class="form-group form-group-label" v-else-if="file_type == 'gallery'">
                        <upload-gallery
                            :id="this.img_id"
                            :img_ref="this.img_ref"
                            :url="this.temp_url"
                            :name="this.img_name"
                            :type="this.file_type"
                            :maxFiles="no_of_files">
                        </upload-gallery>
                    </div>
                    <div class="form-group form-group-label" v-else>
                        <upload-image
                            :id="this.img_id"
                            :img_ref="this.img_ref"
                            :url="this.temp_url"
                            :name="this.img_name"
                            :type="'image'"
                            :image_width="this.width"
                            :image_height="this.height">
                        </upload-image>
                        <input type="hidden" :name="this.img_hidden_name" :id="img_hidden_id">
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['no_of_files', 'size', 'img', 'img_id', 'img_ref', 'img_name', 'img_hidden_name', 
            'img_hidden_id', 'title', 'img_hidden_key', 'existed_img', 'url', 'existing_img_url', 
            'file_type','existing_img_name', 'width', 'height'],
    data () {
    return {
        uploaded_img:false,
        temp_url:this.url,
        base_url: APP_URL,
        image_url:this.existing_img_url,
    }
  },
  methods: {
      removeImage: function (id) {
        if (this.img) {
            this.uploaded_img = true;
        } else {
            this.uploaded_img = false;
        }
      },
  },
  mounted: function () {

  },
};
</script>
