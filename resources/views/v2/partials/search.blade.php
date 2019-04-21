<div class="row">
    <div class="col-sm-12">
        <div id="div-search" style="" title="busqueda">
            <a href="#" class="modal_close"><i class="fa fa-remove pull-right" aria-hidden="true"></i></a>
            {{--<a href="#" id="exit-search" class="modal_close"><i class="fa fa-remove pull-right" aria-hidden="true"></i></a>--}}
            <label>Buscar grupo</label>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="input-group margin-bottom-sm">
                        <span class="input-group-addon" id="icon-state"><i class="fa fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Ingrese el nombre del grupo" id="inputSearch" name="inputSearch"required>

                    </div>
                    <div id="result-search">

                    </div>
                </div>
            </div>
            <hr>
            <button type="button" id="show-all-groups"class="btn btn-primary">Grupos registrados</button>
            {{--<button type="button" id="show-all-groups"class="btn btn-primary">Actividades registradas</button></span>--}}
            <hr>
            <label>Buscar por categoría</label>
            <div class="checkbox">
                <label>
                    <input type="checkbox" class="pull-right" id="check-all-cat"> Marcar/Desmarcar todas
                </label>
            </div>
            </br>
            <div id="groups-categories">

            </div>
            <button type="button" id="search-category" class="btn btn-primary">Buscar por categoría</button><span class="error" id="error-search-category"></span>
        </div>
    </div>
</div>