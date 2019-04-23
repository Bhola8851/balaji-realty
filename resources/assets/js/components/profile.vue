<style>
.widget-user-header{
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}
.widget-user .card-footer{
    padding: 0;
}
</style>


<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./img/darkbg.jpg')">
                    <h3 class="widget-user-username">{{this.form.name}}</h3>
                    <h5 class="widget-user-desc">{{this.form.type}}</h5>
                </div>
                <div class="widget-user-image">
                    <img class="img-circle modelImage" :src="getProfilePhoto()" alt="User Avatar">
                </div>
                <div class="card-footer">
                    <div class="row">
                    <div class="col-sm-6 border-right">
                        <div class="description-block">
                        <h5 class="description-header">{{count}}</h5>
                        <span class="description-text">Workers</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-sm-6">
                        <div class="description-block">
                        <h5 class="description-header">{{projects}}</h5>
                        <span class="description-text">PROJECTS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#activity" data-toggle="tab">Activity</a></li>
                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane active show" id="activity">
                                <h3 class="text-center">Completed Task</h3>

                                 <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Completed Task</h3>

                                        <div class="card-tools">

                                        </div>
                                    </div>

                                    <!-- /.card-header -->
                                    <div class="card-body table-responsive p-0">
                                        <form @submit.prevent="updateUser()">
                                        <table class="table table-hover">
                                            <tbody><tr>
                                                <th>Task ID</th>
                                                <th>Title</th>
                                                <th>Agent</th>
                                                <th>Address</th>
                                                <th>Customer Phone</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                            </tr>

                                            <tr v-for="task in agent_task" :key="task.id" v-if="task.status = 'Completed'">
                                                <td>{{task.id}}</td>
                                                <td><a href="#" @click="showModal(task.id)">{{task.title}}</a></td>
                                                <td>{{task.user.name}}</td>
                                                <td>{{task.address}}</td>
                                                <td>{{task.customer_phone}}</td>
                                                <td>{{task.description}}</td>
                                                <td>{{task.date | myDateTime()}}</td>
                                                <td><span  class="badge badge-primary ">{{task.status}}</span></td>
                                            </tr>

                                        </tbody>
                                        </table>
                                        </form>
                                    </div>
                                    <div class="card-footer">

                                    </div>
                                    <!-- /.card-body -->
                                    </div>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane" id="settings">
                                <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name<i class="fas fa-asterisk red"></i></label>

                                    <div class="col-sm-12">
                                    <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                     <has-error :form="form" field="name"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email<i class="fas fa-asterisk red"></i></label>

                                    <div class="col-sm-12">
                                    <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                     <has-error :form="form" field="email"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label">Phone<i class="fas fa-asterisk red"></i></label>

                                    <div class="col-sm-12">
                                    <input type="phone" v-model="form.phone" class="form-control" id="inputPhone" placeholder="phone"  :class="{ 'is-invalid': form.errors.has('phone') }">
                                     <has-error :form="form" field="phone"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="dob" class="col-sm-2 control-label">Date of Birth<i class="fas fa-asterisk red"></i></label>

                                    <div class="col-sm-12">
                                    <!--<input type="dob" v-model="form.dob" class="form-control" id="inputDob" placeholder="Date of Birth"  :class="{ 'is-invalid': form.errors.has('dob') }">
                                     <has-error :form="form" field="dob"></has-error>-->
                                        <label style="padding-right: 5px;">{{this.form.dob|myDate}}</label>
                                        <datetime @change="getBirthDay"  type="date" v-model="form.dob" name="dob" class="fa fa-calendar-alt blue"
                                        :class="{ 'is-invalid': form.errors.has('dob') }" v-validate="'required'"
                                        :max-datetime="max_date"></datetime>
                                        <span class="red">{{ errors.first('dob') }}</span>

                                        <has-error :form="form" field="dob"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputAddress" class="col-sm-2 control-label">Address<i class="fas fa-asterisk red"></i></label>

                                    <div class="col-sm-12">
                                    <textarea  v-model="form.address" class="form-control" id="inputAddress" placeholder="Address" :class="{ 'is-invalid': form.errors.has('address') }"></textarea>
                                     <has-error :form="form" field="address"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Experience<i class="fas fa-asterisk red"></i></label>

                                    <div class="col-sm-12">
                                    <textarea  v-model="form.bio" class="form-control" id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                     <has-error :form="form" field="bio"></has-error>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                    <div class="col-sm-12">
                                        <input type="file" @change="updateProfile" name="photo" id="photo" class="form-input">
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="password" class="col-sm-12 control-label">Password (leave empty if not changing)</label>

                                    <div class="col-sm-12">
                                    <input type="password"
                                        v-model="form.password"
                                        class="form-control"
                                        id="password"
                                        placeholder="Password"
                                        :class="{ 'is-invalid': form.errors.has('password') }"
                                    >
                                     <has-error :form="form" field="password"></has-error>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-12">
                                    <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
          </div>
          <!-- end tabs -->

          <!-- Task info model -->
        <!-- Modal -->
        <div class="modal fade" id="showTask" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">Task Info</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <!--Profile Table-->
                            <table class="table table-bordered mt-3">


                                <tr>
                                    <th>Title</th>
                                    <td>{{task.title}}</td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{task.address}}</td>
                                </tr>
                                <tr>
                                    <th>Customer Phone</th>
                                    <td>{{task.customer_phone}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{task.description}}</td>
                                </tr>
                                <tr>
                                    <th>Date Time</th>
                                    <td>{{task.date | moment("dddd, MMMM Do YYYY")}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{task.address}}</td>

                                </tr>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                </div>
            </div>
        </div>
        </div>

    </div>
