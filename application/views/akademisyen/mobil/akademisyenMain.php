<?php $this->load->view('yonetim/include/headerMobil'); ?>
<?php $kontrol = $this->session->userdata('info');?>
<!-- Default box 
    
    <a type="button" style="margin-bottom: 15px;" class="btn btn-info" href="<?php echo base_url('Akademisyen/akademisyenPaneli'); ?>">Panele Dön</a>
    <a type="button" style="margin-bottom: 15px;margin-left:15px;" class="btn btn-info" href="<?php echo base_url('Akademisyen/home/projelerim'); ?>">Öğrencilerim</a>
    <a type="button" style="margin-bottom: 15px;margin-left:15px;" class="btn btn-info" href="<?php echo base_url('akademisyen/projeler/'); echo ''.$kontrol->hocaID.'' ?>">Projelerim</a>
    <a type="button" style="margin-bottom: 15px;margin-left:15px;" class="btn btn-info" href="<?php echo base_url('Akademisyen/home/projeEkle'); ?>">Proje Ekle</a>-->
<!-- Example single danger button -->
<?php echo $this->session->flashdata('ekleBasari'); ?>
<!--
<div class="box">

    <div class="box-header with-border">
        <h3 class="box-title">Proje Ara</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body">
        <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/ara'); ?>" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Proje Kodu</label>
                <div class="col-sm-12">
                    <div class="input-group input-group">
                        <input name="projeID" type="text" class="form-control">
                        <span class="input-group-btn">
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn btn-info btn-flat">Ara</button>
                        </span>
                    </div>
                </div>

            </div>
        </form>
    </div>
    -->
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Projesi Değerlendirecek Akademisyenler</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <div class="box-body table-responsive p-2">
        <table class="table table-hover">
            <tbody>
                <tr>
                    <th>Sicil No</th>                    
                    <th>Akademisyen Adı</th>
                </tr>
                <?php foreach ($info as $info){ ?>

                <tr>
                    <td><?php echo $info->hocaID; ?></td>                    
                    <td><a href="<?php echo base_url('akademisyen/projeler/'); echo ''.$info->hocaID.'' ?>"><?php echo $info->adiSoyadi; ?></a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">

    </div>
    <!-- /.box-footer-->
</div>
<!-- /.box -->


</section>
<?php $this->load->view('yonetim/include/footerMobil'); ?>
