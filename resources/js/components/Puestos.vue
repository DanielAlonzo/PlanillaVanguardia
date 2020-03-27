<template>
    <div class="container">
        <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Puestos</h3>

                <div class="card-tools">
                   <!-- Button trigger modal -->
                <button class="btn btn-success" data-toggle="modal" data-target="#Nuevo">
                Nuevo <i class="fas fa-plus"></i></button>
                </div>


              </div>
               <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                   
                         <tr>
                      <th>Id</th>
                      <th>Puesto</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="puesto in puestos" :key="puesto.id">

                      <td>{{puesto.id}}</td>
                      <td>{{puesto.puesto}}</td>
                      <td>{{puesto.estado}}</td>
                      <td>
                          <a href="#"  data-toggle="tooltip" data-placement="top"  title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          -
                          <a href="#" @click="deletePuesto(puesto.id)" data-toggle="tooltip" data-placement="top"  title="Eliminar">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
                    </tr>
                    <!-- <tr v-for="user in users" :key="user.id">
                      
                    </tr> -->
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-header -->
              <!-- <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                   
                         <tr>
                      <th>Id</th>
                      <th>Departamento</th>
                      <th>Estado</th>
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
              </div> -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

                 <!-- Modal -->
                <div class="modal fade" id="Nuevo" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Nuevo">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     <form @submit.prevent="crearPuestos()">
                    <div class="modal-body">
                        
                            <div class="form-group">
                            <label>Puesto</label>
                            <input v-model="form.puesto" type="text" name="puesto"
                            placeholder="Puesto"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('puesto') }">
                            <has-error :form="form" field="puesto"></has-error>
                            </div>

                             <div class="form-group">
                            <label>Estado</label>
                            <select name="estado" v-model="form.estado" id="estado" class="form-control" :class="{
                                'is-invalid':form.errors.has('estado')}">
                                    <option value="">Seleccione un estado</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            <has-error :form="form" field="puesto"></has-error>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar
                            <i class="fas fa-edit"></i></button>
                        <button type="submit" class="btn btn-success">Guardar
                            <i class="fas fa-download"></i></button>
                    </div>
                    </form> 
                    </div>
                </div>
                </div>
                <!-- /.Modal --> 

    </div>
</template>

<script>
    export default {
         data(){
            return{
                puestos:{},
                form: new Form({
                    id:'',
                     puesto: '',
                     estado:'',
                    
                })
            }
        },
        methods:{
          deletePuesto(id){
                   

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
                                this.form.delete('api/puestos/'+id).then(()=>{
                            
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
            loadPuestos(){
               axios.get("api/puestos").then(({data}) => (this.puestos = data.data));
            },
            crearPuestos(){
              this.$Progress.start();
                this.form.post('api/puestos/').then(()=>{
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
         this.loadPuestos();
         Fire.$on('AfterCreate',()=>{
                this.loadPuestos();
            });
        }
    }
</script>
