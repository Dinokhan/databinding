<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
<script src="<?php echo base_url() ?>asset/js/jsbarcode.js"></script>
<script>
    model.penjualanModel = {
        IdPenjualan: 0,
        NoPenjualan: moment().unix().toString(),
        Tanggal: moment().format("YYYY/MM/DD"),
        IdMember: 0,
        NoMember: "",
        Nama: "",
        Ktp: "",
        Email: "",
        Status: "Lunas",
        TotalHarga: 0,
        IdPromo: 0,
        DiskonPromo: 0,
        TipePenjualan: "offline",
        Phone: 0,
        Address: "",
        ZipCode: 0,
        BirthDate: "",
        City: "",
        State: "",
        Harga: 0,
        IdKelas: 0,
        PaymentDuitku: "",
        Kategori: ""
    }

    model.detilModel = {
        IdDetilPenjualan: 0,
        NoTiket: moment.unix(),
        Jadwal: "",
        IdJadwal: 0,
        Harga: 0,
        IdPenjualan: 0,
        Tim1: "",
        Tim2: "",
    }

    var material = {
        Recordmaterial: ko.mapping.fromJS(model.penjualanModel),
        Recorddetilmaterial: ko.mapping.fromJS(model.detilModel),
        datadetil: ko.observableArray([]),
        Mode: ko.observable(''),
        FilterText: ko.observable(''),
        DataFilter: ko.observableArray(['NoPenjualan']),
        FilterValue: ko.observable('NoPenjualan'),
    }
    material.selectdata = function(id) {
        $.ajax({
            url: "<?php echo site_url('Penjualannewcontroller/getDataSelect') ?>",
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
                <h2>Penjualan</h2>
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
                        <table id="grIdPenjualan" cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No Penjualan</th>
                                    <th>Tanggal</th>
                                    <th>No Member</th>
                                    <th>Nama</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No Penjualan</th>
                                    <th>Tanggal</th>
                                    <th>No Member</th>
                                    <th>Nama</th>
                                    <th>Total</th>
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

<script id="detilpenjualan" type="text/html">
  <tr>
    <td data-bind="html: Jadwal"></td>
    <td data-bind="html: Tim1"></td>
    <td data-bind="html: Tim2"></td>
    <td>
        <button data-bind="click:material.removeItem"><i class='fa fa-trash'></i></button>
    </td>
  </tr>
</script>

<div class="modal fade modal-tiket" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Jadwal</h4>
      </div>
      <div class="modal-body">
        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tablejadwal">
            <thead>
                <tr>
                    <th>Jadwal</th>
                    <th>Tim 1</th>
                    <th>Tim 2</th>
                    <th>Jam</th>
                    <th>Sisa Tiket</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Jadwal</th>
                    <th>Tim 1</th>
                    <th>Tim 2</th>
                    <th>Jam</th>
                    <th>Sisa Tiket</th>
                </tr>
            </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-member" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Member</h4>
      </div>
      <div class="modal-body">
        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tablemember">
            <thead>
                <tr>
                    <th>NoMember</th>
                    <th>Nama</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>NoMember</th>
                    <th>Nama</th>
                </tr>
            </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-promo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Promo</h4>
      </div>
      <div class="modal-body">
        <table cellpadding="0" cellspacing="0" width="100%" class="table table-bordered table-striped" id="tablepromo">
            <thead>
                <tr>
                    <th>Min Tiket</th>
                    <th>Diskon</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th>Min Tiket</th>
                    <th>Diskon</th>
                </tr>
            </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-doku" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Duitku</h4>
      </div>
      <div class="modal-body">
        <div class="row" data-bind="with: material.Recordmaterial">
            <div class="col-md-12">
                <label class="col-md-4 filter-label">Phone</label>
                <div class="col-md-8">
                    <input name="txtmaterialname" class="form-input form-control" type="number" data-bind="value:Phone" />
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-4 filter-label">Email</label>
                <div class="col-md-8">
                    <input name="txtmaterialname" class="form-input form-control" type="text" data-bind="value:Email" />
                </div>
            </div>
            <div class="col-md-12">
                <label class="col-md-4 filter-label">Duitku Pembayaran</label>
                <div class="col-md-8">
                    <select class="form-control kelas" data-bind="value: PaymentDuitku">
                        <option value="WW">Duitku Wallet</option>
                        <option value="VC">Kartu Kredit</option>
                        <option value="MY">Mandiri Clickpay</option>
                        <option value="BK">BCA Klikpay</option>
                        <option value="A1">ATM Bersama</option>
                    </select>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <!-- <button class="btn btn-primary" data-bind="click: material.savedoku">Bayar Doku</button> -->
        <button class="btn btn-primary" data-bind="click: material.saveduitku">Bayar Duitku</button>
      </div>
    </div>
  </div>
</div>

<img src="<?php echo base_url() ?>asset/images/tiketbg.jpg" id="bonekcard" style="display: none;"/>
<script>
    material.changekategori = function(){
        if (material.Recordmaterial.Kategori() == "Pelajar"){
            var total = 0;
            for (var i in material.datadetil()){
                total += parseInt(material.Recordmaterial.Harga());
            }
            total = total - ((20/100)*total);
            material.Recordmaterial.TotalHarga(total);
        } else {
            var total = 0;
            for (var i in material.datadetil()){
                total += parseInt(material.Recordmaterial.Harga());
            }
            total = total + ((20/100)*total);
            material.Recordmaterial.TotalHarga(total);
        }
    }
    material.saveduitku = function(){
        var data = ko.mapping.toJS(material.Recordmaterial);
        var datadetil = [];
        for (var i in material.datadetil()){
            datadetil.push({name: material.datadetil()[i].Jadwal+" "+material.datadetil()[i].Tim1+" "+material.datadetil()[i].Tim2, price: material.Recordmaterial.Harga(), quantity: 1})
        }
        data['detil'] = ko.mapping.toJSON(datadetil);
        // console.log(data)
        $('input[name="detil"]').val(ko.mapping.toJSON(datadetil));
        $('input[name="detil2"]').val(ko.mapping.toJSON(material.datadetil()));
        $('.form-tiket').submit();
        // $.ajax({
        //     url: "<?php echo site_url('Penjualannewcontroller/duitkubayar') ?>",
        //     type: 'post',
        //     dataType: 'json',
        //     data: data,
        //     success : function(res) {
        //         // material.grid.ajax.reload( null, false );
        //         // material.Mode("");
        //         console.log(res);
        //         $('.modal-doku').modal("hide");
        //     },
        // });
    }
    material.changekelas = function(){
        var harga = $("select.kelas option[value="+material.Recordmaterial.IdKelas()+"]").attr('harga')
        material.Recordmaterial.Harga(parseInt(harga));
        var total = 0;
        for (var i in material.datadetil()){
            total += parseInt(material.Recordmaterial.Harga());
        }
        total = total - ((parseInt(material.Recordmaterial.DiskonPromo())/100)*total);
        material.Recordmaterial.TotalHarga(total);
    }
    material.savedoku = function(){
        var basket = "";
        for (var i in material.datadetil()){
            basket += "tiket " + material.datadetil()[i].Jadwal+","+"1,"+material.datadetil()[i].Harga+";";
        }
        $('input[name=BASKET]').val(basket)
        $( "#doku" ).submit();
        $('.modal-doku').modal("hide");
    }
    material.removeItem = function(data){
        material.datadetil.remove(data);
        var total = 0;
        for (var i in material.datadetil()){
            total += parseInt(material.Recordmaterial.Harga());
        }
        total = total - ((parseInt(material.Recordmaterial.DiskonPromo())/100)*total);;
        material.Recordmaterial.TotalHarga(total);
    }
    material.backForm = function(){
        material.Mode('');
        ko.mapping.fromJS(model.penjualanModel,material.Recordmaterial);
    }
    material.add = function(){
        ko.mapping.fromJS(model.penjualanModel,material.Recordmaterial);
        material.Mode('Save');
        material.datadetil([]);
    }
    material.save = function(){
        var url = "<?php echo site_url('Penjualannewcontroller/save') ?>";
        if(material.Mode() === 'Update')
            url = "<?php echo site_url('Penjualannewcontroller/update') ?>";

        $.ajax({
            url: url,
            type: 'post',
            dataType: 'json',
            data: material.Recordmaterial,
            success : function(res) {
                material.grid.ajax.reload( null, false );
                for (var i in material.datadetil()){
                    material.savedetil(material.datadetil()[i]);
                }
                material.Mode("");
            },
        });
    }
    material.savedetil = function(data){
        $.ajax({
            url: "<?php echo site_url('Penjualannewcontroller/savedetil') ?>",
            type: 'post',
            dataType: 'json',
            data: data,
            success : function(res) {
                material.grid.ajax.reload( null, false );
                material.Mode("");
            },
        });
    }
    material.remove = function(id){
        $.ajax({
            url: "<?php echo site_url('Penjualannewcontroller/delete') ?>",
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
    material.selectdataMember = function(id){
        $.ajax({
            url: "<?php echo site_url('Membercontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                material.Recordmaterial.IdMember(res[0].IdMember);
                material.Recordmaterial.NoMember(res[0].NoMember);
                material.Recordmaterial.Nama(res[0].NamaMember);
                material.Recordmaterial.Ktp(res[0].NoKtp);
                material.Recordmaterial.Email(res[0].Email);
                $('.modal-member').modal("hide");
            },
        });
    }
    material.selectdataPromo = function(id){
        $.ajax({
            url: "<?php echo site_url('Promocontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                // console.log(res);
                material.Recordmaterial.IdPromo(res[0].IdPromo);
                material.Recordmaterial.DiskonPromo(res[0].DiskonPromo);
                var total = 0;
                for (var i in material.datadetil()){
                    total += parseInt(material.Recordmaterial.Harga());
                }
                total = total - ((parseInt(material.Recordmaterial.DiskonPromo())/100)*total);
                material.Recordmaterial.TotalHarga(total);
                $('.modal-promo').modal("hide");
            },
        });
    }
    material.selectdataJadwal = function(id){
        $.ajax({
            url: "<?php echo site_url('Jadwalcontroller/getDataSelect') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                var minpem = material.datadetil().length;
                if (material.Recordmaterial.NoMember() != "" || minpem < 4){
                    material.datadetil.push({
                        IdPenjualan: material.Recordmaterial.NoPenjualan(),
                        IdJadwal: res[0].IdJadwal,
                        Jadwal: res[0].Jadwal,
                        Harga: res[0].HargaTiket,
                        NoTiket: moment().unix().toString(),
                        Tim1: res[0].Tim1,
                        Tim2: res[0].Tim2,
                    });
                    var total = 0;
                    for (var i in material.datadetil()){
                        total += parseInt(material.Recordmaterial.Harga());
                    }
                    total = total - ((parseInt(material.Recordmaterial.DiskonPromo())/100)*total);
                    material.Recordmaterial.TotalHarga(total);
                    $('.modal-tiket').modal("hide");
                } else {
                    alert("Selain member tiket hanya boleh 4");
                }
            },
        });
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
    function textToBase64Barcode(text){
      var canvas = document.createElement("canvas");
      JsBarcode(canvas, text, {format: "CODE39"});
      return canvas.toDataURL("image/png");
    }
    material.cetak = function(id){
        $.ajax({
            url: "<?php echo site_url('Penjualannewcontroller/getDataSelectTiket') ?>",
            type: 'post',
            dataType: 'json',
            data : {id: id},
            success : function(res) {
                console.log(res)
                var bgtiket = getBase64Image(document.getElementById("bonekcard"));
                var newline = 0;
                 var doc = new jsPDF('p', 'pt', 'a4', false);
                for(var i in res.Data){
                    var barcode = textToBase64Barcode(res.Data[i].NoTiket);

                    doc.setFontSize(14);
                    doc.setTextColor(11,132,65);
                    if (i == 0){
                        doc.addImage(bgtiket, 'png', 0, 10, 700, 150);
                        doc.text(13, 30, "Nama :");
                        doc.text(13, 45, res.Data[i].Nama);
                        doc.text(13, 75, "No Member :");
                        doc.text(13, 90, res.Data[i].NoMember);
                        doc.text(370, 30, "Stadion :");
                        doc.text(370, 45, res.Data[i].NamaStadion);
                        doc.text(370, 75, "Pertandingan :");
                        doc.text(370, 90, res.Data[i].Tim1 + " VS " + res.Data[i].Tim2);
                        doc.addImage(barcode, "jpg", 150, 125, 100, 30);
                    } else {
                        doc.addImage(bgtiket, 'png', 0, (newline+10), 700, 150);
                        doc.addImage(barcode, "jpg", 150, (125+newline), 100, 30);
                        doc.text(13, (30+newline), "Nama :");
                        doc.text(13, (45+newline), res.Data[i].Nama);
                        doc.text(13, (75+newline), "No Member :");
                        doc.text(13, (90+newline), res.Data[i].NoMember);
                        doc.text(370, (30+newline), "Stadion :");
                        doc.text(370, (45+newline), res.Data[i].NamaStadion);
                        doc.text(370, (75+newline), "Pertandingan :");
                        doc.text(370, (90+newline), res.Data[i].Tim1 + " VS " + res.Data[i].Tim2);
                    }
                    
                    // doc.addImage(photoprofile, "jpg", 180, 10, 60, 60);
                    newline += 180;
                    
                    // doc.addPage();
                }

                
                doc.save('tiketbonek.pdf')
            }
        })
    }
    $(document).ready(function () {
        material.tbjadwal = $("#tablejadwal").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Jadwalcontroller/getData2') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = "IdJadwal";
                    d['filtertext'] = "";
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
                        return "<a style='cursor:pointer;' href='#' onClick='material.selectdataJadwal("+full.IdJadwal+")'>"+data+"</a>";
                    } 

                },
                { "data": "Tim1"},
                { "data": "Tim2"},
                { "data": "Jam"},
                { "data": "Sisa"},
            ],
        });

        material.tbmember = $("#tablemember").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Membercontroller/getData') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = "NoMember";
                    d['filtertext'] = "";
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
                { "data": "NoMember",
                    "render": function( data, type, full, meta){
                        return "<a style='cursor:pointer;' href='#' onClick='material.selectdataMember("+full.IdMember+")'>"+data+"</a>";
                    } 

                },
                { "data": "NamaMember"},
            ],
        });

        material.tbpromo = $("#tablepromo").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Promocontroller/getData') ?>",
                "type": "POST",
                "data": function(d){ 
                    d['filtervalue'] = "IdPromo";
                    d['filtertext'] = "";
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
                { "data": "MinTiket",
                    "render": function( data, type, full, meta){
                        return "<a style='cursor:pointer;' href='#' onClick='material.selectdataPromo("+full.IdPromo+")'>"+data+"</a>";
                    } 

                },
                { "data": "DiskonPromo"},
            ],
        });

        material.grid = $("#grIdPenjualan").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "<?php echo site_url('Penjualannewcontroller/getData') ?>",
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
                { "data": "NoPenjualan" },
                { "data": "Tanggal" },
                { "data": "NoMember" },
                { "data": "Nama" },
                { "data": "TotalHarga" },
                { "data": "Status" },
                {
                    "data": "IdPenjualan",
                    "render": function( data, type, full, meta){
                        return "<button class='btn btn-warning' onClick='material.cetak("+data+")'><i class='fa fa-print'></i></button>";
                    }
                }
            ],
        });
    });
</script>