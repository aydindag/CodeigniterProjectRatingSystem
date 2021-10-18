<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Kullanıcı Profili
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('yonetimPaneli') ?>"><i class="fa fa-dashboard"></i> Ana Sayfa</a></li>
            <li><a href="<?php echo base_url('Profil/profilPaneli/index') ?>">Profil</a></li>
            <li class="active">Kullanıcı Profili</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image // sol panel -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets\upload\profile/').$ogrenci->profilFoto ?>" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            <?php echo $ogrenci->adiSoyadi; ?>
                        </h3>

                        <p class="text-muted text-center">
                            <?php echo $ogrenci->kullaniciAdi; ?>
                        </p>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                        <p class="text-muted">
                            <?php if($ogrenci->egitim==''){
                                echo "No data entered.";
                            }else{
                                echo $ogrenci->egitim;
                            }

                            ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">
                            <?php echo $ogrenci->location; ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                            <span class="label label-success"><?php echo $ogrenci->yetenek; ?></span>
                        </p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Profil Bilgisi</a></li>
                    </ul>
                    <!-- flash message here -->
                    <?php echo $this->session->flashdata('ekleBasari'); ?> <br>
                    <div class="tab-content">
                        <div class="active tab-pane" class="tab-pane" id="settings">
                            <table class="table table-hover table-striped">
                                <tr>
                                    <th>Adı</th>
                                    <td><?php echo $ogrenci->adiSoyadi; ?></td>
                                </tr>
                                <tr>
                                    <th>Numara</th>
                                    <td><?php echo $ogrenci->ogrNo; ?></td>
                                </tr>
                                <tr>
                                    <th>Şifre</th>
                                    <td>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" id="txt_sifre" required class="form-control" value="<?php echo $ogrenci->sifre; ?>" name="sifre" id="inputName" placeholder="Şifre Girilmemiş">

                                            <div class="input-group-addon">
                                                <i class="fa fa-eye-slash" aria-hidden="true" onclick="togglePassword()" ></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Danışman Adı</th>
					<?php if($hoca){ ?>
                                    <td><?php echo $hoca->adiSoyadi; ?></td>
					<?php } ?>
                                </tr>
                                <tr>
                                    <th>Proje Kodu</th>
                                    <td><?php echo $ogrenci->projeKodu; ?></td>
                                </tr>
                                <tr>
                                    <th>Proje Adı</th>
                                    <td><?php echo $ogrenci->projeAdi; ?></td>
                                </tr>


                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<script>
    <!--Burada txt_sifre alanına yazılan şifrenin icon a basılınca göster gizle yapması için yazdık-->
    function togglePassword() {
        var element = document.getElementById('txt_sifre');
        element.type = (element.type == 'password' ? 'text' : 'password');
    }
</script>



<?php $this->load->view('yonetim/include/footer'); ?>
<?php $this->load->view('yonetim/include/controlSidebar'); ?>
