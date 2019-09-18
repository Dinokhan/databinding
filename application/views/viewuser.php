<script>
    model.userModel = {
        IdLogin: 0,
        Username: "",
        Password:"",
        Role: "admin",
        NamaKaryawan:"",
    }

    var user = {
        RecordUser: ko.mapping.fromJS(model.userModel),
        ListUser: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['Username']),
        FilterValue: ko.observable('Username'),
    }
    user.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Usercontroller/getUser') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                ko.mapping.fromJS(res[0], user.RecordUser);
                user.Mode("Update");
            },
        });
    }
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
                <h2>User</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" data-bind="with:user">
                <!-- Content -->
                <div class="row" data-bind="visible:Mode() === ''">
                    <div class="col-md-12 padding-filter">
                        <div class="col-md-5">
                            <button class="btn btn-sm btn-primary" data-bind="click:add"><span class="glyphicon glyphicon-plus"></span> Add User</button>
                        </div>
                        <div class="col-md-12">
                            <label class="col-md-2 filter-label">Filter</label>
                            <div class="col-md-8" style="display:inline-block">
                                <select name="ddfilter" style="width:150px;" class="form-input form-control filter-textinline" data-bind="value: FilterValue, foreach:DataFilter "/>
                                    <option data-bind="html:$data,attr:{'value':$data}"></option>
                                </select>
                                <input name="txtfilter" class="form-input form-control filter-textinline" data-bind="value:FilterText" placeholder="filter"/>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-primary" data-bind="click:filterUser"><span class="glyphicon glyphicon-search"></span> Filter</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <table id="gridUser" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Role</th>
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
                    <div class="col-md-12" data-bind="with:RecordUser">
                        <div class="col-md-4">
                            <label class="col-md-4 filter-label">Username</label>
                            <div class="col-md-8">
                                <input name="txtusername" class="form-input form-control" type="text" data-bind="value:Username" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-4 filter-label">Password</label>
                            <div class="col-md-8">
                                <input name="txtpassword" class="form-input form-control" type="text" data-bind="value:Password" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-4 filter-label">Password</label>
                            <div class="col-md-8">
                                <input name="txtpassword" class="form-input form-control" type="text" data-bind="value:NamaKaryawan" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="col-md-4 filter-label">Role</label>
                            <div class="col-md-8">
                                <select class="form-control" data-bind="value: Role">
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                </select>
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
    user.backForm = function(){
        user.Mode('');
        ko.mapping.fromJS(model.userModel,user.RecordUser);
    }
    user.add = function(){
        ko.mapping.fromJS(model.userModel,user.RecordUser);
        user.Mode('Save');
    }
    user.save = function(){
        var url = "<?php echo site_url('Usercontroller/saveUser') ?>";
        if(user.Mode() === 'Update')
            url = "<?php echo site_url('Usercontroller/updateUser') ?>";

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: user.RecordUser,
            success : function(res) {
                user.grid.ajax.reload( null, false );
                user.Mode("");
            },
        });
    }
    user.remove = function(id){
        $.ajax({
            url: "<?php echo site_url('Usercontroller/deleteUser') ?>",
            type: 'post',
            dataType: 'json',
            data: {id: id},
            success : function(res) {
                user.grid.ajax.reload( null, false );
                user.Mode("");
            },
        });
    }
    user.filterUser = function() {
        user.grid.ajax.reload();
    }
    $(document).ready(function () {
        user.grid = $("#gridUser").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Usercontroller/getDataUser') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = user.FilterValue();
                    d['filtertext'] = user.FilterText();
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
                // { "data": "DateInput",
                //     "render": function(data, type, full, meta){
                //         return "<span>"+moment(data).format("DD MMM YYYY")+"</span>";
                //     }
                //  },
                { "data": "NamaKaryawan" },
                { "data": "Username" },
                { "data": "Password" },
                { "data": "Role" },
                {
                    "data": "IdLogin",
                    "render": function( data, type, full, meta){
                        return "<button class='btn btn-success' onClick='user.selectdata("+data+")'><i class='fa fa-pencil'></i></button> &nbsp; <button class='btn btn-danger' onClick='user.remove("+data+")'><i class='fa fa-trash'></i></button>";
                    }
                }
            ],
        });
    });
</script>