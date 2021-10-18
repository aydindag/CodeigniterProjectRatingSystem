<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Akademisyen &nbsp; Güncelle -&#160;</p>
        </h1>
        <a href="<?php echo base_url('yonetimPaneli/akademisyen') ?>"><button style="width:auto;" type="button" class="btn btn-block btn-default btn-sm">Listeye Dön</button></a>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Akademisyen Güncelle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Akademisyen Güncelle</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="<?php echo base_url('yonetimPaneli/akademisyenGuncelleButton/'); echo ''.$inf->ID.'' ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ad Soyad</label>
                                <input name="adsoyad" value="<?php echo $inf->adiSoyadi ?>" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kullanıcı Adı</label>
                                <input name="kadi" value="<?php echo $inf->kullaniciAdi ?>" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail</label>
                                <input name="mail" value="<?php echo $inf->email ?>" required type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="sel1">Ünvan</label>
                                <select name="unvan" class="form-control" id="sel1">
                                <option selected value="<?php echo $inf->unvan ?>"><?php echo $inf->unvan ?></option>
                                <option value="Profesör">Profesör</option>
                                <option value="Doçent">Doçent</option>
                                <option value="Yardımcı Doçent">Yardımcı Doçent</option>    
                                <option value="Araştırma Görevlisi">Araştırma Görevlisi</option>
                              </select>
                            </div>
                            <div required class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" value="<?php echo $inf->sifre ?>" type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
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

<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
