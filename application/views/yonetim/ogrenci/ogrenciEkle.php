<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Öğrenci &nbsp; Ekle -&#160;</p>
        </h1>
        <a href="<?php echo base_url('yonetimPaneli/ogrenciListesi') ?>"><button style="width:auto;" type="button" class="btn btn-block btn-default btn-sm">Listeye Dön</button></a>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Öğrenci Ekle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Öğrenci Ekle</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="<?php echo base_url('yonetimPaneli/ogrenciEkleButton'); ?>">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ad Soyad</label>
                                <input name="adsoyad" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Ad Soyad">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kullanıcı Adı</label>
                                <input name="kadi" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Kullanıcı Adı">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">E-Mail</label>
                                <input name="mail" required type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                            </div>
                            <div required class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Öğrenci Numarası</label>
                                <input name="ogrNo" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Öğrenci Numarası">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Şube</label>
                                <input name="sube" required type="text" class="form-control" id="exampleInputEmail1" placeholder="sube">
                            </div>
                            <div class="form-group">
                              <label>Danışman</label>
                              <select name="danismanid" class="form-control">
                                <?php foreach($bilgi as $bilgi){ ?>
                                <option value="<?php echo $bilgi->hocaID ?>"><?php echo $bilgi->adiSoyadi ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Proje Kodu</label>
                                <input name="projeKodu" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Proje Kodu">
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
