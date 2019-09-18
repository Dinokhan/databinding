
<script type="text/javascript" src="<?php echo base_url() ?>asset/js/datepicker/daterangepicker.js"></script>
<script>
    model.penjualanModel = {
        IdPenjualan: 0,
        Tanggal: moment().format("YYYY/MM/DD"),
        IdJadwal: 0,
        JumlahTotal: 0,
        NoMember: 0,
        IdDiskon: 0,
        Harga: 0,
        TotalHarga: 0,
        Status: "",
    }
    model.JadwalModel = {
        IdJadwal: 0,
        Jadwal: moment().format("YYYY/MM/DD"),
        Tim1: 0,
        Tim2: 0,
        Jam: "",
        IdStadion: 0,
        Status: "Aktif",
        HargaTiket: 0
    }

    var Penjualan = {
        RecordPenjualan: ko.mapping.fromJS(model.penjualanModel),
        RecordJadwal: ko.mapping.fromJS(model.JadwalModel),
        Mode: ko.observable(''),
        ModePenjualan: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['Tanggal']),
        FilterValue: ko.observable('Tanggal'),
        DataFilterJadwal: ko.observableArray(['Jadwal']),
        FilterValueJadwal: ko.observable('Jadwal'),
        FilterTextJadwal: ko.observable(''),
    }
    Penjualan.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Penjualancontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], Penjualan.RecordPenjualan);
                Penjualan.Mode("Update");
            },
        });
    }
    Penjualan.selectdataJadwal = function(id){
        $.ajax({
            url: "<?php echo site_url('Jadwalcontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], Penjualan.RecordJadwal);
                Penjualan.RecordPenjualan.IdJadwal(res[0].IdJadwal);
                Penjualan.RecordPenjualan.Harga(res[0].HargaTiket);
                Penjualan.ModePenjualan("Penjualan");
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
                <h2>Penjualan</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" data-bind="with:Penjualan">
                <!-- Content -->
                <div class="row" data-bind="visible:Mode() === ''">
                    <div class="col-md-12 padding-filter">
                        <div class="col-md-5">
                            <button class="btn btn-sm btn-primary" data-bind="click:add"><span class="glyphicon glyphicon-plus"></span> Add Penjualan</button>
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-2 filter-label">Filter</label>
                            <div class="col-md-8" style="display:inline-block">
                                <select name="ddfilter" style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: FilterValue, foreach:DataFilter "/>
                                    <option data-bind="html:$data,attr:{'value':$data}"></option>
                                </select>
                                <input name="txtfilter" class="form-input form-control filter-textinline" data-bind="value:FilterText" placeholder="filter"/>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-primary" data-bind="click:filterPenjualan"><span class="glyphicon glyphicon-search"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="grIdPenjualan" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row" data-bind="visible:(Mode() === 'Update' || Mode() === 'Save')">
                    <div class="col-md-12 padding-filter">
                        <button class="btn btn-sm btn-primary" data-bind="click:backForm"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
                        <button class="btn btn-sm btn-success" data-bind="click:save, visible: ModePenjualan() != ''"><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="text:Mode"></span></button>
                        <button class="btn btn-sm btn-danger" data-bind="click:remove, visible: ModePenjualan() != ''"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                    </div>
                    <div class="col-md-12" data-bind="with:RecordPenjualan">
                        <div class="col-md-12" data-bind="visible:Penjualan.ModePenjualan() == ''">
                            <label class="col-md-2 filter-label">Filter</label>
                            <div class="col-md-8" style="display:inline-block">
                                <select name="ddfilter" style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: Penjualan.FilterValueJadwal, foreach:Penjualan.DataFilterJadwal "/>
                                    <option data-bind="html:$data,attr:{'value':$data}"></option>
                                </select>
                                <input name="txtfilter" class="form-input form-control filter-textinline" data-bind="value:Penjualan.FilterTextJadwal" placeholder="filter"/>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-primary" data-bind="click:Penjualan.filterJadwal"><span class="glyphicon glyphicon-search"></span> Filter</button>
                            </div>
                            <div class="col-md-12">
                                <table id="grIdJadwal" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                                    <thead>
                                        <tr>
                                            <th>Jadwal</th>
                                            <th>Tim 1</th>
                                            <th>Tim 2</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Jadwal</th>
                                            <th>Tim 1</th>
                                            <th>Tim 2</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-12 form-simi" data-bind="visible:Penjualan.ModePenjualan() != ''">
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Jadwal</label>
                                <div class="col-md-8">
                                    <input name="txtPenjualanname" class="form-input form-control" type="text" data-bind="value:Penjualan.RecordJadwal.Jadwal" disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Tanggal</label>
                                <div class="col-md-8">
                                    <input name="txtPenjualanname" id="tanggalinput" class="date-picker form-input form-control" type="text" data-bind="value: Tanggal" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Member</label>
                                <div class="col-md-8">
                                    <input name="txtPenjualanname" class="form-input form-control" type="text" data-bind="value: NoMember" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Jumlah</label>
                                <div class="col-md-8">
                                    <input name="txtPenjualanname" class="form-input form-control" type="number" data-bind="value: JumlahTotal" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Harga</label>
                                <div class="col-md-8">
                                    <input name="txtPenjualanname" class="form-input form-control" type="number" data-bind="value: Harga" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="col-md-4 filter-label">Total</label>
                                <div class="col-md-8">
                                    <input name="txtPenjualanname" class="form-input form-control" type="number" data-bind="value: TotalHarga" readonly />
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
    $('#tanggalinput').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_4",
        format: "YYYY/MM/DD",
    }, function (start, end, label) {
        material.Recordmaterial.Jadwal(moment(start).format("YYYY/MM/DD"));
        // console.log(start.toISOString(), end.toISOString(), label);
    });
    Penjualan.backForm = function(){
        if (Penjualan.ModePenjualan() == ""){  
            Penjualan.Mode('');
            ko.mapping.fromJS(model.penjualanModel,Penjualan.RecordPenjualan);
            ko.mapping.fromJS(model.JadwalModel,Penjualan.RecordJadwal);
            Penjualan.ModePenjualan('');
        } else {
            Penjualan.ModePenjualan('');
        }
    }
    Penjualan.add = function(){
        ko.mapping.fromJS(model.penjualanModel,Penjualan.RecordPenjualan);
        ko.mapping.fromJS(model.JadwalModel,Penjualan.RecordJadwal);
        Penjualan.Mode('Save');
        Penjualan.ModePenjualan("");
    }
    Penjualan.save = function(){
        var url = "<?php echo site_url('Penjualancontroller/save') ?>";
        if(Penjualan.Mode() === 'Update')
            url = "<?php echo site_url('Penjualancontroller/update') ?>";

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: Penjualan.RecordPenjualan,
            success : function(res) {
                Penjualan.grid.ajax.reload( null, false );
                Penjualan.Mode("");
            },
        });
    }
    Penjualan.remove = function(id){
        $.ajax({
            url: "<?php echo site_url('Penjualancontroller/delete') ?>",
            type: 'post',
            dataType: 'json',
            data: {id: id},
            success : function(res) {
                Penjualan.grid.ajax.reload( null, false );
                Penjualan.Mode("");
            },
        });
    }
    Penjualan.filterPenjualan = function() {
        Penjualan.grid.ajax.reload();
    }
    Penjualan.filterJadwal = function(){

    }
    $(document).ready(function () {
        Penjualan.grid = $("#grIdPenjualan").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Penjualancontroller/getData') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = Penjualan.FilterValue();
                    d['filtertext'] = Penjualan.FilterText();
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
                { "data": "Tanggal" },
                { "data": "JumlahTotal" },
                { "data": "Harga" },
                { "data": "TotalHarga" },
                {
                    "data": "IdPenjualan",
                    "render": function( data, type, full, meta){
                        return "<button class='btn btn-success' onClick='Penjualan.selectdata("+data+")'><i class='fa fa-pencil'></i></button> &nbsp; <button class='btn btn-danger' onClick='Penjualan.remove("+data+")'><i class='fa fa-trash'></i></button>";
                    }
                }
            ],
        });
        
        Penjualan.grIdJadwal = $("#grIdJadwal").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Jadwalcontroller/getData') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = Penjualan.FilterValueJadwal();
                    d['filtertext'] = Penjualan.FilterTextJadwal();
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
                { "data": "Jadwal",
                    "render": function( data, type, full, meta){
                        return "<a style='cursor:pointer;' href='#' onClick='Penjualan.selectdataJadwal("+full.IdJadwal+")'>"+data+"</a>";
                    } 

                },
                { "data": "Tim1"},
                { "data": "Tim2"},
            ],
        });

    });
</script>