<template>
    <form class="wt-formtheme wt-formbanner wt-formbannertwo" id="main-search-form">
        <fieldset>
            <vue-bootstrap-typeahead
                    class="mb-4"
                    size="sm"
                    v-model="query"
                    :data="hospitals"
                    :placeholder=placeholder
                    :serializer="item => item.name"
                    ref="searchfield"
                    inputClass="search-field"
                    @input="watchSearchResults()"
                >
                    <template slot="suggestion" slot-scope="{ data, htmlText }">
                        <div class="d-flex align-items-center">
                            <span class="ml-4" v-html="htmlText"></span>
                        </div>
                        <input type="hidden" name="hospital" :value="data.id" id="hospital_hidden_field">
                    </template>
            </vue-bootstrap-typeahead>
            <span v-if="is_show" class="no-record-span">{{no_record}}</span>
        </fieldset>
    </form>
</template>
<script>
 export default{
    props: ['widget_type', 'no_record_message', 'placeholder'],
        data(){
            return {
                hospitals:[],
                no_record:this.no_record_message,
                url: APP_URL + '/search-results',
                is_show: false,
                query:'',
            }
        },
        methods: {
            getSearchableData: function(newQuery){
                let self = this;
                axios.get(APP_URL + '/search/get-hospitals')
                .then(function (response) {
                    self.hospitals = response.data.hospitals;
                });
            },
            watchSearchResults: function() {
                if(this.$refs.searchfield.$children[0].matchedItems == '') {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "block");
                    this.is_show = true;
                } else {
                    jQuery('.search-field').parents('.form-group').find('span.no-record-span').css("display", "none");
                    this.is_show = false;
                }
            }
        },
        watch: {
           query: _.debounce(function(newQuery) { this.getSearchableData(newQuery) }, 250)
        },
        mounted: function () {
            jQuery(".search-field").keydown(function(){
                var input = jQuery('.search-field');
                input.on('keydown', function() {
                    var key = event.keyCode || event.charCode;
                    if( key == 8 || key == 46 ) {
                        if(!jQuery(this).val()) {
                            jQuery(this).parents('.form-group').find('span.no-record-span').css("display", "none");
                        } else {
                            this.is_show = true;
                        }
                    }
                });
            });
        },
        created: function() {
            this.getSearchableData();
        }
    }
</script>
<style>
.wt-radioholder{transition: 1s;}
</style>

