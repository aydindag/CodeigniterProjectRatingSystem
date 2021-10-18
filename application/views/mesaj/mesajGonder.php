<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="mesajBaslik">
            Mesaj Gönder
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana sayfa</a></li>
            <li class="active">Mesaj Gönder</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <a href="<?php echo base_url('mesaj/gelenKutusu') ?>" class="btn btn-primary btn-block margin-bottom">Gelen Kutusuna Dön</a>

                <div class="box box-solid">
                    <div class="box-header with-border">
                        <h3 class="box-title">Posta</h3>

                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                        </div>
                    </div>
                    <div class="box-body no-padding">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="<?php echo base_url('Mesaj/mesajPaneli/gelenKutusu') ?>"><i class="fa fa-inbox"></i> Gelen Kutusu
                  <span class="label label-primary pull-right"><?php 
                            $kontrol = $this->session->userdata('info');       
                                        $result = $this->db->select('*')
                                             ->from('mesaj')
                                             ->where('gelenID',$kontrol->ID)  
                                             ->where('okundu',"false")
                                             ->get()
                                             ->result();                                        
                            echo count($result);
                            ?></span></a></li>
                            <li><a href="<?php echo base_url('Mesaj/mesajPaneli/mesajGonderindex') ?>"><i class="fa fa-envelope-o"></i> Gönder</a></li>

                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mesaj Gönder</h3>
                    </div>
                    <!-- /.box-header -->
                    <form method="post" role="form" action="<?php echo base_url('Mesaj/mesajPaneli/mesajGonder'); ?>">
                    <div class="box-body">                       
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Kime:</label>
                            <select style="width: 100%" class="js-example-basic-single" name="kime">
                                <?php foreach($bilgi as $bilgi){ ?>
                                    <option value="<?php echo $bilgi->adiSoyadi ?>"><?php echo $bilgi->adiSoyadi ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="baslik" class="form-control" placeholder="Konu:">
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
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>


<script src="//cdn.ckeditor.com/4.11.1/standard/ckeditor.js"></script>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1');
$(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>