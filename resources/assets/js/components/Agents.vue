<template>
    <div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrEmployee()">
          <div class="col-12">
             <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#running_tasks" data-toggle="tab">Running Tasks</a></li>
                        <li class="nav-item"><a class="nav-link" href="#completed_tasks" data-toggle="tab">Completed Tasks</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" id="completed_tasks">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Completed Tasks</h3>

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
                                            
                                            <tr v-for="task in agent_task" :key="task.id"  v-if="task.status == 'Completed'">
                                                <td>{{task.id}}</td>
                                                <td><a href="#" @click="showModal(task.id)">{{task.title}}</a></td>
                                                <td>{{task.user.name}}</td>
                                                <td>{{task.address}}</td>
                                                <td>{{task.customer_phone}}</td>
                                                <td>{{task.description}}</td>
                                                <td>{{task.date | myDateTime}}</td>
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
                            <!-- Activity Tab -->
                            <div class="tab-pane active show" id="running_tasks">
                                
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Running Tasks</h3>

                                        <div class="card-tools">
                                        <button class="btn btn-success" @click="newModal">
                                            Add New Task 
                                            <i class="fas fa-user-plus fa-fw"></i>
                                            </button>
                                            
                                        </div>
                                    </div>
                                    <div v-if="$gate.isAdmin()">
                                    <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            
                                            <table class="table table-hover">
                                            <tbody>
                                            <tr>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>User</th>
                                                <th>Type</th>
                                                <th>Address</th>
                                                <th>Customer Phone</th>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Modify</th>
                                            </tr>
                                            
                                            <tr v-for="task in agent_task" :key="task.id"  v-if="task.status == 'Running'">
                                                
                                                    <td>{{task.id}}</td>
                                                    <td><a href="#" @click="showModal(task.id)">{{task.title}}</a></td>
                                                    <td>{{task.user.name}}</td>
                                                    <td>{{task.user.type}}</td>
                                                    <td>{{task.address}}</td>
                                                    <td>{{task.customer_phone}}</td>
                                                    <td>{{task.description}}</td>
                                                    <td>{{task.date | myDateTime}}</td>
                                                    <td><label  class="btn label-info">{{task.status}}</label></td>
                                                    <td>
                                                        <a href="#" @click="editModal(task)">
                                                            <i class="fa fa-edit blue"></i>
                                                        </a>
                                                        /
                                                        <a href="#" @click="deleteTasks(task.id)">
                                                            <i class="fa fa-trash red"></i>
                                                        </a>
                                                    </td>
                                                
                                            </tr>
                                            
                                            </tbody></table>
                                        </div>
                                    </div>
                                    <div v-if="$gate.isEmployee()">
                                    <!-- /.card-header -->
                                        <div class="card-body table-responsive p-0">
                                            <table class="table table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Title</th>
                                                        <th>User</th>
                                                        <th>Type</th>
                                                        <th>Address</th>
                                                        <th>Customer Phone</th>
                                                        <th>Description</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Modify</th>
                                                    </tr>
                                                    <tr  v-for="task in agent_task" :key="task.id"  v-if="task.status == 'Running' && task.user.type != 'Admin'">
                                                        <td>{{task.id}}</td>
                                                        <td><a href="#" @click="showModal(task.id)">{{task.title}}</a></td>
                                                        <td>{{task.user.name}}</td>
                                                        <td>{{task.user.type}}</td>
                                                        <td>{{task.address}}</td>
                                                        <td>{{task.customer_phone}}</td>
                                                        <td>{{task.description}}</td>
                                                        <!--<td>{{task.date | moment("dddd, MMMM Do YYYY")}}</td>-->
                                                        <td>{{task.date | myDateTime }}</td>
                                                        <td><label  class="btn label-info">{{task.status}}</label></td>
                                                        <td>
                                                            <a href="#" @click="editModal(task)">
                                                                <i class="fa fa-edit blue"></i>
                                                            </a>
                                                            /
                                                            <a href="#" @click="deleteTasks(task.id)">
                                                                <i class="fa fa-trash red"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Project's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateTask() : createTask()">
                        <div class="modal-body">
                            <div class="form-group">
                                
                                
                                <label>Title<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.title" type="text" name="title"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }"
                                    v-validate="'required|alpha'">
                                <span class="red">{{ errors.first('title') }}</span>
                                <has-error :form="form" field="title"></has-error>
                            </div>

                            <div class="form-group" v-if="$gate.isAdmin()">
                                <label>User Name<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.user_id"  id="user_id" name="user_id"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }"
                                    v-validate="'required'">
                                        <option disabled selected value>Select an User</option>
                                        <option v-for="user in users" :key="user.id" :value="user.id">{{user.type}}:{{user.name}}</option>    
                                                            
                                </select>
                                <span class="red">{{ errors.first('user_id') }}</span>
                                <has-error :form="form" field="user_id"></has-error>
                            </div>

                            <div class="form-group" v-if="$gate.isEmployee()">
                                <label>User Name<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.user_id"  id="user_id" name="user_id"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }"
                                    v-validate="'required'">
                                        <option disabled selected value>Select an User</option>
                                        <option v-for="user in users" :key="user.id" :value="user.id" v-if="user.type != 'Admin'" >{{user.type}}::{{user.name}}</option>    
                                                            
                                </select>
                                <span class="red">{{ errors.first('user_id') }}</span>
                                <has-error :form="form" field="user_id"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Address<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.address" type="text" name="address"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('address') }"
                                    v-validate="'required|max:190'">
                                <span class="red">{{ errors.first('address') }}</span>
                                <has-error :form="form" field="address"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Customer Contact<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.customer_phone" type="text" name="customer_phone"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('customer_phone') }"
                                    v-validate="'required|digits:10'">
                                <span class="red">{{ errors.first('customer_phone') }}</span>
                                <has-error :form="form" field="customer_phone"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Description<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.description" type="text" name="description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"
                                    v-validate="'required|max:300'">
                                <span class="red">{{ errors.first('description') }}</span>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Date<i class="fas fa-asterisk red"></i></label>
                                <!--<input v-model="form.date" type="text" name="date"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('date') }">-->
                                <datetime type="datetime" v-model="form.date" name="date"
                                     :class="{ 'is-invalid': form.errors.has('date') }" 
                                     v-validate="'required'" :min-datetime="current_date3" ></datetime>
                                <span class="red">{{ errors.first('date') }}</span>
                                <has-error :form="form" field="date"></has-error>
                                
                            </div>
                            
                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="form.status" id="status" name="status"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('status') }"
                                    v-validate="'required'">
                                    
                                    <option value="Running">Running</option>
                                    <option value="Completed">Completed</option>
                                    
                                </select>
                                <span class="red">{{ errors.first('status') }}</span>
                                <has-error :form="form" field="status"></has-error>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            <button v-show="!editmode" type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

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
</template>

