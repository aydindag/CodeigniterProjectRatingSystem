<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Mesaj Ayrıntı &#160;</p>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Mesajlar</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <?php echo $this->session->flashdata('emailGonderildi'); ?>
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mesaj Gönder</h3>
                    </div>
                    <!-- /.box-header -->
                    <form method="post" role="form" action="<?php echo base_url('YonetimPaneli/mesajGonderButton'); ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kime:</label>
                                <select style="width: 100%" class="js-example-basic-single" name="kime">
                                    <?php foreach($ogrenci as $ogrenci){ ?>
                                        <option value="<?php echo $ogrenci->email ?>"><?php echo $ogrenci->adiSoyadi ?></option>
                                    <?php } ?>
                                    <?php foreach($hoca as $hoca){ ?>
                                        <option value="<?php echo $hoca->email ?>"><?php echo $hoca->adiSoyadi ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="konu" class="form-control" placeholder="Konu:">
                            </div>
                            <div class="form-group">
                            <textarea name="icerik" id="editor1" class="form-control" style="height: 300px">

                            </textarea>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Gönder</button>
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            </div>

                        </div>
                    </form>
                    <!-- /.box-footer -->
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
    CKEDITOR.replace('editor1');

</script>

<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
