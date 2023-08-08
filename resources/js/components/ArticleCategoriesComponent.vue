<template>
    <div class="la-addcategory-holder">
       <div class="dc-formtheme dc-skillsform la-article-category">
            <transition name="fade">
                <div v-if="isShow" class="sj-jump-messeges">{{ trans('lang.no_record') }}</div>
            </transition>
            <fieldset>
                <div class="form-group">
                    <div class="form-group-holder">
                        <span class="dc-select">
                            <select id="article_cats" class="article-cats">
                                <option v-if="is_empty">{{ this.all_cats_selected }}</option>
                                <option v-for="(stored_cat, index) in stored_cats" :key="index+'-'+stored_cat.id" :value="stored_cat.id">{{ stored_cat.title }}</option>
                            </select>
                        </span>
                    </div>
                </div>
                <div class="form-group dc-btnarea">
                    <a href="javascript:void(0);" class="dc-btn" @click="addCategory">{{ trans('lang.add_now') }}</a>
                </div>
            </fieldset>
        </div>
        <div class="dc-myskills">
            <ul id="cat_list" class="sortable list">
                <li v-for="(article_cat, index) in article_cats" :key="index" v-if="article_cats" class="cat-element">
                    <div class="dc-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">
                        {{ article_cat.title }}</span>
                    <span class="skill-dynamic-field sss">
                        <input type="hidden" v-bind:name="'categories['+index+'][id]'" :value="article_cat.id">
                    </span>
                    <div class="dc-rightarea">
                        <a href="javascript:void(0);" class="dc-deleteinfo delete-skill" @click="removeStoredCat(index)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
                <li v-for="(cat, index) in cats" :key="index+cat.count">
                    <div class="dc-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">{{ cat.title }}</span>
                    <span class="skill-dynamic-field">
                        <input type="hidden" v-bind:name="'categories['+[cat.count]+'][id]'" :value="cat.id">
                    </span>
                    <div class="dc-rightarea">
                        <a href="javascript:void(0);" class="dc-deleteinfo" @click="removeCat(index)"><i class="lnr lnr-trash"></i></a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>
