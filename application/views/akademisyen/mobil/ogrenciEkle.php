<?php $this->load->view('yonetim/include/headerMobil'); ?>
<style>
    .select2-selection__choice {
        margin-bottom: 5px;
    }

    #selecttext {
        color: black;
    }

</style>
<link rel="stylesheet" href="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/select2/dist/css/select2.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<!-- Default box -->
<?php echo $this->session->flashdata('ekleBasari'); ?>
<!--
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Öğrenci Ekle</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/eskiogrEkle/');echo ''.$projeBilgi.'' ?>" enctype="multipart/form-data">
        <div class="box-body table-responsive p-2">
            <div class="form-group">
                <label for="exampleFormControlSelect1">Sistem Kayıtlı Öğrencilerden Seç<br><small>Çoklu Seçim Yapabilirsiniz.</small></label>
                <div id="selecttext" class="col-sm-12">
                    <select style="width:100%;margin:3px;" class="js-example-basic-multiple" name="ogr[]" multiple="multiple">
                        <?php $kontrol = $this->session->userdata('info'); ?>
                        <?php foreach($bilgi as $bilgi){ ?>
                        <?php if($kontrol->hocaID==$bilgi->hocaID){ ?>
                        <option value="<?php echo $bilgi->ID ?>"><?php echo $bilgi->adiSoyadi ?>
                        </option>
                        <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>        
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Ekle</button>
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
        </div>
    </form>
</div>
 /.box-footer-->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Yeni Öğrenci Ekle
            <a type="button" onclick="myFunction()"><i class="far fa-question-circle"></i></a>
        </h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/ogrenciEkleButton/'); echo ''.$projeBilgi.'' ?>" enctype="multipart/form-data">
        <div class="box-body table-responsive p-2">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Öğrenci Numarası</label>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input name="ogrNo" type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Adı Soyadı</label>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input name="adsoyad" type="text" class="form-control">
                    </div>
                </div>
            </div>            
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <button type="submit" class="btn btn-primary btn-flat">Ekle</button>
            <div id="myDIV" style="visibility:hidden;height:0px;">Öğrenci eklendiğinde; ogrNo@ogrenci.karabuk.edu.tr mail adresine, kullanıcı adı ve şifre bilgileri mail atılır. Mail gitmemesi durumunda öğrencinin kullanıcı adı ve şifre bilgilerini öğrenci profilinden öğrenebilirsiniz. </div>
        </div>
    </form>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<script src="<?php echo base_url('assets/AdminPanel/'); ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });

</script>
<script>
    function myFunction() {
        var x = document.getElementById('myDIV');
        if (x.style.visibility === 'hidden') {
            x.style.visibility = 'visible';
            x.style.height="auto"; 
            x.style.border="4px dotted black";
            x.style.margin="5px 0px 0px 0px";            
        } else {
            x.style.visibility = 'hidden';
            x.style.height="0px";    
            x.style.border="";
            x.style.margin="";
        }
    }
</script>
<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()
    })

</script>
<?php $this->load->view('yonetim/include/footerMobil'); ?>
