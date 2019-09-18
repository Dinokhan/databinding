
<script type="text/javascript" src="<?php echo base_url() ?>asset/js/datepicker/daterangepicker.js"></script>
<script>
    model.kapasitasModel = {
        IdKapasitas: 0,
        IdStadion: 0,
        KapasitasTempat: 0,
        IdKelas: 0,
    }
    model.stadionModel = {
        IdStadion: 0,
        NamaStadion: "",
    }

    var Kapasitas = {
        RecordKapasitas: ko.mapping.fromJS(model.kapasitasModel),
        RecordStadion: ko.mapping.fromJS(model.stadionModel),
        Mode: ko.observable(''),
        ModeKapasitas: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['KapasitasTempat']),
        FilterValue: ko.observable('KapasitasTempat'),
        DataFilterStadion: ko.observableArray(['NamaStadion']),
        FilterValueStadion: ko.observable('NamaStadion'),
        FilterTextStadion: ko.observable(''),
    }
    Kapasitas.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Kapasitascontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], Kapasitas.RecordKapasitas);
                Kapasitas.Mode("Update");
            },
        });
    }
    Kapasitas.selectdataStadion = function(id){
        $.ajax({
            url: "<?php echo site_url('Stadioncontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], Kapasitas.RecordStadion);
                Kapasitas.RecordKapasitas.IdStadion(res[0].IdStadion);
                Kapasitas.ModeKapasitas("Kapasitas");
            },
        });
    }

    ko.bindingHandlers.numeric = {
        init: function (element, valueAccessor) {
            $(element).on("keydown", function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                   return false;
                }
            });
            $(element).on("keyup", function (e) {
                
            });
        }
    };
</script>

