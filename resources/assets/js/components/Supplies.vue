<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Supplies Table</h3>

                <div class="card-tools">
                  
                </div>
              </div>
              
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <form @submit.prevent="updateSupplies()">  
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Material</th>
                        <th>Assigned By</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Date</th>
                        <th>Status</th>
                    
                    </tr>
                  
                  <tr v-for="goods in supplies" :key="goods.id" v-if="goods.user.id == current_user.id">
                      
                        <td>{{goods.id}}</td>
                        <td><a href="#"  @click="showModal(goods.id)">{{goods.material}}</a></td>
                        <td>{{goods.user.name}}</td>
                        <td>{{goods.quantity}}</td>
                        <td>{{goods.price}}</td>
                        <td>{{goods.date | myDate }}</td>
                        <td><a href="#" @click="editModal(goods)">{{goods.status}}<br/>
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
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Supplies's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="updateSupplies()">
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
                                    <th>Id</th>
                                    <td>{{supply.id}}</td>
                                </tr>
                                
                                <tr>
                                    <th>Material</th>
                                    <td>{{supply.material}}</td>
                                </tr>
                                <tr>
                                    <th>Brand</th>
                                    <td>{{supply.brand}}</td>
                                </tr>
                                <tr>
                                    <th>Quantity</th>
                                    <td>{{supply.quantity}}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>{{supply.price}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{supply.address}}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{supply.description}}</td>
                                </tr>
                                <tr>
                                    <th>Date Time</th>
                                    <td>{{supply.date | moment("dddd, MMMM Do YYYY")}}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{supply.status}}</td>
                                    
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
                supplies : [],
                supply : [],
                user : [],
                users :[],
                current_user : [],
                 form: new Form({
                    id : '',
                    material : '',
                    brand : '',
                    quantity : '',
                    price : '',
                    address : '',
                    date : '',
                    description : '',
                    status : '',
                 })
                    
              
            }
        },
        methods: {
        loadSupplies(){
                
                    
                    //it will fetch data into data and then to the users object
                    axios.get("api/suppliers")
                    .then(response => {this.supplies = response.data.supplies,
                                        this.users = response.data.users
                                        this.current_user = response.data.current_user
                                        });
                    
                
        },
        updateSupplies(){
                this.$Progress.start();
                console.log(this.form.id);
                this.form.put('api/suppliers/'+this.form.id)
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
                axios.get("api/suppliers/"+id).then(response => {this.supply = response.data.supply});
                
                $('#showTask').modal('show');
            },
        
            
        },
        created() {
            Fire.$on('searching',() => {
                console.log('searching');
                let query = this.$parent.search;
                axios.get('api/findSupplies?q='+ query)
                    .then(response=>{
                        this.supplies = response.data.supplies,
                        this.users = response.data.users
                        this.current_user = response.data.current_user
                    })
                    .catch(()=>{

                    })
            });

            this.loadSupplies();
            Fire.$on('AfterCreate', () => {
                //this.getProfilePhoto();
                this.loadSupplies();
                });
        }
    }
</script>
