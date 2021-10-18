<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Proje &nbsp; Ekle</p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Proje Ekle</li>
        </ol>


    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php echo $this->session->flashdata('ekleBasari'); ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Lütfen gerekli bilgileri doldurun</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="<?php echo base_url('Ogrenci/home/projeEkleButton'); ?>" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">proje Adı</label>
                                <input name="projeAdi" required type="text" class="form-control" id="exampleInputEmail1" placeholder="proje Adı">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">proje Açıklaması</label>
                                <textarea placeholder="proje Açıklaması" name="projeAciklama" id="editor1" rows="10" cols="80">
                            </textarea>
                            </div>
                            <div>
                                <div class="form-group">
                                    <?php echo form_open_multipart('yonetimPaneli/do_upload');?>
                                    <label for="exampleInputEmail1">Afiş</label>
                                    <input class="form-control-file" id="exampleFormControlFile1" type="file" name="userfile" size="20" />
                                    <small>Only gif|jpg|png and less than 500KB</small>
                                </div>
                                <div class="form-group">
                                    <?php echo form_open_multipart('yonetimPaneli/do_upload');?>
                                    <label for="exampleInputEmail1">Dosya</label>
                                    <input class="form-control-file" id="exampleFormControlFile1" type="file" name="userfilea" size="20" />
                                    <small>Only pdf and less than 500KB</small>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Proje Kodu</label>
                                <input name="projeKodu" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Proje Kodu">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Danışman</label>
                                <input name="hocaID" required type="text" readonly class="form-control" id="exampleInputEmail1" value="<?php echo $inf->adiSoyadi ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            </div>
                            <div class="form-group">

                                <label for="exampleInputEmail1">Proje Yılı</label>
                                <input name="yil" required type="text" readonly class="form-control" id="exampleInputEmail1" value="<?php echo date("Y");?>">
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