<style>
.fade-enter-active,
.fade-leave-active {
  transition: opacity 0.3s;
}
.fade-enter,
.fade-leave-to {
  opacity: 0;
}
</style>
<script>
 export default{
    props: ['widget_title', 'placeholder'],
        data(){
            return {
                isShow: false,
                is_empty: false,
                all_cats_selected:this.placeholder,
                stored_cats:[],
                selected_cat: '',
                selected_rating:'',
                selected_cat_text:'',
                edit_class: false,
                edit_cat: '',
                cat: {
                    id: '',
                    rating: '',
                    title:'',
                    count: 0
                },
                cats: [],
                article_cats: [],
                counts:0,
                notificationSystem: {
                    options: {
                        info: {
                            position: 'center',
                            timeout: 3000,
                        },
                        error: {
                            position: 'topRight',
                            timeout: 7000
                        },
                    }
                },
            }
        },
        methods: {
            showInfo(message){
                return this.$toast.info(' ', message, this.notificationSystem.options.info);
            },
            showError(error) {
                return this.$toast.error(' ', error, this.notificationSystem.options.error)
            },
            getStoredCategories(){
                let self = this;
                var segment_str = window.location.pathname;
                var segment_array = segment_str.split( '/' );
                var slug = segment_array[segment_array.length - 1];
                axios.post(APP_URL + '/get-article-cats',{
                    slug: slug
                })
                .then(function (response) {
                    if (response.data.cats.length == 0) {
                        self.is_empty = true;
                    }
                    console.log(response.data.cats)
                    if(response.data.type == 'success') {
                        self.stored_cats = response.data.cats;
                    } else {
                        self.all_cats_selected = window.trans.lang.select_cat;
                        self.is_empty = true;
                    }
                });
            },
            addCategory: function () {
                if(this.is_empty == false) {
                    var cat_list_count = jQuery('.dc-btn').parents('.dc-skillsform').next('.dc-myskills').find('ul#cat_list li').length;
                    cat_list_count = cat_list_count - 1;
                    this.cat.count = cat_list_count;
                    var catsSelect = document.getElementById("article_cats");
                    if(catsSelect.options[catsSelect.selectedIndex]) {
                        this.selected_cat_text = catsSelect.options[catsSelect.selectedIndex].text;
                        this.selected_cat = document.getElementById("article_cats").value;
                        this.cats.push(Vue.util.extend({}, this.cat, this.cat.count++, this.cat.title = this.selected_cat_text, this.cat.id = this.selected_cat, this.cat.rating = this.selected_rating ))
                        catsSelect.remove(catsSelect.selectedIndex);
                        if(catsSelect.options.length == 0 ) {
                            this.is_empty = true;
                        }
                    } else {
                        this.is_empty = true;
                        this.showInfo(window.trans.lang.no_more_cats_for_selection);
                    }
                } else {
                    this.is_empty = true;
                    this.showInfo(window.trans.lang.no_more_cats_for_selection);
                }
            },
            getArticleCats(){
                let self = this;
                var segment_str = window.location.pathname;
                var segment_array = segment_str.split( '/' );
                var edit_url = segment_array[segment_array.length - 2];
                if(edit_url == "edit-article") {
                    var slug = segment_array[segment_array.length - 1];
                    axios.post(APP_URL + '/get-stored-cats',{
                        slug:slug
                    })
                    .then(function (response) {
                        if(response.data.type = 'success') {
                            self.article_cats = response.data.cats;
                        }
                    });
                }
            },
            removeStoredCat: function (index) {
                var self = this;
                this.$swal({
                    title: window.trans.lang.ph_delete_confirm_title,
                    type: "warning",
                    showCancelButton: true,
                    customClass: {
                        container: 'la-warning-popup',
                    },
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        let option = self.article_cats[index];
                        var select = document.getElementById("article_cats");
                        select.options[select.options.length] = new Option(option.title, option.id, false, false);
                        self.article_cats.splice(index, 1);
                        self.is_empty = false;
                        self.$swal(window.trans.lang.cat_delete_message, ' ', 'success')
                        jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                    } else {
                        this.$swal.close()
                    }
                  })
            },
            removeCat: function (index) {
                var self = this;
                this.$swal({
                    title: window.trans.lang.ph_delete_confirm_title,
                    type: "warning",
                    showCancelButton: true,
                    customClass: {
                        container: 'la-warning-popup',
                    },
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true,
                    showLoaderOnConfirm: true
                  }).then((result) => {
                    var self = this;
                    if(result.value) {
                        let option = self.cats[index];
                        var select = document.getElementById("article_cats");
                        select.options[select.options.length] = new Option(option.title, option.id, false, false);
                        self.cats.splice(index, 1);
                        self.is_empty = false;
                        self.$swal(window.trans.lang.cat_delete_message, '', 'success')
                        jQuery('.swal2-container.swal2-center.swal2-fade.swal2-shown').addClass('la-warning-popup')
                    } else {
                        this.$swal.close()
                    }
                })
            },
            editInput: function (index) {
                this.edit_class = true;
            }
        },
        mounted: function () {
           jQuery(document).on('click', '.dc-skillsactive', function (e) {
                e.preventDefault();
                var _this = jQuery(this);
                _this.removeClass('dc-skillsactive');
                _this.parents('li').removeClass('dc-skillsaddinfo');
                var edit_cat_value = _this.parents('li').find('.skill-dynamic-field input:text').val();
                _this.parents('li').find('.skill-dynamic-html em').html(edit_cat_value);
            });
        },
        created: function() {
            this.getStoredCategories();
            this.getArticleCats();
        }
    }
</script>
