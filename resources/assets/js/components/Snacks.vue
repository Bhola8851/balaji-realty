<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Customer Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                      Add New Customer
                      <i class="fas fa-user-plus fa-fw"></i>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Product</th>
                        <th>Modify</th>
                    </tr>
                    <tr v-for="customer in Customer_data.data" :key="customer.id">
                        <td>{{customer.id}}</td>
                        <td><a href="#"  @click="showModal(customer.id)">{{customer.customer_name}}</a></td>
                        <td>{{customer.customer_contact}}</td>
                        <td>{{customer.customer_email}}</td>
                        <td>
                            <a href="#" @click="showMaterial(customer.materials,customer.id)">
                                Materials
                            </a>
                        </td>
                        <td>
                            <a href="#" @click="editCustomer(customer)">
                                <i class="fa fa-edit blue"></i>
                            </a>
                        </td>

                    </tr>
                   </tbody>
                </table>
              </div>
              <div class="card-footer">
                  <pagination :data="Customer_data" @pagination-change-page="getResults"></pagination>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>



        <!--Customer Modal -->
        <div class="modal fade" data-vv-scope="form" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New Customer</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Customer's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateCustomer() : createCustomer()">
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.customer_name" type="text" name="customer_name"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('customer_name') }"
                                    v-validate="'required'">
                                    <span class="red">{{ errors.first('customer_name') }}</span>
                                <has-error :form="form" field="customer_name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Contact<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.customer_contact" type="text" name="customer_contact"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('customer_contact') }"
                                    v-validate="'required|numeric|min:10|max:10'">
                                <span class="red">{{ errors.first('customer_contact') }}</span>
                                <has-error :form="form" field="customer_contact"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Email<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.customer_email" type="email" name="customer_email"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('customer_email') }"
                                    v-validate="'required'">
                                <span class="red">{{ errors.first('customer_email') }}</span>
                                <has-error :form="form" field="customer_email"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Address<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.customer_address" type="text" name="customer_address"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('customer_address') }"
                                    v-validate="'required|max:190'">
                                <span class="red">{{ errors.first('customer_address') }}</span>
                                <has-error :form="form" field="customer_address"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Description<i class="fas fa-asterisk red"></i></label>
                                <textarea v-model="form.customer_description" type="text" name="customer_description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('customer_description') }"
                                    v-validate="'required|max:300'"></textarea>
                                <span class="red">{{ errors.first('customer_description') }}</span>
                                <has-error :form="form" field="customer_description"></has-error>
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

        <!--Material Modal -->
        <div class="modal fade" data-vv-scope="form1" id="addNewMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="addNewMaterialLabel">Add New Material</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewMaterialLabel">Update Material's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form @submit.prevent="editmode ? updateMaterial() : createMaterial()" >

                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form1.material_name" type="text" name="material_name"
                                    class="form-control" :class="{ 'is-invalid': form1.errors.has('material_name') }"
                                    v-validate="'required'">
                                    <span class="red">{{ errors.first('material_name') }}</span>
                                <has-error :form="form1" field="material_name"></has-error>
                            </div>
                            <div class="form-group">
                                <label>Quantity<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form1.material_quantity" type="text" name="material_quantity"
                                    class="form-control" :class="{ 'is-invalid': form1.errors.has('material_quantity') }"
                                    v-validate="'required|numeric|max:10'">
                                <span class="red">{{ errors.first('material_quantity') }}</span>
                                <has-error :form="form1" field="material_quantity"></has-error>
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
        <!-- Project info model -->
        <!-- Modal -->
        <div class="modal fade" id="showCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
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
                                    <th>Id</th>
                                    <td>{{customer_detail_data.id}}</td>
                                </tr>
                                <tr>
                                    <th>Name</th>
                                    <td>{{customer_detail_data.customer_name}}</td>
                                </tr>
                                <tr>
                                    <th>Contact</th>
                                    <td>{{customer_detail_data.customer_contact}}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{customer_detail_data.customer_email}}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{customer_detail_data.customer_address}}</td>

                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{customer_detail_data.customer_description}}</td>
                                </tr>

                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                </div>
            </div>
        </div>
        <!-- Material info model -->
        <div class="modal fade" id="showMaterialModal" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewLabel">User Info  </h5>
                        <div class="card-tools" align="right">
                            <button class="btn btn-success" @click="addNewMaterial">
                                Add New Material
                                <i class="fas fa-user-plus fa-fw"></i>
                            </button>
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                        <div class="modal-body">
                            <!--Profile Table-->
                            <table class="table table-bordered mt-3">
                                <table class="table table-bordered mt-3">
                                    <tbody>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Quantity</th>
                                            <th>Edit</th>

                                        </tr>
                                        <tr v-for="material in material_data" :key="material.id">
                                            <td>{{material.id}}</td>
                                            <td>{{material.material_name}}</td>
                                            <td>{{material.material_quantity}}</td>
                                            <td v-model="customer_id" hidden>{{material.customer_id}}</td>
                                            <a href="#" @click="editMaterial(material)">
                                                <i class="fa fa-edit blue"></i>
                                            </a>

                                        </tr>
                                    </tbody>
                                </table>
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
                customer_id: '',
                editmode: false,
                Customer_data : {},
                customer_detail_data : {},
                material_data : {},
                project_data : {},

                form: new Form({
                    id: '',
                    customer_name: '',
                    customer_contact: '',
                    customer_email: '',
                    customer_address: '',
                    customer_description: '',
                }),

                form1: new Form({
                    id: '',
                    material_name: '',
                    material_quantity: '',
                }),
            }
        },
        methods: {
            loadProject(){
                    //it will fetch data into data and then to the users object
                    axios.get("api/customers").then(({ data }) => (this.Customer_data = data));
            },
            createCustomer(){
                this.$validator.validateAll('form')
                    .then((result) => {
                        if(result){
                            this.$Progress.start();
                            this.form.post('api/customers')
                            .then(() =>{
                                Fire.$emit('AfterCreate');
                                $('#addNew').modal('hide');
                                toast.fire({
                                    type: 'success',
                                    title: 'Customer Created successfully'
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
            createMaterial(){
                console.log("123")
                this.$validator.validateAll('form1')
                    .then((result) => {
                        console.log(result)
                         if(result){
                            console.log(this.customer_id);
                            this.$Progress.start();
                                console.log("hi");
                            this.form1.post('api/customers/'+ this.customer_id +'/materials')
                            .then(() =>{
                                console.log("hello");
                                Fire.$emit('AfterCreate');
                                $('#addNewMaterialModal').modal('hide');
                                toast.fire({
                                    type: 'success',
                                    title: 'Material Created successfully'
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
            deleteProject(id){
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
                        this.form.delete('api/projects/'+id)
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
            updateImage(e){
                console.log('startae');
                 let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 2111775;
                if(file['size'] < 2111775){
                    reader.onloadend = (file) => {
                    this.form.cover_image = reader.result;
                    }
                    reader.readAsDataURL(file);

                }
                else{
                    sweetAlert.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file It will not be uploaded',
                    })
                    document.getElementById("cover_image").value = "";
                    return false;
                }

            },
            updateCustomer(){
                this.$Progress.start();
                this.form.put('api/customers/'+this.form.id)
                .then(() => {
                    //on success
                    $('#addNew').modal('hide');

                    sweetAlert.fire(
                        'Updated!',
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
            updateMaterial(){
                this.$Progress.start();
                console.log(this.customer_id);
                this.form1.put('api/customers/24/materials/'+this.form1.id)
                .then(() => {
                    //on success
                    $('#addNewMaterialModal').modal('hide');

                    sweetAlert.fire(
                        'Updated!',
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
            editCustomer(customer){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');
                this.form.fill(customer);
            },
            editMaterial(material){
                this.editmode = true;
                this.form1.reset();
                $('#addNewMaterialModal').modal('show');
                this.form1.fill(material);
                $('#showMaterialModal').modal('hide');
            },
            addNewMaterial(){
                this.editmode = false;
                this.form.reset();
                $('#addNewMaterialModal').modal('show');
                $('#showMaterialModal').modal('hide');

            },
            showModal(id){
                console.log(id);
                axios.get("api/customers/"+ id).then(({ data }) => (this.customer_detail_data = data.data));
                $('#showCustomerModal').modal('show');

            },
            showMaterial(id,customer_id){
                console.log(id);
                this.customer_id = customer_id;
                axios.get(id).then(({ data }) => (this.material_data = data.data));
                $('#showMaterialModal').modal('show');
            },
            getResults(page = 1){
                axios.get('api/customers?page='+page)
                    .then(response=>{
                        this.Customer_data = response.data;
                    });
            }

        },
        created() {
            Fire.$on('searching',() => {
                console.log('searching');
                let query = this.$parent.search;
                axios.get('api/findProject?q='+ query)
                    .then((data)=>{
                        this.project = data.data;
                    })
            });
            this.loadProject();
            Fire.$on('AfterCreate', () => {
                this.loadProject();
                });
            //setInterval(() => this.loadUsers(),3000);
        }
    }
</script>
<style>
    .modelImage{
        height:20vh;
        width: 30vh;
    }
</style>
