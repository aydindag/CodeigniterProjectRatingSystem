<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div>

        </div>
        <h1 style="float:left;">
            <p>Proje Grubu &#160;</p>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="">Proje Grubu</li>
            <li class="active">Üye Ekle</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php if(validation_errors()) {
                    echo '<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>'.validation_errors().'</div>';
                }
                ?>
                <?php echo $this->session->flashdata('hata'); ?>
                <?php echo $this->session->flashdata('fazlaOgrenci'); ?>
                <!-- /.box-header -->
                <!-- form start -->

                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title">Üye Ekle</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="<?php echo base_url('Ogrenci/projeGrubu/ekle'); ?>" >
                        <div class="box-body">
                            <div class="form-group">
                                <label>üye Seçin</label> <br>
                                <select class="js-example-basic-multiple" name="students[]" multiple="multiple" style="width: 100%">
                                    <?php $kontrol = $this->session->userdata('info');
                                    $ogrNo = $kontrol->ogrNo;
                                    foreach($inf as $inf){ ?>
                                        <?php if(!($inf->ogrNo==$ogrNo) and $inf->projeKodu==null){  //kişi kendisini eklemeyemez.?>
                                            <option value="<?php echo $inf->ID; ?>"><?php echo $inf->adiSoyadi; ?></option>
                                        <?php }} ?>
                                </select>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn btn-primary">Gönder</button>
                        </div>
                    </form>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
