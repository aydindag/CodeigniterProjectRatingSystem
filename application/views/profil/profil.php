<?php $this->load->view('yonetim/include/header'); ?>
<?php $this->load->view('yonetim/include/sidebar'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            User Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url('yonetimPaneli') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="<?php echo base_url('Profil/profilPaneli/index') ?>">Profile</a></li>
            <li class="active">User profile</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="<?php echo base_url('assets\upload\profile/').$inf->profilFoto ?>" alt="User profile picture">

                        <h3 class="profile-username text-center">
                            <?php echo $inf->adiSoyadi; ?>
                        </h3>

                        <p class="text-muted text-center">
                            <?php echo $inf->kullaniciAdi; ?>
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
                            <?php if($inf->egitim==''){
                                        echo "No data entered.";    
                                    }else{
                                        echo $inf->egitim;    
                                    }

                            ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">
                            <?php echo $inf->location; ?>
                        </p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                            <span class="label label-success"><?php echo $inf->yetenek; ?></span>
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
                        <li class="active"><a href="#settings" data-toggle="tab">Settings</a></li>
                        <li ><a href="#pp" data-toggle="tab">Profil Photo</a></li>
                    </ul>
                    <!-- flash message here -->
                    <?php if(isset($hataKontrol)){ ?>
                        <div style="margin-top:10px;margin-left:15px;margin-right:15px;" class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Error</h4>
                             <?php echo $hataKontrol['hata']; ?>
                        </div>
                    <?php } ?>
                    <?php echo $this->session->flashdata('ekleBasari'); ?> <br>
                    <div class="tab-content">
                        <div class="active tab-pane" class="tab-pane" id="settings">
                            <form method="post" class="form-horizontal" action="<?php echo base_url('Profil/profilPaneli/profilGuncelle') ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" required class="form-control" value="<?php echo $inf->adiSoyadi; ?>" name="name" id="inputName" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="mail" required class="form-control" value="<?php echo $inf->email; ?>" name="mail" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">User Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" readonly required class="form-control" value="<?php echo $inf->kullaniciAdi; ?>" name="username" id="inputName" placeholder="User Name">
                                    </div>
                                </div>
			        <div class="form-group">
                                    <label for="inputName" class="col-sm-2 control-label">Şifre</label>
                                    <div class="col-sm-10">
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" id="txt_sifre" required class="form-control" value="<?php echo $inf->sifre; ?>" name="sifre" id="inputName" placeholder="User Name">
                                            <div class="input-group-addon">
                                                <i class="fa fa-eye-slash" aria-hidden="true" onclick="togglePassword()" ></i>
                                            </div>
                                        </div>
                                        <small>- Şifreniz en az 6 karakten oluşmalı.</small>
                                        <br>
                                        <small>- Şifrenizde en az bir harf bir rakam bulunmalı.</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputExperience" class="col-sm-2 control-label">Education</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" name="Education" id="inputExperience" placeholder="Experience"> <?php echo $inf->egitim; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Location</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php echo $inf->location; ?>" name="location" id="inputSkills" placeholder="Locations">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSkills" class="col-sm-2 control-label">Skills</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="skills" value="<?php echo $inf->yetenek; ?>" class="form-control" id="inputSkills" placeholder="Skills">
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                          <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                        </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" class="tab-pane" id="pp">
                            <form method="post" class="form-horizontal" action="<?php echo base_url('Profil/profilPaneli/profilFotoGuncelle') ?>" enctype="multipart/form-data">
                                <div class="form-group">
                                    <?php echo form_open_multipart('profilPaneli/do_upload');?>
                                    <label for="inputSkills" class="col-sm-2 control-label">Profil Photo</label>
                                    <div class="col-sm-10" style="margin-top:5px;">
                                        <input class="form-control-file" id="exampleFormControlFile1" type="file" name="userfile" size="20" />
                                        <span>Max 2MB and JPG,PNG</span>
                                    </div>
                                </div>                                
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                    </div>
                                </div>
                            </form>
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
