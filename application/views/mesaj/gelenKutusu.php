<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 id="mesajBaslik">
            Mesaj Kutusu
        </h1>
        <ol class="breadcrumb">
            <li><a href="/"><i class="fa fa-dashboard"></i> Ana sayfa</a></li>
            <li class="active">Mesaj Kutusu</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
	<?php echo $this->session->flashdata('validError'); ?>
            <div class="col-md-3">
                <a href="<?php echo base_url('mesaj/mesajGonder') ?>" class="btn btn-primary btn-block margin-bottom">Mesaj Gönder</a>

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
                  <span class="label label-primary pull-right">
                           <?php 
                             $kontrol = $this->session->userdata('info');       
                                        $result = $this->db->select('*')
                                             ->from('mesaj')
                                             ->where('gelenID',$kontrol->ID)  
                                             ->where('okundu',"false")
                                             ->get()
                                             ->result();                                              
                            echo count($result);
                            ?></span></a></li>
                            <li><a href="<?php echo base_url('mesaj/mesajGonder') ?>"><i class="fa fa-envelope-o"></i> Gönder</a></li>

                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>

            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Gelen Kutusu</h3>
                        <div class="box-tools pull-right">

                        </div>
                        <!-- /.box-tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <div class="mailbox-controls">
                            <!-- Check all button -->


                            <!-- /.btn-group -->
                            <a href="<?php echo base_url('Mesaj/mesajPaneli/gelenKutusu') ?>" type="button" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></a>

                        </div>
                        <div class="table-responsive mailbox-messages">
                            <table class="table table-hover table-striped">
                                <tbody>
                                    <?php if($bilgi) { ?>
                                    <tr>

                                        <th>Okundu</th>
                                        <th>Kimden</th>
                                        <th>Konu</th>
                                        <th></th>
                                        <th>Tarih</th>
                                    </tr>
                                    <?php $i=0  ?>
                                    <?php foreach($bilgi as $bilgi){ ?>
                                    
                                    <tr>

                                        <?php if($bilgi->okundu){ ?>
                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                                        <?php }else{ ?>
                                        <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a></td>
                                        <?php } ?>                                        
                                        <td class="mailbox-name">
                                            <a href="<?php echo base_url('Mesaj/mesajPaneli/mesajOku/'); echo ''.$bilgi->ID.'/' ?>">
                                                <?php echo $isimler[$i] ?>
                                            </a>
                                        </td>
                                        <td class="mailbox-subject"><b><?php echo $bilgi->baslik ?></b>

                                        </td>
                                        <td class="mailbox-attachment"></td>
                                        <td class="mailbox-date">
                                            <?php echo $bilgi->tarih ?>
                                        </td>
                                    </tr>
                                    <?php $i=$i+1 ?>
                                    <?php }  ?>
                                    <?php }  ?>
                                    <?php if(!$bilgi) { ?>
                                    <tr>
                                        <td>Herhangi bir mesajınız yok.</td>
                                    </tr>
                                    <?php } ?>


                                </tbody>
                            </table>
                            <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                        <div class="mailbox-controls">

                        </div>

                    </div>
                    <?php echo $this->session->flashdata('ekleBasari'); ?>

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

</script>

<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
