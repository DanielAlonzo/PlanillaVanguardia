<template>
    <div class="container">
          <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Pagos</h3>

                <div class="card-tools">
                    <!-- Button trigger modal -->
                <button class="btn btn-success" data-toggle="modal" data-target="#Nuevo">
                Nuevo <i class="fas fa-plus"></i></button>
                </div>


              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                  <thead>
                   
                         <tr>
                      <th>Planilla</th>
                      <th>Empleado</th>
                      <th>Total Deducciones</th>
                      <th>Monto</th>
        
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr v-for="hor in horarios" :key="hor.id_horario">

                      <td>{{hor.id_horario}}</td>
                      <td>{{hor.nombre}}</td>
                      <td>{{hor.hora_entrada}}</td>
                      <td>{{hor.hora_salida}}</td>
                      
                      <td>
                          <a href="#"  data-toggle="tooltip" data-placement="top"  title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          -
                          <a href="#" @click="deleteEmpleado(hor.id_horario)" data-toggle="tooltip" data-placement="top"  title="Eliminar">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
                    </tr> -->
                   
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
                     <form @submit.prevent="crearPago()">
                    <div class="modal-body">
                        
                            <div class="form-group">
                            <label>Nombre</label>
                            <input v-model="form.nombre" type="text" name="nombre"
                            placeholder="Nombre"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                            <has-error :form="form" field="nombre"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Hora de entrada</label>
                                
                            <input v-model="form.hora_entrada" type="time" placeholder="Hora de entrada" name="hora_entrada" class="form-control" :class="{ 'is-invalid': form.errors.has('hora_entrada') }">
                            <has-error :form="form" field="hora_entrada"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Hora de salida</label>
                               
                            <input v-model="form.hora_salida" type="time" placeholder="Hora de salida" name="hora_salida" class="form-control" :class="{ 'is-invalid': form.errors.has('hora_salida') }">
                            <has-error :form="form" field="hora_salida"></has-error>
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
                horarios:{},
                form: new Form({
                    id_horario:'',
                     nombre: '',
                     hora_entrada:'',
                      hora_salida:'',
                    
                })
            }
        },
        methods:{
        //   deleteEmpleado(id_horario){
                   

        //             swal.fire({
        //             title: 'Estás seguro?',
        //             text: "No podrás revertir esto!",
        //             icon: 'warning',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#d33',
        //             confirmButtonText: 'Si, Eliminar!'
        //             }).then((result) => {
        //                 if(result.value){
        //                         this.form.delete('api/horarios/'+id_horario).then(()=>{
                            
        //                         swal.fire(
        //                         'Eliminado!',
        //                         'El registro ha sido eliminado.',
        //                         'success'
        //                         )
        //                         Fire.$emit('AfterCreate');
                            
        //                         }).catch(()=>{
        //                             swal.fire(
        //                         'Error!',
        //                         'El registro no ha sido eliminado.',
        //                         'warning'
        //                         )
        //                         });
        //                 }
                    
        //             })
        //     },
            loadHorarios(){
               axios.get("api/horarios").then(({data}) => (this.horarios = data.data));
            },
            crearPago(){
              this.$Progress.start();
                this.form.post('api/horarios/').then(()=>{
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
         this.loadHorarios();
         Fire.$on('AfterCreate',()=>{
                this.loadHorarios();
            });
        }
    }
</script>
