<template>
<div class="container">
        <div class="row mt-5" v-if="$gate.isAdminOrSupplier()">
          <div class="col-12" >
              <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active show" href="#available_supply" data-toggle="tab">Available Supplies</a></li>
                        <li class="nav-item"><a class="nav-link" href="#not_available_supply" data-toggle="tab">Not Available Supplies</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane  active show" id="available_supply">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Material Table</h3>

                                    <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal">
                                        Add New Material 
                                        <i class="fas fa-user-plus fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                    <tbody><tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr v-for="supply in supplies" :key="supply.id" v-if="users.id == supply.user_id && supply.status == 'Available'">
                                        <td>{{supply.id}}</td>
                                        <td>{{supply.material}}</td>
                                        <td>{{supply.brand}}</td>
                                        <td>{{supply.quantity}}</td>
                                        <td>{{supply.price}}</td>
                                        <td>{{supply.date | myDate}}</td>
                                        <td>{{supply.status}}</td>
                                        <td>
                                            <a href="#" @click="editModal(supply)">
                                                <i class="fa fa-edit blue"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteUser(supply.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                    
                                    </table>
                                </div>
                                <div class="card-footer">
                                </div>
                                <!-- /.card-body -->
                                </div>
                            </div>
                            <div class="tab-pane" id="not_available_supply">
                                <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Material Table</h3>

                                    <div class="card-tools">
                                    <button class="btn btn-success" @click="newModal">
                                        Add New Material 
                                        <i class="fas fa-user-plus fa-fw"></i>
                                        </button>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover">
                                    <tbody><tr>
                                        <th>ID</th>
                                        <th>Material</th>
                                        <th>Brand</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Modify</th>
                                    </tr>
                                    <tr v-for="supply in supplies" :key="supply.id" v-if="users.id == supply.user_id && supply.status == 'Not Available'">
                                        <td>{{supply.id}}</td>
                                        <td>{{supply.material}}</td>
                                        <td>{{supply.brand}}</td>
                                        <td>{{supply.quantity}}</td>
                                        <td>{{supply.price}}</td>
                                        <td>{{supply.date | myDate}}</td>
                                        <td>{{supply.status}}</td>
                                        <td>
                                            <a href="#" @click="editModal(supply)">
                                                <i class="fa fa-edit blue"></i>
                                            </a>
                                            /
                                            <a href="#" @click="deleteUser(supply.id)">
                                                <i class="fa fa-trash red"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                    </tbody>
                                    
                                    </table>
                                </div>
                                <div class="card-footer">
                                </div>
                                <!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
              </div>    
            <!-- /.card -->
          </div>
        </div>
          <div v-if="!$gate.isAdminOrSupplier()">
            <not-found></not-found>
          </div>
        
        
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Goods</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Goods Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Material</label>
                                <input v-model="form.material" type="text" name="material"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('material') }"
                                    v-validate="'required'">
                                <span class="red">{{ errors.first('material') }}</span>
                                <has-error :form="form" field="material"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Brand</label>
                                <input v-model="form.brand" type="text" name="brand"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('brand') }"
                                    v-validate="'required'">
                                <span class="red">{{ errors.first('brand') }}</span>
                                <has-error :form="form" field="brand"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input v-model="form.quantity" type="text" name="quantity"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('quantity') }"
                                    v-validate="'required|max_value:100'">
                                <span class="red">{{ errors.first('quantity') }}</span>
                                <has-error :form="form" field="quantity"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Price(per quantity)</label>
                                <input v-model="form.price" type="text" name="price"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('price') }"
                                    v-validate="'required|max_value:10000'">
                                <span class="red">{{ errors.first('price') }}</span>
                                <has-error :form="form" field="price"></has-error>
                            </div>

                            
                            <div class="form-group">
                                <label>Description(optional)</label>
                                <textarea v-model="form.description" type="text" name="description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"
                                    v-validate="'required|max:300'"></textarea>
                                <span class="red">{{ errors.first('description') }}</span>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Status</label>
                                <select v-model="form.status" id="type" name="status"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('status') }"
                                    v-validate="'required'">
                                    
                                    <option value="Available">Available</option>
                                    <option value="Not Available">Not Available</option>
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
    
</div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                users : [],
                supplies : [],
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
            
            loadUsers(){
                
                    
                    //it will fetch data into data and then to the users object
                    
                    axios.get("api/materials")
                    .then(response => {this.supplies = response.data.materials,this.users = response.data.users});
                
            },
            createUser(){
                this.$validator.validateAll()
                    .then((result) => {
                        if(result){
                            this.$Progress.start();

                            this.form.post('api/materials')
                            .then(() =>{
                                Fire.$emit('AfterCreate');
                                $('#addNew').modal('hide');
                                toast.fire({
                                    type: 'success',
                                    title: 'Supplies Created successfully'
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
                        this.form.delete('api/materials/'+id)
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
                this.form.put('api/materials/'+this.form.id)
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
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(user){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(user);
            },
            getResults(page = 1){
                axios.get('api/materials?page='+page)
                    .then(response=>{
                        this.supplies = response.data;
                    });
            }
            
        },
        created() {
            Fire.$on('searching',() => {
                console.log('searching');
                let query = this.$parent.search;
                axios.get('api/findMaterials?q='+ query)
                    .then(response=>{this.supplies = response.data.materials,this.users = response.data.users})
                    .catch(()=>{

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
