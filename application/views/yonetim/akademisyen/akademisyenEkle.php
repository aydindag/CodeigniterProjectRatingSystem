<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1 style="float:left;">
            <p>Akademisyen &nbsp; Ekle -&#160;</p>
        </h1>
        <a href="<?php echo base_url('yonetimPaneli/akademisyen') ?>"><button style="width:auto;" type="button" class="btn btn-block btn-default btn-sm">Listeye Dön</button></a>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li class="active">Akademisyen Ekle</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Akademisyen Ekle</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <form method="post" role="form" action="<?php echo base_url('yonetimPaneli/akademisyenEkleButton'); ?>">
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Akademisyen Kodu</label>
                                <input name="hocaKodu" required type="text" class="form-control" id="exampleInputEmail1" placeholder="Akademisyen Kodu">
                            </div>
                            <div class="form-group">
                                <label for="sel1">Ünvan</label>
                                <select name="unvan" class="form-control" id="sel1">
                                    <option value="Prof.Dr.">Prof.Dr.</option>
                                    <option value="Doç.Dr.">Doç.Dr.</option>
                                    <option value="Dr.Öğr.Üyesit">Dr.Öğr.Üyesi</option>
                                    <option value="Arş.Gör.Dr.">Arş.Gör.Dr.</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sel1">Araştırma Görevlisi</label>
                                <select name="AG" class="form-control" id="sel1">
                                    <option value="1">Evet</option>
                                    <option selected value="0">Hayır</option>

                                </select>
                            </div>
                            <div required class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
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
