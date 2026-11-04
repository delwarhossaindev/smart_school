<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo lang('login') . ' | ' . SMS; ?></title>

        <?php if (ci()->global_setting->favicon_icon) { ?>
            <link rel="icon" href="<?php echo UPLOAD_PATH; ?>logo/<?php echo ci()->global_setting->favicon_icon; ?>" type="image/x-icon" />             
        <?php } else { ?>
            <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <?php } ?>

        <!-- Bootstrap -->
        <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">     
        <!-- Custom Theme Style -->
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">

        <!-- jQuery -->
        <script src="<?php echo JS_URL; ?>jquery-1.11.2.min.js"></script>
        <?php ci()->load->view('layout/login-css'); ?>  

     <script src="https://www.google.com/recaptcha/api.js" async defer></script>
     <script>
       function onSubmit(token) {
         document.getElementById("demo-form").submit();
       }
     </script>        

    </head>

    <body class="login"> 


        <div class="login_wrapper">
            <section>
                <center>
                    <?php  if(UPLOAD_PATH.'logo/'.ci()->global_setting->brand_logo){ ?>
                    <img  src="<?php echo UPLOAD_PATH.'logo/'.ci()->global_setting->brand_logo; ?>" class="login-logo" alt="">
                    <?php }else{ ?>
                        <img  src="<?php echo IMG_URL; ?>sms-logo.png" class="login-logo">
                    <?php } ?>    
                </center>
            </section>
            <?php echo form_open(site_url('auth/index'), array('name' => 'login', 'id' => 'login'), ''); ?>
            <div class="form login_form">
                <section><h1 class="text-center"><?php echo lang('login'); ?></h1></section>    
                <section class="login_content">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <p class="red" style="color:#fff;"><?php echo ci()->session->userdata('error'); ?></p>
                        <p class="green" style="color:#fff;"><?php echo ci()->session->userdata('success'); ?></p>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="text" name="username" class="form-control has-feedback-left" placeholder="<?php echo lang('username'); ?>">
                        <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 form-group has-feedback">
                        <input type="password" name="password" class="form-control has-feedback-left" placeholder="<?php echo lang('password'); ?>">
                        <span class="fa fa-asterisk form-control-feedback left" aria-hidden="true"></span>
                    </div>                    

                    <div class="col-md-6 col-sm-5 col-xs-5_">
                        <!--<button class="g-recaptcha btn btn-primary login-button" data-sitekey="6LcWPMcZAAAAADH-TtiWW0gnLawkfsdwml86Fcrt" data-callback='onSubmit'><?php echo lang('login'); ?></button>-->
                        <input  class="btn btn-primary login-button" type="submit" name="submit" value="<?php echo lang('login'); ?>"/>
                    </div>
                    <div class="col-md-6 col-sm-7 col-xs-7_">
                        <a class="reset_pass btn btn-primary login-button" href="<?php echo site_url('auth/forgot') ?>"><?php echo lang('lost_your_password'); ?></a>
                    </div>
                    
                    <div class="clearfix"></div>                        
                </section>               
            </div>            
            <?php echo form_close(); ?>
        </div>
        <section style="display: none;">
            <div class="col-md-12 col-sm-12 text-center col-xs-12">
                <a class="btn btn-success  demo-note" href="#">
                    For Demo Login Please Click Below...
                </a>
            </div>
        </section>
        <section>
            <center>
                <div class="col-md-12 col-sm-12 text-center col-xs-12">
                    <div class="btn-group" role="group" aria-label="...">
                        <button class="btn btn-sm btn-warning demo-button login-button"" id="superadmin">Super Admin</button>                    
                    </div>
                </div>
            </center>
        </section>
        <section style="width: 90%; margin: 0 auto; clear: right;padding-top: 50px;">           
            <div class="row">
                <div class="col-md-5 col-sm-5 text-center col-xs-12">
                    <div class=" btn-sm btn-info demo-button" style="float: right;background: black;">Windsor Park School - London Campus</div>
                </div>
                <div class="col-md-7 col-sm-7 text-center col-xs-12">
                    <div class="btn-group" role="group" aria-label="School-1" style="float: left;">
                        <button class="btn btn-sm btn-info demo-button" id="admin">Admin</button>
                        <button class="btn btn-sm btn-danger demo-button" id="guardian">Guardian</button>
                        <button class="btn btn-sm btn-success demo-button" id="student">Student</button>
                        <button class="btn btn-sm btn-warning demo-button" id="teacher">Teacher</button>
                        <button class="btn btn-sm btn-info demo-button" id="accountant">Accountant</button>
                        <button class="btn btn-sm btn-danger demo-button" id="librarian">Librarian</button>
                        <button class="btn btn-sm btn-success demo-button" id="receptionist">Receptionist</button>
                        <button class="btn btn-sm btn-default demo-button" id="staff">Staff</button>
                    </div>
                </div>    
            </div>        
        </section>
        <section style="width: 90%; margin: 0 auto; text-align: center">             
            <div class="row">
                <div class="col-md-5 col-sm-5 text-center col-xs-12">
                    <div class="btn-sm btn-info demo-button" style="float: right;background: black;">Windsor Park School - Liverpool Campus</div>
                </div>
                <div class="col-md-7 col-sm-7 text-center col-xs-12">
                    <div class="btn-group" role="group" aria-label="School-2" style="float: left;">                    
                        <button class="btn btn-sm btn-info demo-button" id="admin2">Admin</button>
                        <button class="btn btn-sm btn-danger demo-button" id="guardian2">Guardian</button>
                        <button class="btn btn-sm btn-success demo-button" id="student2">Student</button>
                        <button class="btn btn-sm btn-warning demo-button" id="teacher2">Teacher</button>
                        <button class="btn btn-sm btn-info demo-button" id="accountant2">Accountant</button>
                        <button class="btn btn-sm btn-danger demo-button" id="librarian2">Librarian</button>
                        <button class="btn btn-sm btn-success demo-button" id="receptionist2">Receptionist</button>
                        <button class="btn btn-sm btn-default demo-button" id="staff2">Staff</button>
                    </div>
                </div>
            </div>
        </section>
        <script type="text/javascript">

            $('#superadmin').click(function () {
                $("input[name=username]").val('superadmin');
                $("input[name=password]").val('123456');
            });

            $('#admin').click(function () {
                $("input[name=username]").val('admin');
                $("input[name=password]").val('123456');
            });
            $('#guardian').click(function () {
                $("input[name=username]").val('guardian');
                $("input[name=password]").val('123456');
            });
            $('#student').click(function () {
                $("input[name=username]").val('student');
                $("input[name=password]").val('123456');
            });
            $('#teacher').click(function () {
                $("input[name=username]").val('teacher');
                $("input[name=password]").val('123456');
            });
            $('#accountant').click(function () {
                $("input[name=username]").val('accountant');
                $("input[name=password]").val('123456');
            });
            $('#librarian').click(function () {
                $("input[name=username]").val('librarian');
                $("input[name=password]").val('123456');
            });
            $('#receptionist').click(function () {
                $("input[name=username]").val('receptionist');
                $("input[name=password]").val('123456');
            });
            $('#staff').click(function () {
                $("input[name=username]").val('staff');
                $("input[name=password]").val('123456');
            });


            $('#admin2').click(function () {
                $("input[name=username]").val('admin2');
                $("input[name=password]").val('123456');
            });
            $('#guardian2').click(function () {
                $("input[name=username]").val('guardian2');
                $("input[name=password]").val('123456');
            });
            $('#student2').click(function () {
                $("input[name=username]").val('student2');
                $("input[name=password]").val('123456');
            });
            $('#teacher2').click(function () {
                $("input[name=username]").val('teacher2');
                $("input[name=password]").val('123456');
            });
            $('#accountant2').click(function () {
                $("input[name=username]").val('accountant2');
                $("input[name=password]").val('123456');
            });
            $('#librarian2').click(function () {
                $("input[name=username]").val('librarian2');
                $("input[name=password]").val('123456');
            });
            $('#receptionist2').click(function () {
                $("input[name=username]").val('receptionist2');
                $("input[name=password]").val('123456');
            });
            $('#staff2').click(function () {
                $("input[name=username]").val('staff2');
                $("input[name=password]").val('123456');
            });

        </script>
    </body>
</html>
