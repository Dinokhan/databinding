<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>asset/js/jsbarcode.js"></script>
<script>
    model.MemberModel = {
        IdMember: 0,
        NamaMember: "",
        NoKtp: "",
        NoMember: moment().unix(),
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
                        <table id="grIdMember" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tableik">
                            <thead>
                                <tr>
                                    <th>No Member</th>
                                    <th>Nama</th>
                                    <th>No Ktp</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No Member</th>
                                    <th>Nama</th>
                                    <th>No Ktp</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
<img src="<?php echo base_url() ?>asset/images/bonekcard.jpg" id="bonekcard" style="display: none;"/>
<img src="" id="photoprofile" style="display: none;" />
<script>
    material.backForm = function(){
        material.Mode('');
        ko.mapping.fromJS(model.MemberModel,material.Recordmaterial);
    }
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
        var file = model.fileData().dataURL();
          if (file != "") {
              formData.append("userfile", model.fileData().file());   
          }

        ajaxPost(url, formData, function (res) {
          ko.mapping.fromJS(model.MemberModel, material.Recordmaterial);
          material.grid.ajax.reload( null, false );
            material.Mode("");
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
    material.remove = function(id){
        $.ajax({
            url: "<?php echo site_url('Membercontroller/delete') ?>",
            type: 'post',
            dataType: 'json',
            data: {id: id},
            success : function(res) {
                material.grid.ajax.reload( null, false );
                material.Mode("");
            },
        });
    }
    function textToBase64Barcode(text){
      var canvas = document.createElement("canvas");
      JsBarcode(canvas, text, {format: "CODE39"});
      return canvas.toDataURL("image/png");
    }
    function getBase64Image(img) {
      var canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0);
      var dataURL = canvas.toDataURL("image/png");
      return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    }
    function getBase64Image2(img) {
      var canvas = document.createElement("canvas");
      canvas.width = img.width;
      canvas.height = img.height;
      var ctx = canvas.getContext("2d");
      ctx.drawImage(img, 0, 0);
      var dataURL = canvas.toDataURL("image/jpg");
      return dataURL.replace(/^data:image\/(png|jpg);base64,/, "");
    }
    material.cetak = function(id){
        $.ajax({
            url: "<?php echo site_url('Membercontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                $('#photoprofile').attr('src',"<?php echo base_url() ?>imgmember/"+res[0].photo);
                var delayInMilliseconds = 3000;

                setTimeout(function() {
                    var bonekcard = getBase64Image(document.getElementById("bonekcard"));
                    var photoprofile = getBase64Image2(document.getElementById("photoprofile"));

                    var barcode = textToBase64Barcode(res[0].NoMember)
                    var doc = new jsPDF('p', 'pt', 'a4', false);
                
                    doc.setFontSize(14);
                    doc.setTextColor(11,132,65);
                    doc.addImage(bonekcard, 'png', 0, 0, 255, 156);
                    doc.text(13, 90, res[0].NoMember);
                    doc.text(13, 130, res[0].NamaMember);
                    doc.addImage(photoprofile, "jpg", 180, 10, 60, 60);
                    doc.addImage(barcode, "jpg", 150, 120, 100, 30);
                    
                    doc.save('bonekcard.pdf')
                }, delayInMilliseconds);
                
            },
        });
        
    }
    material.filtermaterial = function() {
        material.grid.ajax.reload();
    }
    $(document).ready(function () {
        material.grid = $("#grIdMember").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Membercontroller/getData') ?>",
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
                { "data": "NoMember" },
                { "data": "NamaMember" },
                { "data": "NoKtp" },
                { "data": "Status" },
                {
                    "data": "IdMember",
                    "render": function( data, type, full, meta){
                        return " <button class='btn btn-warning' onClick='material.cetak("+data+")'><i class='fa fa-print'></i></button>";
                    }
                }
            ],
        });
    });
</script>