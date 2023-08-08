<template>
    <div>
        <div class="dc-myskills">
            <ul id="role_list" class="sortable list">
                <li v-for="(role, index) in stored_roles" :key="'stored_'+index" v-if="stored_roles" :id="'role-'+index" class="role-element" :ref="'role-'+index">
                    <div class="dc-dragdroptool">
                        <a href="javascript:void(0)" class="lnr lnr-menu"></a>
                    </div>
                    <span class="skill-dynamic-html">{{ role.name }}</span>
                    <span class="skill-dynamic-field">
                        <input type="hidden" v-bind:name="'roles['+index+'][name]'" :value="role.name">
                        <input type="hidden" v-bind:name="'roles['+index+'][id]'" :value="role.id">
                        <input type="text" v-bind:name="'roles['+index+'][name]'" v-model="role.name">
                    </span>
                    <div class="dc-rightarea">
                        <a href="javascript:void(0);" class="dc-addinfo" v-on:click="editInput(index, role.id, role.name)"><i class="lnr lnr-pencil"></i></a>
                        <a href="javascript:void(0);" class="dc-deleteinfo" @click="deActiveStoredroles(index)" v-if="stored_edit_class"><i class="lnr lnr-trash"></i></a>
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
    props: [],
        data(){
            return {
                dc_rolesactive:false,
                stored_roles:[],
                edit_class: [],
                stored_edit_class:false,
                edit_role: '',
                role: {
                    id: '',
                    name:'',
                    count: 0,
                    edit_class: false,
                },
                roles: [],
                counts:0,
                notificationSystem: {
                    error: {
                        position: "topRight",
                        timeout: 4000
                    },
                    success: {
                        position: "center",
                        timeout: 2000
                    }
                },
            }
        },
        methods: {
            showError(error){
                return this.$toast.error(' ', error, this.notificationSystem.error);
            },
            showMessage(message) {
				return this.$toast.success(' ', message, this.notificationSystem.success)
			},
            getRoles(){
                let self = this;
                axios.get(APP_URL + '/admin/get-roles')
                .then(function (response) {
                    self.stored_roles = response.data.roles;
                });
            },
            updateRole(id, name) {
                let self = this;
                if (name != '') {
                    axios.post(APP_URL + '/admin/update-role', {
                        role_id : id,
                        role_name : name,
                    })
                    .then(function (response) {
                        if(response.data.type === 'success') {
                            self.showMessage('Role Updated Successfully')
                            this.getRoles()
                        }
                    });
                } else {
                    self.showError('Role name cannot be empty')
                }
            },
            editInput: function (index, id, name) {
                this.stored_edit_class = true;
                if (this.$refs['role-'+index][0].classList.contains('dc-skillsaddinfo')) {
                    this.$refs['role-'+index][0].classList.remove('dc-skillsaddinfo');
                    this.updateRole(id, name);
                } else {
                    console.log(this.$refs['role-'+index][0].classList);
                    this.$refs['role-'+index][0].classList.add('dc-skillsaddinfo');
                }
            },
            deActiveStoredroles: function (index) {
                this.stored_edit_class = false;
                if (this.$refs['role-'+index][0].classList.contains('dc-skillsaddinfo')) {
                    this.$refs['role-'+index][0].classList.remove('dc-skillsaddinfo');
                }
            }
        },
        mounted: function () {

        },
        created: function() {
            this.getRoles();
        }
    }
</script>
