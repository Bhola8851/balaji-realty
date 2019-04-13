<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tasks Table</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <form @submit.prevent="updateUser()">  
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Agent</th>
                    <th>Address</th>
                    <th>Customer Phone</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Status</th>
                    
                  </tr>
                  
                  <tr v-for="task in agent_task" :key="task.id" v-if="task.status == 'Running'">
                      
                        <td>{{task.id}}</td>
                        <td><a href="#"  @click="showModal(task.id)">{{task.title}}</a></td>
                        <td>{{task.user.name}}</td>
                        <td>{{task.address}}</td>
                        <td>{{task.customer_phone}}</td>
                        <td>{{task.description}}</td>
                        <td>{{task.date | myDateTime }}</td>
                        <td><a href="#" @click="editModal(task)">{{task.status}}<br/>
                            <i class="fa fa-edit blue"></i>
                        </a>     
                        </td>
                      
                    
                    
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
                    <form @submit.prevent="updateUser()">
                        <div class="modal-body">
                            

                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="form.status" id="status" name="status"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('status') }">
                                    <option disabled value>Change the status</option>
                                    <option value="Runnning">Runnning</option>
                                    <option value="Completed">Completed</option>
                                    
                                </select>
                                <has-error :form="form" field="status"></has-error>
                            </div>
                            
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button v-show="editmode" type="submit" class="btn btn-success">Update</button>
                            
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
                editmode: false,
                agent_task : [],
                task : [],
                user : [],
                users :[],
                 form: new Form({
                    id : '',
                    user_id : '',
                    title : '',
                    description : '',
                    address : '',
                    customer_phone : '',
                    date : '',
                    status:'',
                 })
                    
              
            }
        },
        methods: {
        loadTasks(){
                
                    
                    //it will fetch data into data and then to the users object
                    axios.get("api/task")
                    .then(response => {this.agent_task = response.data.agent_task,this.users = response.data.users});
                    
                
        },
        updateUser(){
                this.$Progress.start();
                console.log(this.form.id);
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
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
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
                axios.get('api/findMyTask?q='+ query)
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
