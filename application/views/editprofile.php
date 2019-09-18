<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>asset/js/jsbarcode.js"></script>
<script>
    model.MemberModel = {
        IdMember: 0,
        NamaMember: "",
        NoKtp: "",
        NoMember: "",
        Status: "",
        IdKelas: 0,
        username: "",
        password: "",
        email: "",
        photo: "",
    }

    model.fileData = ko.observable({
          dataURL: ko.observable(),
      });

    
    model.onClear = function(){
    if(confirm('Are you sure?')){
      fileData.clear && fileData.clear();
    }
  };

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.MemberModel),
        Listmaterial: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['NamaMember']),
        FilterValue: ko.observable('NamaMember'),
    }
    material.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Membercontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                if (res[0].NoMember == "")
                    res[0].NoMember = moment().unix();
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
                <h2>Member</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" data-bind="with:material">
                
                <div class="row" data-bind="visible:Mode() === 'Update'">
                    <div class="col-md-12 padding-filter">
                        <button class="btn btn-sm btn-success" data-bind="click:save"><span class="glyphicon glyphicon-floppy-disk"></span> <span data-bind="text:Mode"></span></button>
                    </div>
                    <div class="col-md-12" data-bind="with:Recordmaterial">
                        <div class="col-md-6">
                            <label class="col-md-4 filter-label">No Member</label>
                            <div class="col-md-8">
                                <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:NoMember" readonly />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-4 filter-label">Nama</label>
                            <div class="col-md-8">
                                <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:NamaMember" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="col-md-4 filter-label">No Ktp</label>
                            <div class="col-md-8">
                                <input name="txtmaterialname" class="form-input form-control" type="number" data-bind="value:NoKtp" />
                            </div>
                        </div>
                        <!-- <div class="col-md-6">
                            <label class="col-md-4 filter-label">Status</label>
                            <div class="col-md-8">
                                <select class="form-control" data-bind="value: Status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Tidak Aktif">Tidak Aktif</option>
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-6">
                            <label class="col-md-4 filter-label">Username</label>
                            <div class="col-md-8">
                                 <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:username" />
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label class="col-md-4 filter-label">Password</label>
                            <div class="col-md-8">
                                 <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:password" />
                            </div>
                        </div>
                         <div class="col-md-6">
                            <label class="col-md-4 filter-label">Email</label>
                            <div class="col-md-8">
                                 <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:email" />
                            </div>
                        </div>
                        <?php if ($login['NoMember'] != ""){ ?>
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
                        <?php } ?>
                    </div>
                </div>
                <!-- End Content -->
            </div>
        </div>
    </div>
</div>
<img src="<?php echo base_url() ?>asset/images/bonekcard.jpg" id="bonekcard" style="display: none;"/>
<img src="" id="photoprofile" style="display: none;" />
<script>
    material.add = function(){
        ko.mapping.fromJS(model.MemberModel,material.Recordmaterial);
        material.Mode('Save');
    }
    material.save = function(){
        var url = "<?php echo site_url('Membercontroller/save') ?>";
        if(material.Mode() === 'Update')
            url = "<?php echo site_url('Membercontroller/update') ?>";

        var data = ko.mapping.toJS(material.Recordmaterial);
        var formData = new FormData();
        formData.append("IdMember", data.IdMember);
        formData.append("NoMember", data.NoMember);
        formData.append("NamaMember", data.NamaMember);
        formData.append("NoKtp", data.NoKtp);
        formData.append("Status", "Member");
        formData.append("IdKelas", data.IdKelas);
        formData.append("username", data.username);
        formData.append("password", data.password);
        formData.append("email", data.email);
        formData.append("photo", data.photo);

        ajaxPost(url, formData, function (res) {
          // ko.mapping.fromJS(model.MemberModel, material.Recordmaterial);
          // material.grid.ajax.reload( null, false );
            // material.Mode("");
            location.reload();
        });
        // $.ajax({
        //     url: url,
        //     type: 'post',
        //     dataType: 'json',
        //     data: formData,
        //     success : function(res) {
        //         material.grid.ajax.reload( null, false );
        //         material.Mode("");
        //     },
        // });
    }
    $(document).ready(function () {
        material.selectdata(<?php echo $login['IdMember']; ?>);
    });
</script>