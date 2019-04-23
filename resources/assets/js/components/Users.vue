<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrEmployee()">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users Table</h3>

                <div class="card-tools" v-if="$gate.isAdmin()">
                  <button class="btn btn-success" @click="newModal">
                      Add New User
                      <i class="fas fa-user-plus fa-fw"></i>
                    </button>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover  invoice">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Online</th>
                    <th>Registered at</th>
                    <th v-if="$gate.isAdmin()">Modify</th>
                  </tr>
                  <tr v-for="user in users" :key="user.id">
                    <td>{{user.id}}</td>
                    <td><a href="#"  @click="showModal(user.id)">{{user.name}}</a></td>
                    <td>{{user.email}}</td>
                    <td>{{user.type | upText}}</td>
                    <td>{{user.status}}</td>
                    <td v-if="user.isOnline" class="label btn-success">Online</td>
                    <td v-if="!user.isOnline" class="label btn-danger">Offline</td>
                    <td>{{user.created_at | myDate}}</td>

                    <td v-if="$gate.isAdmin()">
                        <a href="#" @click="updateStatusModal(user)">
                            <i class="fa fa-exclamation-circle orange"></i>
                        </a>
                        /
                        <a href="#" @click="editModal(user)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteUser(user.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>

                </tbody></table>
              </div>
              <!--<div class="card-footer">
                  <pagination :data="users" @pagination-change-page="getResults"></pagination>
              </div>-->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <div v-if="!$gate.isAdminOrEmployee()">

            <not-found></not-found>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Username<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.name" type="text" name="name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"
                                    v-validate="'required|alpha'">
                                <span class="red" v-show="errors.has('name')">{{ errors.first('name') }}</span>
                                <has-error :form="form" field="name"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Email<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.email" type="text" name="email" id="email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('email') }"
                                    v-validate="'required|email'" >
                                    <span class="red" v-show="errors.has('email')">{{ errors.first('email') }}</span>
                                <has-error :form="form" field="email"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Address<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.address" type="text" name="address"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"
                                    v-validate="'required|max:190'">
                                <span class="red" v-show="errors.has('address')">{{ errors.first('address') }}</span>
                                <has-error :form="form" field="address"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Phone<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.phone" type="text" name="phone"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }"
                                    v-validate="'required|digits:10'">
                                <span class="red" v-show="errors.has('phone')">{{ errors.first('phone') }}</span>
                                <has-error :form="form" field="phone"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Date of Birth<i class="fas fa-asterisk red"></i></label>
                                <!--<input v-model="form.dob" type="text" name="dob"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('dob') }">
                                <has-error :form="form" field="dob"></has-error>-->
                                <datetime type="date" v-model="form.dob" name="dob"
                                     :class="{ 'is-invalid': form.errors.has('dob') }"
                                     v-validate="'required'" :max-datetime="max_date"></datetime>
                                <span class="red" v-show="errors.has('dob')">{{ errors.first('dob') }}</span>
                                <has-error :form="form" field="dob"></has-error>
                            </div>

                            <div class="form-group">
                                <label>gender<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.gender" id="gender" name="gender"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('gender') }"
                                    v-validate="'required|included:male,female'" data-vv-as="selected">

                                    <option value="male">male</option>
                                    <option value="female">female</option>

                                </select>
                                <span class="red" v-show="errors.has('gender')">{{ errors.first('gender') }}</span>
                                <has-error :form="form" field="gender"></has-error>
                            </div>



                            <div class="form-group">
                                <label>Description<i class="fas fa-asterisk red"></i></label>
                                <textarea v-model="form.bio" type="text" name="bio"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"
                                    v-validate="'required|max:300'"></textarea>
                                <span class="red" v-show="errors.has('bio')">{{ errors.first('bio') }}</span>
                                <has-error :form="form" field="bio"></has-error>
                            </div>

                            <div class="form-group">
                                <label>User Role<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.type" id="type" name="type"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('type') }"
                                    v-validate="'required|included:Admin,Employee,Agent,Supplier'">

                                    <option value="Admin">Admin</option>
                                    <option value="Employee">Employee</option>
                                    <option value="Agent">Agent</option>
                                    <option value="Supplier">Supplier</option>
                                </select>
                                <span class="red" v-show="errors.has('type')">{{ errors.first('type') }}</span>
                                <has-error :form="form" field="type"></has-error>
                            </div>

                            <div class="form-group" v-show="!editmode">
                                <label>Password<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.password" type="password" name="password"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('password') }"
                                    v-validate="'required'">
                                <span class="red" v-show="errors.has('password')">{{ errors.first('password') }}</span>
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode"  type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- User info model -->
        <!-- Modal -->
        <div class="modal fade" id="showUser" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">User Info</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <!--Profile Table-->
                            <table class="table table-bordered mt-3">

                                <tr>
                                    <th>Profile Picture</th>
                                    <td>
                                        <div class="widget-user-image">
                                            <img class="img-circle img-fluid img-responsive modelImage" :src="getProfilePhoto()" alt="User Avatar">
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
                                    <td>{{user.dob}}</td>
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
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                </div>
            </div>
        </div>

        <!-- Update Status Model -->
        <!-- Modal -->
        <div class="modal fade" id="updateStatus" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update User's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateUser()">
                        <div class="modal-body">


                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="form.status" id="status" name="status"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                    <option disabled value>Change the status</option>
                                    <option value="Active">Active</option>
                                    <option value="Banned">Banned</option>

                                </select>
                                <has-error :form="form" field="status"></has-error>
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger"  data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                max_date : '2001-04-26T00:58Z',
                editmode: false,
                users : [],
                user:[],
                form: new Form({
                    id: '',
                    name: '',
                    email: '',
                    address: '',
                    phone: '',
                    dob: '',
                    gender: '',
                    status: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: ''
                })
            }
        },
        methods: {

            loadUsers(){
                if (this.$gate.isAdminOrEmployee()) {

                    //it will fetch data into data and then to the users object
                    axios.get("api/users").then(response => {this.users = response.data.users});

                }
            },
            getProfilePhoto(){
                let photo ="./img/profile/"+ this.user.photo ;
                return photo;
            },

            createUser(){

                this.$validator.validateAll()
                    .then((result) => {
                        if(result){
                            this.$Progress.start();

                            this.form.post('api/users')
                            .then(() =>{
                                Fire.$emit('AfterCreate');
                                $('#addNew').modal('hide');
                                toast.fire({
                                    type: 'success',
                                    title: 'User Created successfully'
                                });
                                this.$Progress.finish();
                            })
                            .catch(() => {

                            })
                        }
                        else{
                            console.log(this.$validator);
                        }

                })
                .catch(()=>{
                    console.log("Please Validate")
                })


            },
            deleteUser(id){
                sweetAlert.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                .then((result) => {
                    if (result.value) {
                        //send delete request to the server
                        this.form.delete('api/users/'+id)
                            .then(()=>{

                                    sweetAlert.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                    )

                                Fire.$emit('AfterCreate');

                            })
                            .catch(()=>{

                            sweetAlert.fire("Failed!","There was something wrong","warning");
                            });
                        }

                })
            },
            updateUser(){

                this.$Progress.start();

                this.form.put('api/users/'+this.form.id)
                .then(() => {
                    //on success
                    $('#addNew').modal('hide');
                    $('#updateStatus').modal('hide');
                    sweetAlert.fire(
                        'Upadted!',
                        'Information has been Upadted.',
                        'success'
                        )
                    this.$Progress.finish();
                    Fire.$emit('AfterCreate');
                })
                .catch(() => {
                    this.$Progress.fail();
                });
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            showModal(id){
                console.log(id);
                axios.get("api/users/"+id).then(({ data }) => (this.user = data));
                $('#showUser').modal('show');
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            updateStatusModal(user){
                this.editmode = true;
                this.form.reset();
                $('#updateStatus').modal('show');
                this.form.fill(user);
            },
            getResults(page = 1){
                axios.get('api/users?page='+page)
                    .then(response=>{
                        this.users = response.data;
                    });
            },

        },
        created() {


            Fire.$on('searching',() => {
                console.log('searching');
                let query = this.$parent.search;
                axios.get('api/findUser?q='+ query)
                    .then(response=>{
                        this.users = response.data.users
                    })
                    .catch(()=>{
                        console.log('error')
                    })
            });
            this.loadUsers();
            Fire.$on('AfterCreate', () => {

                this.loadUsers();
                });
            //setInterval(() => this.loadUsers(),3000);
        }
    }
</script>

<style>
    .modelImage{
        height:10vh;
    }
</style>