<div class="page-title">
    <div class="title_left">
        <h3>Master Page</h3>
    </div>

    <div class="title_right">
        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
            <div class="input-group">
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel" style="height:600px;">
            <div class="x_title">
                <h2>Kapasitas</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" data-bind="with:Kapasitas">
                <!-- Content -->
                <div class="row" data-bind="visible:Mode() === ''">
                    <div class="col-md-12 padding-filter">
                        <div class="col-md-5">
                            <button class="btn btn-sm btn-primary" data-bind="click:add"><span class="glyphicon glyphicon-plus"></span> Add Kapasitas</button>
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-2 filter-label">Filter</label>
                            <div class="col-md-8" style="display:inline-block">
                                <select name="ddfilter" style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: FilterValue, foreach:DataFilter "/>
                                    <option data-bind="html:$data,attr:{'value':$data}"></option>
                                </select>
                                <input name="txtfilter" class="form-input form-control filter-textinline" data-bind="value:FilterText" placeholder="filter"/>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-primary" data-bind="click:filterKapasitas"><span class="glyphicon glyphicon-search"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="grIdKapasitas" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                            <thead>
                                <tr>
                                    <th>Stadion</th>
                                    <th>Kelas</th>
                                    <th>Kapasitas</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Stadion</th>
                                    <th>Kelas</th>
                                    <th>Kapasitas</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row" data-bind="visible:(Mode() === 'Update' || Mode() === 'Save')">
                    <div class="col-md-12 padding-filter">
                        <button class="btn btn-sm btn-primary" data-bind="click:backForm"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
                        <button class="btn btn-sm btn-success" data-bind="click:save, visible: ModeKapasitas() != ''"><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="text:Mode"></span></button>
                        <button class="btn btn-sm btn-danger" data-bind="click:remove, visible: ModeKapasitas() != ''"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                    </div>
                    <div class="col-md-12" data-bind="with:RecordKapasitas">
                        <div class="col-md-12" data-bind="visible:Kapasitas.ModeKapasitas() == ''">
                            <label class="col-md-2 filter-label">Filter</label>
                            <div class="col-md-8" style="display:inline-block">
                                <select name="ddfilter" style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: Kapasitas.FilterValueStadion, foreach:Kapasitas.DataFilterStadion "/>
                                    <option data-bind="html:$data,attr:{'value':$data}"></option>
                                </select>
                                <input name="txtfilter" class="form-input form-control filter-textinline" data-bind="value:Kapasitas.FilterTextStadion" placeholder="filter"/>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-primary" data-bind="click:Kapasitas.filterStadion"><span class="glyphicon glyphicon-search"></span> Filter</button>
                            </div>
                            <div class="col-md-12">
                                <table id="grIdStadion" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                                    <thead>
                                        <tr>
                                            <th>Nama Stadion</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Nama Stadion</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 form-simi" data-bind="visible:Kapasitas.ModeKapasitas() != ''">
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Stadion</label>
                                <div class="col-md-8">
                                    <input name="txtKapasitasname" class="form-input form-control" type="text" data-bind="value:Kapasitas.RecordStadion.NamaStadion" disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Kelas</label>
                                <div class="col-md-8">
                                    <select class="form-control" data-bind="value: IdKelas">
                                    <?php foreach ($kelas as $data) { ?>
                                    <option value="<?php echo $data->IdKelas; ?>"><?php echo $data->Kelas; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Kapasitas</label>
                                <div class="col-md-8">
                                    <input name="txtKapasitasname" class="form-input form-control" type="number" data-bind="value: KapasitasTempat" />
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</div>

<script>
    Kapasitas.backForm = function(){
        if (Kapasitas.ModeKapasitas() == ""){  
            Kapasitas.Mode('');
            ko.mapping.fromJS(model.kapasitasModel,Kapasitas.RecordKapasitas);
            ko.mapping.fromJS(model.stadionModel,Kapasitas.RecordStadion);
            Kapasitas.ModeKapasitas('');
        } else {
            Kapasitas.ModeKapasitas('');
        }
    }
    Kapasitas.add = function(){
        ko.mapping.fromJS(model.kapasitasModel,Kapasitas.RecordKapasitas);
        ko.mapping.fromJS(model.stadionModel,Kapasitas.RecordStadion);
        Kapasitas.Mode('Save');
        Kapasitas.ModeKapasitas("");
    }
    Kapasitas.save = function(){
        var url = "<?php echo site_url('Kapasitascontroller/save') ?>";
        if(Kapasitas.Mode() === 'Update')
            url = "<?php echo site_url('Kapasitascontroller/update') ?>";

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: Kapasitas.RecordKapasitas,
            success : function(res) {
                Kapasitas.grid.ajax.reload( null, false );
                Kapasitas.Mode("");
            },
        });
    }
    Kapasitas.remove = function(id){
        $.ajax({
            url: "<?php echo site_url('Kapasitascontroller/delete') ?>",
            type: 'post',
            dataType: 'json',
            data: {id: id},
            success : function(res) {
                Kapasitas.grid.ajax.reload( null, false );
                Kapasitas.Mode("");
            },
        });
    }
    Kapasitas.filterKapasitas = function() {
        Kapasitas.grid.ajax.reload();
    }
    Kapasitas.filterStadion = function(){

    }
    $(document).ready(function () {
        Kapasitas.grid = $("#grIdKapasitas").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Kapasitascontroller/getData') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = Kapasitas.FilterValue();
                    d['filtertext'] = Kapasitas.FilterText();
                    return d; 
                } ,
                "dataSrc": function (json) {
                    // json.draw = 1;
                    json.recordsTotal = json.RecordsTotal;
                    json.recordsFiltered = json.RecordsFiltered;
                    
                    if (json.Data)
                        return json.Data;
                    else
                        return [];
                },
            },
            "searching": false,
            "columns": [
                { "data": "NamaStadion" },
                { "data": "Kelas" },
                { "data": "KapasitasTempat" },
                {
                    "data": "IdKapasitas",
                    "render": function( data, type, full, meta){
                        return "<button class='btn btn-success' onClick='Kapasitas.selectdata("+data+")'><i class='fa fa-pencil'></i></button> &nbsp; <button class='btn btn-danger' onClick='Kapasitas.remove("+data+")'><i class='fa fa-trash'></i></button>";
                    }
                }
            ],
        });
        
        Kapasitas.grIdStadion = $("#grIdStadion").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Stadioncontroller/getData') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = Kapasitas.FilterValueStadion();
                    d['filtertext'] = Kapasitas.FilterTextStadion();
                    return d; 
                } ,
                "dataSrc": function (json) {
                    // json.draw = 1;
                    json.recordsTotal = json.RecordsTotal;
                    json.recordsFiltered = json.RecordsFiltered;
                    
                    if (json.Data)
                        return json.Data;
                    else
                        return [];
                },
            },
            "searching": false,
            "columns": [
                { "data": "NamaStadion",
                    "render": function( data, type, full, meta){
                        return "<a style='cursor:pointer;' href='#' onClick='Kapasitas.selectdataStadion("+full.IdStadion+")'>"+data+"</a>";
                    } 
                },
            ],
        });

    });
</script>