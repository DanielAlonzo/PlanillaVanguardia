<template>
    <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Deducciones</h3>

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
                      <th>Deduccion</th>
                      <th>Monto</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="deduccion in deducciones" :key="deduccion.id">

                      <td>{{deduccion.id}}</td>
                      <td>{{deduccion.deduccion}}</td>
                      <td>{{deduccion.monto}}</td>
                      <td>{{deduccion.tipo}}</td>
                      <td>
                          <a href="#"  data-toggle="tooltip" data-placement="top"  title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          -
                          <a href="#" @click="deleteDeduccion(deduccion.id)" data-toggle="tooltip" data-placement="top"  title="Eliminar">
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
                     <form @submit.prevent="crearDeducciones()">
                    <div class="modal-body">
                        
                            <div class="form-group">
                            <label>Deduccion</label>
                            <input v-model="form.deduccion" type="text" name="deduccion"
                            placeholder="Deduccion"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('deduccion') }">
                            <has-error :form="form" field="deduccion"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Monto</label>
                            <input v-model="form.monto" type="text" name="monto"
                            placeholder="Monto"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('monto') }">
                            <has-error :form="form" field="monto"></has-error>
                            </div>

                              <div class="form-group">
                            <label>Tipo</label>
                            <select name="tipo" v-model="form.tipo" id="tipo" class="form-control" :class="{
                                'is-invalid':form.errors.has('tipo')}">
                                    <option value="">Seleccione un tipo</option>
                                    <option value="activo">Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            <has-error :form="form" field="tipo"></has-error>
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
                deducciones:{},
                form: new Form({
                    id:'',
                     deduccion: '',
                     monto:'',
                     tipo:'',
                    
                })
            }
        },
        methods:{
          deleteDeduccion(id){
                   

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
                                this.form.delete('api/deducciones/'+id).then(()=>{
                            
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
            loadDeducciones(){
               axios.get("api/deducciones").then(({data}) => (this.deducciones = data.data));
            },
            crearDeducciones(){
              this.$Progress.start();
                this.form.post('api/deducciones/').then(()=>{
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
         this.loadDeducciones();
         Fire.$on('AfterCreate',()=>{
                this.loadDeducciones();
            });
        }
    }
</script>
