<template>
    <div class="container">
       <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Planilla</h3>

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
                      <th>Nombre</th>
                      <th>Fecha</th>
                      <th>Tipo</th>
                      <th>Periodo</th>
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                     
                    <tr v-for="plan in planilla" :key="plan.id">

                      <td>{{plan.id}}</td>
                      <td>{{plan.nombre}}</td>
                      <td>{{plan.fecha | myDate}}</td>
                      <td>{{plan.tipo}}</td>
                      <td>{{plan.periodo}}</td>
                      <td>
                          <a href="#"  data-toggle="tooltip" data-placement="top"  title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          -
                          <a href="#" @click="deletePlanilla(plan.id)" data-toggle="tooltip" data-placement="top"  title="Eliminar">
                              <i class="fa fa-trash red"></i>
                          </a>
                      </td>
                    </tr>
                   
                  </tbody>
                </table>
              </div>
             
            </div>
            <!-- /.card -->
          </div>
        </div>


         <!-- Modal -->
                <div class="modal fade" id="Nuevo" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Nuevo">Nueva Planilla</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     <form @submit.prevent="crearPlanilla()"  >
                    <div class="modal-body">
                        
                            <div class="form-group">
                            <label>Nombre</label>
                            <input v-model="form.nombre" type="text" name="nombre"
                            placeholder="Nombre"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                            <has-error :form="form" field="planilla"></has-error>
                            </div>
                            
                            <div class="form-group">
                            <label>Fecha</label>
                                <!-- <datepicker v-model="date" name="fecha"></datepicker> -->
                            <input v-model="form.fecha" type="datetime-local" placeholder="Seleccione fecha" name="fecha" class="form-control" :class="{ 'is-invalid': form.errors.has('fecha') }">
                            <has-error :form="form" field="fecha"></has-error>
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
                            
                            <div class="form-group">
                            <label>Periodo</label>
                            <input v-model="form.periodo" type="text" name="periodo"
                            placeholder="Periodo"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('periodo') }">
                            <has-error :form="form" field="periodo"></has-error>
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
                planilla:{},
                form: new Form({
                    id:'',
                     nombre: '',
                     fecha:'',
                     tipo: '',
                     periodo:'',
                    
                })
              
                

            }
        },
        methods:{
            deletePlanilla(id){
                   

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
                                this.form.delete('api/planilla/'+id).then(()=>{
                            
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
            loadPlanilla(){
               axios.get("api/planilla").then(({data}) => (this.planilla = data.data));
            },
            crearPlanilla(){
                this.$Progress.start();
                this.form.post('api/planilla/').then(()=>{
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
         this.loadPlanilla();
         Fire.$on('AfterCreate',()=>{
                this.loadPlanilla();
            });
        }
    }
</script>