<script>
    export default {
        data(){
            return{
                current_date1 : Date.now(),
                current_date2 : '2019-03-04T14:58Z',
                current_date3 : new Date().toISOString(),
                editmode: false,
                agent_task : [],
                users : [],
                task : [],
                form: new Form({
                    id: '',
                    user_id: '',
                    
                    title: '',
                    description: '',
                    address: '',
                    customer_phone: '',
                    date: '',
                    status:'',
                    
                })
            }
        },
        methods: {
         loadTasks(){
                
                    
                    //it will fetch data into data and then to the users object
                    axios.get("api/agents")
                    .then(response => {this.agent_task = response.data.agent_task,this.users = response.data.users});
                    
                
            },
            createTask(){
                this.$validator.validateAll()
                    .then((result) => {
                        if(result){
                            this.$Progress.start();

                            this.form.post('api/agents')
                            .then(() =>{
                                Fire.$emit('AfterCreate');
                                $('#addNew').modal('hide');
                                toast.fire({
                                    type: 'success',
                                    title: 'Project Created successfully'
                                });
                                this.$Progress.finish();  
                            })
                            .catch(() => {
                                console.log("error");
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
            deleteTasks(id){
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
                        this.form.delete('api/agents/'+id)
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
            updateTask(){
                this.$Progress.start();
                this.form.put('api/agents/'+this.form.id)
                .then(() => {
                    //on success
                    $('#addNew').modal('hide');
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
            webcamSendRequestButton: function(e) {
                var buttonValue = e.target.value;
                
                console.log(buttonValue);
                this.form.status = buttonValue;
                
                
            },
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(tasks){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                
                this.form.fill(tasks);
                
                
                
            }, 
            showModal(id){
                console.log(id);
                axios.get("api/agents/"+id).then(response => {this.task = response.data.task});
                
                $('#showTask').modal('show');
            },
            
            getResults(page = 1){
                axios.get('api/agents?page='+page)
                    .then(response=>{
                        this.agent_task = response.data;
                    });
            }
            
            
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
            Fire.$on('AfterCreate', () => {
                //this.getProfilePhoto();
                this.loadTasks();
                });
        }
    }
</script>


