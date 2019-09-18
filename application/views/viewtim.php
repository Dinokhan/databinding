<script>
    model.timModel = {
        IdTim: 0,
        NamaTim: "",
    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.timModel),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['NamaTim']),
        FilterValue: ko.observable('NamaTim'),
    }
    material.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Timcontroller/getDataSelect') ?>",
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
                <h2>Tim</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" data-bind="with:material">
                <!-- Content -->
                <div class="row" data-bind="visible:Mode() === ''">
                    <div class="col-md-12 padding-filter">
                        <div class="col-md-5">
                            <button class="btn btn-sm btn-primary" data-bind="click:add"><span class="glyphicon glyphicon-plus"></span> Add Tim</button>
                        </div>
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
                        <table id="grIdTim" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                            <thead>
                                <tr>
                                    <th>Tim</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Tim</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row" data-bind="visible:Mode() === 'Update' || Mode() === 'Save'">
                    <div class="col-md-12 padding-filter">
                        <button class="btn btn-sm btn-primary" data-bind="click:backForm"><span class="glyphicon glyphicon-chevron-left"></span> Back</button>
                        <button class="btn btn-sm btn-success" data-bind="click:save"><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="text:Mode"></span></button>
                        <button class="btn btn-sm btn-danger" data-bind="click:remove"><span class="glyphicon glyphicon-trash"></span> Delete</button>
                    </div>
                    <div class="col-md-12" data-bind="with:Recordmaterial">
                        <div class="col-md-6">
                            <label class="col-md-4 filter-label">Tim</label>
                            <div class="col-md-8">
                                <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:NamaTim" />
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
    material.backForm = function(){
        material.Mode('');
        ko.mapping.fromJS(model.timModel,material.Recordmaterial);
    }
    material.add = function(){
        ko.mapping.fromJS(model.timModel,material.Recordmaterial);
        material.Mode('Save');
    }
    material.save = function(){
        var url = "<?php echo site_url('Timcontroller/save') ?>";
        if(material.Mode() === 'Update')
            url = "<?php echo site_url('Timcontroller/update') ?>";

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: material.Recordmaterial,
            success : function(res) {
                material.grid.ajax.reload( null, false );
                material.Mode("");
            },
        });
    }
    material.remove = function(id){
        $.ajax({
            url: "<?php echo site_url('Timcontroller/delete') ?>",
            type: 'post',
            dataType: 'json',
            data: {id: id},
            success : function(res) {
                material.grid.ajax.reload( null, false );
                material.Mode("");
            },
        });
    }
    material.filtermaterial = function() {
        material.grid.ajax.reload();
    }
    $(document).ready(function () {
        material.grid = $("#grIdTim").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Timcontroller/getData') ?>",
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
                { "data": "NamaTim" },
                {
                    "data": "IdTim",
                    "render": function( data, type, full, meta){
                        return "<button class='btn btn-success' onClick='material.selectdata("+data+")'><i class='fa fa-pencil'></i></button> &nbsp; <button class='btn btn-danger' onClick='material.remove("+data+")'><i class='fa fa-trash'></i></button>";
                    }
                }
            ],
        });
    });
</script>