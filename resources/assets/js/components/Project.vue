<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Projects Table</h3>

                <div class="card-tools">
                  <button class="btn btn-success" @click="newModal">
                      Add New Project
                      <i class="fas fa-user-plus fa-fw"></i>
                    </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <tbody><tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Deal Type</th>
                    <th>location</th>
                    <th>price</th>
                    <th>Created At</th>
                    <th>Modify</th>
                  </tr>
                  <tr v-for="project in project.data" :key="project.id">
                    <td>{{project.id}}</td>
                    <td><a href="#"  @click="showModal(project.id)">{{project.title}}</a></td>
                    <td>{{project.deal_type}}</td>
                    <td>{{project.location}}</td>
                    <td>Rs. {{project.price}}</td>
                    <td>{{project.created_at | myDateTime}}</td>

                    <td>

                        <a href="#" @click="editModal(project)">
                            <i class="fa fa-edit blue"></i>
                        </a>
                        /
                        <a href="#" @click="deleteProject(project.id)">
                            <i class="fa fa-trash red"></i>
                        </a>
                    </td>
                  </tr>

                </tbody></table>
              </div>
              <div class="card-footer">
                  <pagination :data="project" @pagination-change-page="getResults"></pagination>
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
                        <h5 class="modal-title" v-show="!editmode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editmode" id="addNewLabel">Update Project's Info</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editmode ? updateProject() : createProject()">
                        <div class="modal-body">
                            <div class="form-group">
                                <div  align="center">
                                <img class="img-thumbnail modelImage" :src="getProfilePhoto()" alt="Cover Image">
                                </div>
                                <br/>
                                <label>Title<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.title" type="text" name="title"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('title') }"
                                    v-validate="'required'">
                                    <span class="red">{{ errors.first('title') }}</span>
                                <has-error :form="form" field="title"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Deal Type<i class="fas fa-asterisk red"></i></label>
                                <select v-model="form.deal_type" id="deal_type" name="deal_type"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('deal_type') }"
                                    v-validate="'required|included:Land,House,Bungalow,Flat'">

                                    <option value="Land">Land</option>
                                    <option value="House">House</option>
                                    <option value="Bungalow">Bungalow</option>
                                    <option value="Flat">Flat</option>
                                </select>
                                <span class="red">{{ errors.first('deal_type') }}</span>
                                <has-error :form="form" field="deal_type"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Price<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.price" type="text" name="price"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('price') }"
                                    v-validate="'required|numeric|min:4'">
                                <span class="red">{{ errors.first('price') }}</span>
                                <has-error :form="form" field="price"></has-error>
                            </div>

                            <div class="form-group">
                                <label>Location<i class="fas fa-asterisk red"></i></label>
                                <input v-model="form.location" type="text" name="location"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('location') }"
                                    v-validate="'required|alpha'">
                                <span class="red">{{ errors.first('location') }}</span>
                                <has-error :form="form" field="location"></has-error>
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
                                <label for="cover_image"  class="col-sm-2 control-label">Cover Image<i class="fas fa-asterisk red"></i></label>
                                <div class="col-sm-12">
                                    <input type="file" @change="updateImage" v-validate="'required'" name="cover_image" id="cover_image" class="form-input">
                                </div>
                                <span class="red">{{ errors.first('cover_image') }}</span>
                            </div>

                            <div class="form-group">
                                <label>Description<i class="fas fa-asterisk red"></i></label>
                                <textarea v-model="form.description" type="text" name="description"
                                    class="form-control" :class="{ 'is-invalid': form.errors.has('description') }"
                                    v-validate="'required|max:300'"></textarea>
                                <span class="red">{{ errors.first('description') }}</span>
                                <has-error :form="form" field="description"></has-error>
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
        <div class="modal fade" id="showProject" tabindex="-1" role="dialog" aria-labelledby="addNewLabel" aria-hidden="true">
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
                                            <img class="img-circle img-fluid img-responsive modelImage" :src="getshowPhoto()" alt="User Avatar">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Id</th>
                                    <td>{{project_data.id}}</td>
                                </tr>
                                <tr>
                                    <th>Title</th>
                                    <td>{{project_data.title}}</td>
                                </tr>
                                <tr>
                                    <th>Deal Type</th>
                                    <td>{{project_data.deal_type}}</td>
                                </tr>
                                <tr>
                                    <th>price</th>
                                    <td>{{project_data.price}}</td>
                                </tr>
                                <tr>
                                    <th>Location</th>
                                    <td>{{project_data.location}}</td>
                                </tr>

                                <tr>
                                    <th>Address</th>
                                    <td>{{project_data.address}}</td>

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
                project_data : {},
                project : {},
                form: new Form({
                    id: '',
                    title: '',
                    deal_type: '',
                    price: '',
                    location: '',
                    address: '',
                    description: '',
                    user_id: '',
                    cover_image: ''
                })
            }
        },
        methods: {
            getProfilePhoto(){
                let cover_image = (this.form.cover_image.length > 200) ? this.form.cover_image : "./storage/cover/"+ this.form.cover_image ;
                let image1 = this.form.cover_image;
                return cover_image;

            },
            getshowPhoto(){
                let cover_image ="./storage/cover/"+ this.project_data.cover_image ;
                return cover_image;
            },

            loadProject(){


                    //it will fetch data into data and then to the users object
                    axios.get("api/projects").then(({ data }) => (this.project = data));
            },
            createProject(){
                this.$validator.validateAll()
                    .then((result) => {
                        if(result){
                            this.$Progress.start();

                            this.form.post('api/projects')
                            .then(() =>{
                                Fire.$emit('AfterCreate');
                                $('#addNew').modal('hide');
                                toast.fire({
                                    type: 'success',
                                    title: 'Project Created successfully'
                                });
                                this.$Progress.finish();
                                document.getElementById("cover_image").value = "";
                            })
                            .catch(() => {
                                console.log("error");
                                document.getElementById("cover_image").value = "";
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
            updateProject(){
                this.$Progress.start();
                this.form.put('api/projects/'+this.form.id)
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
            newModal(){
                this.editmode = false;
                this.form.reset();
                $('#addNew').modal('show');
            },
            editModal(project){
                this.editmode = true;
                this.form.reset();
                $('#addNew').modal('show');

                this.form.fill(project);



            },
            showModal(id){
                 console.log(id);
                axios.get("api/projects/"+id).then(({ data }) => (this.project_data = data));
                $('#showProject').modal('show');
            },
            getResults(page = 1){
                axios.get('api/projects?page='+page)
                    .then(response=>{
                        this.project = response.data;
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
                this.getProfilePhoto();
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
