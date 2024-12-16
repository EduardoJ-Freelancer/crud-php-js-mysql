<?php include 'templates/header.php' ?>

<body>
   
    <!-- Page content-->
    <div class="container-fluid main" id="app">
        <h2 class="font-weight-bold mt-5 text-center col-12">
            CRUD(Create, Update, Read, Delete)
        </h2> 
        <div class="row mb-4 pb-2 mx-1 border-bottom">            
            <p class="p-0 col-2 col-lg-1">
                <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">
                    Descripción
                </button>
            </p>
            <div style="min-height: 20px;" class="mb-2">
                <div class="collapse" id="collapseWidthExample">
                    <div class="card card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <p class="lead">Listado, detalles, busqueda, eliminación, creación y edición de registros.</p>
                            </li>
                            <li class="list-group-item">
                                <h6 class="lead">Listado:</h6>
                                <ul>
                                    <li>Paginación simple(previo, siguiente) y completa.</li>
                                    <li>Selección del número de registros a ver, 20 por default.</li>
                                    <li>Ordenado por Asc/Desc.</li>
                                    <li>Ocultar/mostrar campo.</li>
                                    <li>Función de refrescar para regresar al inicio del listado después de una búsqueda.</li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <p class="lead">Búsqueda por campo simple o múltiple, paginación incluida.</p>
                            </li>                            
                            <li class="list-group-item">
                                <p class="lead">Creación, edición y eliminación de registros.</p>
                                <ul>
                                    <li>Validación de datos en cada campo.</li>
                                    <li>Seguridad web(XSS, CSRF, inyección SQL).</li>
                                </ul>
                            </li>
                            <li class="list-group-item">
                                <p class="lead">Diseño front-end con elementos Bootstrap: collapse, cards, tablas, tooltips, modales, iconos, simple sidebar, paginación, grid, SASS.</p>
                            </li>                           
                            <li class="list-group-item">
                                <p class="lead">Diseño y creación backend con herramientas de Codeigniter como:</p>
                                <ul>
                                    <li>Presenter (funcionalidad diseñada para interacción del programador para usarse con el navegador web)  consumo con HTTP o AJAX.</li>
                                    <li>Resource (diseñado como rutas API (endpoints) para ser conmsumido por un API client como cURL, Guzzle, fetch, etc), con o sin JWT.</li>
                                    <li>Migraciones y seeders (con fake) para Base de datos.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>            
            
            <a href="" class="btn btn-primary col offset-lg-11 col-lg-1 justify-content-end" id="btn-add-task" data-bs-toggle="modal" data-bs-target="#saveModal">
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>        
        <div class="card shadow mb-4">
                            
            <div class="card-header py-3">                
                <div class="row controls">        
                    <div class="col-4 col-lg-1 limit d-none d-lg-block">       
                        <select class="form-select" aria-label="Tasks" id="limit-task" data-bs-toggle="tooltip" data-bs-placement="bottom" title="" data-bs-title="Selecciona cantidad de registros a mostrar">            
                            <option value="20">20</option>            
                            <option value="50">50</option>            
                            <option value="100">100</option>          
                        </select>       
                    </div>
                    <div class="col-8 col-lg-2 offset-lg-3">                        
                    </div>    
                    <div class="col-2 col-lg-1 offset-lg-2 buttons  d-none d-lg-block">              
                        <button type="button" class="btn btn-primary btn-md btn-refresh" id="btn-refresh" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-title="Refrescar">        
                            <i class="bi bi-arrow-clockwise"></i>       
                        </button>        
                    </div>        
                    <div class="col-10 col-lg-3 search">         
                        <div class="input-group mb-1" data-bs-toggle="tooltip" data-bs-placement="top" title="" id="search" data-bs-title="Buscará por nombre y descripción">
                            <input type="text" id="keywords" name="keywords" class="form-control" placeholder="Buscar..." value="" autocomplete="off">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="bi bi-search" id="btn-search"></i>
                                </div>        
                            </div>          
                        </div>      
                    </div>       
                </div><!-- /.controls -->            
            </div><!-- /.card-header -->

            <div class="card-body">         
                <div class="table-responsive">              
                    <table class="table table-bordered table-hover table-striped" id="table-tasks">                              
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">id</th>
                                <th scope="col">Tarea</th>
                                <th scope="col">Fecha creación</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>                                
                        <tbody id="table-body-tasks">
                            
                        </tbody>
                        <tfoot>                 
                            <tr></tr>                                     
                        </tfoot>
                    </table>            
                </div> <!-- /.table-responsive -->         
            </div><!-- /.card-body -->        
                    
            <div class="card-footer">           
                <div class="row">
                    <div class="col description-pagination d-none d-lg-block">
                        <p id="total-actions">
                            Mostrando <b>0</b> a <b>20</b> de un total de <b>100</b> registros
                        </p>
                    </div>
                    <div id="actions-pagination" class="col items-pagination">
                    
                    </div>                           
                </div>   
            </div><!-- /.card-footer -->

        </div><!-- /.card -->

    </div><!-- /.container-fluid -->


    <!-- Modal add -->    
    <div class="modal fade" id="saveModal" tabindex="-1" aria-labelledby="saveModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="saveModalLabel">Tarea</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-task" class="form" autocomplete="off">              
                        <input type="hidden" name="id" value="" id="id">                            
                        <div class="form-group" id="warn_task_name">                
                            <label for="task_name">Nombre de tarea</label>                
                            <input type="text" name="task_name" class="form-control" id="task_name">                
                            <p class="help-block text-danger"></p>              
                        </div>                             
                    </form> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-task">Guardar</button>
                </div>
            </div>
        </div>
    </div>
  
  <?php include 'templates/scripts.php' ?>
  <script src="js/main.js"></script>

</body>
</html>