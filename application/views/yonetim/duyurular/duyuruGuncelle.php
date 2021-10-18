<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Duyuru &nbsp; Güncelle -&#160;</p>
        </h1>
        <a href="<?php echo base_url('yonetimPaneli/duyurular') ?>"><button style="width:auto;" type="button" class="btn btn-block btn-default btn-sm">Listeye Dön</button></a>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Duyuru Güncelle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Duyuru Güncelle</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="<?php echo base_url('yonetimPaneli/duyuruGuncelleButton/'); echo ''.$inf->ID.'' ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Başlık</label>
                                <input name="baslik" value="<?php echo $inf->duyuruBaslik ?>" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Başlık girin">
                            </div>
                            <div class="form-group">
                            <label for="exampleInputEmail1">İçerik</label>
                            <textarea placeholder="İçerik girin" name="icerik" id="editor1" rows="10" cols="80">
                               <?php echo $inf->duyuruIcerik ?>
                            </textarea>
                            </div>
                            <div class="form-group">
                               <?php $info=$this->session->userdata('info'); ?>
                                <label for="exampleInputEmail1">Ekleyen</label>
                                <input name="ekleyenisim"  readonly required type="text" value="<?php echo $inf->ekleyenIsım ?>" class="form-control" id="exampleInputEmail1" placeholder="Ekleyen İsmi">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            </div>

                        </div>
                        <div class="box-footer">
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
<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
