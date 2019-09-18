<script type="text/javascript" src="<?php echo base_url() ?>asset/js/datepicker/daterangepicker.js"></script>
<script>
    model.jadwalModel = {
        IdJadwal: 0,
        Jadwal: moment().format("YYYY/MM/DD"),
        Tim1: 0,
        Tim2: 0,
        Jam: "",
        IdStadion: 0,
        Status: "Aktif",
        HargaTiket: 0
    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.jadwalModel),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['Jadwal']),
        FilterValue: ko.observable('Jadwal'),
    }
    material.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Jadwalcontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], material.Recordmaterial);
                material.Mode("Update");
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
        <h3>Jadwal Pertandingan</h3>
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
                <h2>Jadwal</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" data-bind="with:material">
                <!-- Content -->
                <div class="row" data-bind="visible:Mode() === ''">
                    <div class="col-md-12 padding-filter">
                        <div class="col-md-12">
                            <label class="col-md-2 filter-label">Filter</label>
                            <div class="col-md-8" style="display:inline-block">
                                <select name="ddfilter" style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: FilterValue, foreach:DataFilter "/>
                                    <option data-bind="html:$data,attr:{'value':$data}"></option>
                                </select>
                                <input name="txtfilter" class="form-input form-control filter-textinline" data-bind="value:FilterText" placeholder="filter"/>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-primary" data-bind="click:filtermaterial"><span class="glyphicon glyphicon-search"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="grIdJadwal" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Jadwal</th>
                                    <th>Tim 1</th>
                                    <th>Tim 2</th>
                                    <th>Jam</th>
                                    <th>Stadion</th>
                                    <th>Sisa</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Jadwal</th>
                                    <th>Tim 1>
                                    <th>Tim 2</th>
                                    <th>Jam</th>
                                    <th>Stadion</th>
                                    <th>Sisa</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</div>

<script>
    
    material.filtermaterial = function() {
        material.grid.ajax.reload();
    }
    $(document).ready(function () {
        material.grid = $("#grIdJadwal").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Jadwalcontroller/getData2') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = material.FilterValue();
                    d['filtertext'] = material.FilterText();
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
                { "data": "Jadwal" },
                { "data": "Tim1" },
                { "data": "Tim2" },
                { "data": "NamaStadion" },
                { "data": "Jam" },
                { "data": "Sisa" },
            ],
        });
    });
</script>