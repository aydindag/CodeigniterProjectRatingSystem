<?php $this->load->view('yonetim/include/headerMobil'); ?>

<!-- Default box -->
<?php echo $this->session->flashdata('ekleBasari'); ?>

<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Add Project</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="" data-original-title="Remove">
                <i class="fa fa-times"></i></button>
        </div>
    </div>
    <form role="form" method="post" action="<?php echo base_url('Akademisyen/home/projeEkleButton'); ?>" enctype="multipart/form-data">

        <div class="box-body table-responsive p-2">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Proje Adı</label>
                <div class="col-sm-12">
                    <div class="form-group">
                        <input name="projeAdi" type="text" class="form-control">
                    </div>
                </div>
            </div> 
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <button type="submit" class="btn btn-primary btn-flat">Ekle</button>
        </div>
    </form>
    <!-- /.box-footer-->
</div>
<!-- /.box -->
</section>
<?php $this->load->view('yonetim/include/footerMobil'); ?>
