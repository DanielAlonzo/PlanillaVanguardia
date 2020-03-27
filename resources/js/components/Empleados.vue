<template>
    <div class="container">
          <div class="row mt-5">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Empleados</h3>

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
                      <th>Id Empleado</th>
                      <th>Identidad</th>
                      <th>Nombre</th>
                      <th>Fecha Ingreso</th>
                      <th>Fecha Salida</th>
                      <th>Salario Base</th>
                       <th>Departamento</th>
                      <th>Puesto</th>
                      <th>Horario</th>
                      <th>Opciones</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="emp in empleados" :key="emp.id">

                      <td>{{emp.id}}</td>
                      <td>{{emp.identidad}}</td>
                      <td>{{emp.nombre}}</td>
                      <td>{{emp.fecha_ingreso}}</td>
                      <td>{{emp.fecha_salida}}</td>
                       <td>{{emp.salario_base}}</td>
                      <td>{{emp.id_departamento}}</td>
                      <td>{{emp.id_puesto}}</td>
                      <td>{{emp.id_horario}}</td>
                   
                      
                      <td>
                          <a href="#"  data-toggle="tooltip" data-placement="top"  title="Editar">
                              <i class="fa fa-edit"></i>
                          </a>
                          -
                          <a href="#" @click="deleteEmpleado(emp.id)" data-toggle="tooltip" data-placement="top"  title="Eliminar">
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
                        <h5 class="modal-title" id="Nuevo">Nuevo Empleado</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                     <form @submit.prevent="crearEmpleados()">
                    <div class="modal-body">
                            <div class="form-group">
                            <label>Identidad</label>
                            <input v-model="form.identidad" type="text" name="identidad"
                            placeholder="Identidad"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('identidad') }">
                            <has-error :form="form" field="identidad"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Nombre</label>
                            <input v-model="form.nombre" type="text" name="nombre"
                            placeholder="Nombre"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('nombre') }">
                            <has-error :form="form" field="nombre"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Fecha de ingreso</label>
                                <!-- <datepicker v-model="date" name="fecha"></datepicker> -->
                            <input v-model="form.fecha_ingreso" type="datetime-local" placeholder="Fecha de ingreso" name="fecha_ingreso" class="form-control" :class="{ 'is-invalid': form.errors.has('fecha_ingreso') }">
                            <has-error :form="form" field="fecha_ingreso"></has-error>
                            </div>
                            <div class="form-group">
                            <label>Fecha de salida</label>
                                <!-- <datepicker v-model="date" name="fecha"></datepicker> -->
                            <input v-model="form.fecha_salida" type="datetime-local" placeholder="Fecha de salida" name="fecha_salida" class="form-control" :class="{ 'is-invalid': form.errors.has('fecha_salida') }">
                            <has-error :form="form" field="fecha_salida"></has-error>
                            </div>

                            <div class="form-group">
                            <label>Salario Base</label>
                            <input v-model="form.salario_base" type="text" name="salario_base"
                            placeholder="Salario Base"
                                class="form-control" :class="{ 'is-invalid': form.errors.has('salario_base') }">
                            <has-error :form="form" field="salario_base"></has-error>
                            </div>

                             <div class="form-group">
                            <label>Departamento</label>
                            <select name="departamento" v-model="form.departamento" id="departamento" class="form-control" :class="{
                                'is-invalid':form.errors.has('departamento')}">
                                    <option value="">Seleccione un departamento</option>
                                    <option v-for="dep in departamentos" :key="dep.id_departamento" :value="departamentos">{{dep.departamento}}</option>
                                   
                                </select>
                            <has-error :form="form" field="departamento"></has-error>
                            </div>
                             <div class="form-group">
                            <label>Puesto</label>
                            <select name="puesto" v-model="form.puesto" id="puesto" class="form-control" :class="{
                                'is-invalid':form.errors.has('puesto')}">
                                    <option value="">Seleccione un puesto</option>
                                    <option value="gerente">Gerente</option>
                                    <option value="entrenador">Entrenador</option>
                                </select>
                            <has-error :form="form" field="puesto"></has-error>
                            </div>
                             <div class="form-group">
                            <label>Horario</label>
                            <select name="horario" v-model="form.horario" id="horario" class="form-control" :class="{
                                'is-invalid':form.errors.has('horario')}">
                                    <option value="">Seleccione un horario</option>
                                    <option value="activo">A</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            <has-error :form="form" field="horario"></has-error>
                            </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar
                            <i class="fas fa-times"></i></button>
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
                empleados:{},
                form: new Form({
                    id:'',
                    identidad:'',
                     nombre: '',
                     fecha_ingreso:'',
                      fecha_salida:'',
                      salario_base:'',
                     id_departamento: '',
                     id_puesto:'',
                      id_horario:'',
                    
                }),
                departamentos:{},
                formd: new Form({
                    id_departamento:'',
                     departamento: '',
                     estado:'',
                    
                }),
                puestos:{},
                formp: new Form({
                    id_puesto:'',
                     puesto: '',
                     estado:'',
                    
                }),
                horarios:{},
                formh: new Form({
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
            loadEmpleados(){
               axios.get("api/empleados").then(({data}) => (this.empleados = data.data));
            },loadDepartamentos(){
               axios.get("api/departamentos").then(({data}) => (departamentos.departamentos = data.data));
            },
            loadPuestos(){
               axios.get("api/puestos").then(({data}) => (puestos.puestos = data.data));
            },
            loadHorarios(){
               axios.get("api/horarios").then(({data}) => (horarios.horarios = data.data));
            },
            crearEmpleados(){
              this.$Progress.start();
                this.form.post('api/empleados/').then(()=>{
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
         this.loadEmpleados();
         Fire.$on('AfterCreate',()=>{
                this.loadEmpleados();
            });
        }
    }
</script>
