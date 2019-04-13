<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Supplies Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                      Add New Supplies 
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
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Date</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="supply in supplies" :key="supply.id">
                    <td>{{supply.id}}</td>
                    <td>{{supply.material}}</td>
                    <td>{{supply.quantity}}</td>
                    <td>{{supply.price}}</td>
                    <td>{{supply.date | myDate}}</td>
                    
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
            <!-- /.card -->
          </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Request Supplies</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Supplies Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Supplier<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.user_id"  id="user_id" name="user_id"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }"
                                    v-validate="'required'">
                                        <option disabled selected value>Select an Supplier</option>
                                        <option v-for="user in users" :key="user.id" :value="user.id" v-if="user.type == 'Supplier'" >{{user.type}}::{{user.name}}</option>    
                                                            
                                </select>
                                <span class="red">{{ errors.first('user_id') }}</span>
                                <has-error :form="form" field="user_id"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Material<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.material"  id="material" name="material"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('material') }"
                                    v-validate="'required'">
                                        
                                        <option disabled selected value>Select a Material</option>
                                        <option v-for="material in materials" :key="material.id" :value="material.material" 
                                                v-if="material.user_id == form.user_id" >{{material.material}}</option>    
                                    
                                </select>
                                <span class="red">{{ errors.first('material') }}</span>
                                <has-error :form="form" field="material"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Brand<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.brand"  id="brand" name="brand"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('brand') }"
                                    v-validate="'required'">
                                        
                                        <option disabled selected value>Select a Material Brand</option>
                                        <option v-for="material in materials" :key="material.id" :value="material.brand" 
                                                v-if="material.user_id == form.user_id && material.material == form.material" >{{material.brand}}</option>    
                                    
                                </select>
                                <span class="red">{{ errors.first('brand') }}</span>
                                <has-error :form="form" field="brand"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Quantity<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.quantity" type="text" name="quantity"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('quantity') }"
                                    v-validate="'required|max_value:100'">
                                <span class="red">{{ errors.first('quantity') }}</span>
                                <has-error :form="form" field="quantity"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Price(per quantity)<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.price"  id="price" name="price"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('price') }"
                                    v-validate="'required'">
                                        
                                        <option disabled selected value>Select a Material Price</option>
                                        <option v-for="material in materials" :key="material.id" :value="material.brand" 
                                                v-if="material.user_id == form.user_id && material.material == form.material" >{{material.price}}</option>    
                                    
                                </select>
                                <span class="red">{{ errors.first('price') }}</span>
                                <has-error :form="form" field="price"></has-error>
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
                                <label>Date<i class="fas fa-asterisk red"></i></label>
                                <datetime type="date" v-model="form.date" name="date"
                                     :class="{ 'is-invalid': form.errors.has('date') }"
                                     v-validate="'required'"></datetime>
                                <span class="red">{{ errors.first('date') }}</span>
                                <has-error :form="form" field="date"></has-error>
                            </div>
                            
                            <div class="form-group">
                                <label>Description<i class="fas fa-asterisk red"></i></label>
                                <textarea v-model="form.description" type="text" name="description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"
                                    v-validate="'required'"></textarea>
                                <span class="red">{{ errors.first('description') }}</span>
                                <has-error :form="form" field="description"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Status<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.status" id="type" name="status"
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
    </div>
</template>

<script>
    export default {
        data(){
            return{
                editmode: false,
                users : [],
                supplies : [],
                materials : [],
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
                    user_id : '',
                })
            }
        },
        methods: {
            
            loadUsers(){
                
                    
                    //it will fetch data into data and then to the users object
                    
                    axios.get("api/suppliers")
                    .then(response => {this.supplies = response.data.supplies,
                        this.users = response.data.users,
                        this.materials = response.data.materials,
                        this.current_user = response.data.current_user
                        });
                
            },
            createUser(){
                this.$validator.validateAll()
                    .then((result) => {
                        if(result){
                            this.$Progress.start();

                            this.form.post('api/suppliers')
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
                        this.form.delete('api/suppliers/'+id)
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
                axios.get('api/suppliers?page='+page)
                    .then(response=>{
                        this.users = response.data;
                    });
            }
            
        },
        created() {
            Fire.$on('searching',() => {
                console.log('searching');
                let query = this.$parent.search;
                axios.get('api/findSupplier?q='+ query)
                    .then(response=>{
                        this.supplies = response.data.supplies,
                        this.users = response.data.users,
                        this.materials = response.data.materials,
                        this.current_user = response.data.current_user
                    })
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
