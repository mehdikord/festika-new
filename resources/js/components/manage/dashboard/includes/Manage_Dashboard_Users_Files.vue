<template>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-orange">
                    <span class="text-light font-16 text-bold-2"><i class="fas fa-users font-20 me-1"></i> کاربران جدید فستیکا</span>
                    <span class="float-end">
                        <router-link :to="{name : 'manage_users_members'}">
                        <button type="button" class="btn btn-light waves-effect btn-label waves-light"><i class="fas fa-eye label-icon"></i> مشاهده همه</button>
                        </router-link>
                    </span>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr class="bg-light">
                            <th>نام</th>
                            <th>موبایل</th>
                            <th>ایمل</th>
                            <th>استان</th>
                            <th>شهر</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(user,index) in NewUsers" :key="index" class="app-fade-in">
                                <td>{{ user.name }}</td>
                                <td>{{ user.phone }}</td>
                                <td>{{ user.email }}</td>
                                <td>{{ user.province.name }}</td>
                                <td>{{ user.city.name }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
        </div>
    </div>
</template>

<script>
export default {
    name: "Manage_Dashboard_Users_Files",
    props : [
        'users_count',
    ],
    created() {
        this.GetNewUsers();
    },
    data(){
        return {
            NewUsers : null,

        }
    },
    methods : {
        GetNewUsers () {
            axios.get('/api/manage/dashboard/get/new/users/'+ this.users_count ).then(response => {
                 this.NewUsers = response.data;
            }).catch(e=>{
                SweetAlert.SweetServerErrorMessage();
            })

        }
    }

}
</script>

<style scoped>

</style>
