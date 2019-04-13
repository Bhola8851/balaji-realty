<template>
    <div class="container">
        <!--Profile Table-->
        <table class="table table-bordered mt-3">
                        
            <tr>
                <th>Profile Picture</th>
                <td>
                    <div class="widget-user-image">
                        <img class="img-circle img-fluid modelImage" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                </td>
            </tr>
            <tr>
                <th>Role</th>
                <td>{{user.type}}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{user.name}}</td>
            </tr>
            <tr>
                <th>Phone</th>
                <td>{{user.phone}}</td>
            </tr>
            <tr>
                <th>dob</th>
                <td>{{user.dob | myDate()}}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{{user.email}}</td>
            </tr>
            <tr>
                <th>gender</th>
                <td>{{user.gender}}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{user.address}}</td>
                
            </tr>
        </table>
    </div>
</template>

<script>
    export default {
        
        data(){
            return {
                user : {},
                 form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    phone: '',
                    dob: '',
                    address: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods:{
            getProfilePhoto(){
                let photo ="./img/profile/"+ this.user.photo ;
                return photo;
            },
        },
        created() {
             axios.get("api/profile")
            .then(response => {this.form.fill(response.data.user),this.user=response.data.user});
       
            
        }
    }
</script>
<style>
    .modelImage{
        height:30vh;
        width:30vh;
    }
</style>