</template>



<script>
    export default {
        data(){
            return {
                current_date1 : Date.now(),

                dob : '',
                max_date : '2001-04-26T12:58Z',
                current_date : new Date("2015-03-25T12:00:00Z"),
                projects : [],
                count : [],
                agent_task : [],
                users :[],
                task : [],
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
        watch: {
        cool() {
            this.getBirthDay();
        }
        },
        mounted() {
            console.log('Component mounted.')
            this.getBirthDay();
        },
        methods:{
            getBirthDay(){
                if(new Date() == new Date(this.form.dob)){
                    console.log('success');
                }
                else{
                    console.log('134');
                    this.form.dob = this.dob;
                }
            },
            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "./img/profile/"+ this.form.photo ;
                return photo;
            },
            loadTasks(){
                //it will fetch data into data and then to the users object

                axios.get("api/task")
                .then(response => {this.agent_task = response.data.agent_task,this.users = response.data.users});
            },
            updateInfo(){

                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('api/profile')
                .then(()=>{
                    sweetAlert.fire(
                        'Upadted!',
                        'Profile has been Upadted.',
                        'success'
                    )
                     Fire.$emit('AfterCreate');
                     Fire.$emit('RefreshTable');
                    this.$Progress.finish();
                    document.getElementById("photo").value = "";
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            updateProfile(e){
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 2111775;
                if(file['size'] < 2111775){
                    reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                    }
                    reader.readAsDataURL(file);

                }
                else{
                    sweetAlert.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file It will not be uploaded',
                    })
                    document.getElementById("photo").value = "";
                    return false;
                }




            },
            showModal(id){
                console.log(id);
                axios.get("api/agents/"+id).then(response => {this.task = response.data.task});

                $('#showTask').modal('show');
            },
        },

        created() {
            Fire.$on('searching',() => {
                console.log('searching');
                let query = this.$parent.search;
                axios.get('api/findTask?q='+ query)
                    .then(response=>{
                        this.agent_task = response.data.agent_task,this.users = response.data.users
                    })
                    .catch(()=>{

                    })
            });
            this.loadTasks();
            //axios.get("api/profile")
            //.then(({ data }) => (this.form.fill(data)));
            axios.get("api/profile")
            .then(response => {this.form.fill(response.data.user),this.count = response.data.count,this.projects = response.data.projects});
        }
    }
</script>
<style>
    .modelImage{
        height:15vh !important;
        width: 20vh !important;
    }
</style>
