<template>
    <div class="container">
     
     <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>

                <div class="card-tools">
                 <button class="btn btn-success" @click="newModal">Nuevo <i class="fas fa-user-plus"></i></button>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                   
                         <tr>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Email</th>
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="user in users" :key="user.id">
                      <td>{{user.id}}</td>
                      <td>{{user.name}}</td>
                      <td>{{user.email}}</td>
                      <td>
                          <a href="#" @click="editModal(user)" data-toggle="tooltip" data-placement="top"  title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          -
                          <a href="#" @click="deleteUser(user.id)" data-toggle="tooltip" data-placement="top"  title="Eliminar">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
                        <!-- modal -->
                        <div class="modal fade" id="Nuevo" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editmode" id="NuevoLabel" >Nuevo Usuario</h5>
                        <h5 class="modal-title" v-show="editmode" id="NuevoLabel" >Editar Usuario</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <form @submit.prevent="editmode ? updateUser() : createUser()">
                    <div class="modal-body">

                        <div class="form-group">
                            <label>Nombre</label>
                            <input v-model="form.name" type="text" name="name"
                            placeholder="Nombre"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                            <has-error :form="form" field="name"></has-error>
                        </div>

                        
                        <div class="form-group">
                            <label>Email</label>
                            <input v-model="form.email" type="text" name="email"
                            placeholder="Email"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                            <has-error :form="form" field="email"></has-error>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input v-model="form.password" type="password" name="password" id="password"
                          
                                class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                            <has-error :form="form" field="password"></has-error>
                        </div>

                    </div>

                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" >Cerrar <i class="fas fa-times">
                        </i></button>
                       
                        <button v-show="editmode" type="submit" class="btn btn-success">Actualizar <i class="fas fa-edit"></i></button>
                        <button v-show="!editmode" type="submit" class="btn btn-success">Guardar <i class="fas fa-download"></i></button>
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

                users:{},
                form: new Form({
                    id:'',
                     name: '',
                     email:'',
                     password: '',
                })
            }
        },
        methods:{
            updateUser(){
                this.$Progress.start();
                this.form.put('api/user/'+this.form.id )
                .then(() => {
                    $('#Nuevo').modal('hide');
                     swal.fire(
                                'Actualizado!',
                                'El registro ha sido Actualizado.',
                                'success'
                                )
                                this.$Progress.finish();
                                Fire.$emit('AfterCreate');

                })
                .catch(()=>{
                    this.$Progress.fail();

                });

            },
            editModal(user){
                this.editmode=true;
                    this.form.reset();
                     $('#Nuevo').modal('show');
                     this.form.fill(user);
                     
            },
             newModal(){
                 this.editmode=false;
                    this.form.reset();
                     $('#Nuevo').modal('show');
                     
            },
            deleteUser(id){
                   

                    swal.fire({
                    title: 'Estás seguro?',
                    text: "No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Eliminar!'
                    }).then((result) => {
                        if(result.value){
                                this.form.delete('api/user/'+id).then(()=>{
                            
                                swal.fire(
                                'Eliminado!',
                                'El registro ha sido eliminado.',
                                'success'
                                )
                                Fire.$emit('AfterCreate');
                            
                                }).catch(()=>{
                                    swal.fire(
                                'Error!',
                                'El registro no ha sido eliminado.',
                                'warning'
                                )
                                });
                        }
                    
                    })
            },
            loadUsers(){
               axios.get("api/user").then(({data}) => (this.users =data.data));
            },
            createUser(){
                this.$Progress.start();
                this.form.post('api/user').then(()=>{
                    Fire.$emit('AfterCreate');
                    $('#Nuevo').modal('hide')
                     swal.fire(
                    'Agregado!',
                    'El registro ha sido guardado.',
                    'success'
                    )
                 this.$Progress.finish();
            })

            .catch(()=>{

            })

                }
                
                
               
                

        },
        created() {
            this.loadUsers();
            
            Fire.$on('AfterCreate',()=>{
                this.loadUsers();
            });
            //setInterval(() => this.loadUsers(), 3000);


        }
    }
</script>
