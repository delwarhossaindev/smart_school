<!DOCTYPE html>
<html lang="en">
    <head>  
        <title><?php echo $title_for_layout; ?></title>
        <?php if(ci()->global_setting->favicon_icon){ ?>
            <link rel="icon" href="<?php echo UPLOAD_PATH; ?>logo/<?php echo ci()->global_setting->favicon_icon; ?>" type="image/x-icon" />             
        <?php }else{ ?>
            <link rel="icon" href="<?php echo IMG_URL; ?>favicon.ico" type="image/x-icon" />
        <?php } ?>
        
       <!-- ZOOM CSS -->     
        <link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.6/css/react-select.css"/>
            
        <!-- Bootstrap -->
        <link href="<?php echo VENDOR_URL; ?>bootstrap/bootstrap.min.css" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link href="<?php echo VENDOR_URL; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
    
        <link href="<?php echo CSS_URL; ?>custom.css" rel="stylesheet">
       
        
        <?php if(ci()->session->userdata('theme')){ ?>
            <link href="<?php echo CSS_URL; ?>theme/<?php echo ci()->session->userdata('theme'); ?>.css" rel="stylesheet">
        <?php }else{ ?>
            <link href="<?php echo CSS_URL; ?>theme/jazzberry-jam.css" rel="stylesheet">
        <?php } ?>
            
            <style type="text/css">
                body,.right_col {                   
                    margin-left: 0px !important;
                    background: #f7f7f7;
                }
                .school-name {
                    font-size: 25px;
                    text-align: center;
                    padding-top: 5px;
                    padding-bottom: 15px;
                    font-weight: bolder;
                }
                .nav_menu {
                    background: linear-gradient(#df1067, #403e49), #df1067;
                }
                .main_container .top_nav {
                    display: block;
                    margin-left: 0px;
                    position: relative;
                }
                footer {                   
                    margin-left: 0px;  
                    background: linear-gradient(#df1067, #403e49), #df1067;
                    
                }
                .pull-right {
                    float: none!important;
                    text-align: center;
                }
                .class-note{
                    padding: 25px;
                    padding-left: 25%;
                    color: #000;
                    margin: 0;
                }
                .note-data{
                    padding: 5px 20px;
                    background: white;
                    border-radius: 20px;
                }
            </style>

    </head>
    
     <body class="nav-md">      
             
        <div class="container body">
            <div class="main_container">                 
                <!-- top navigation -->
                <div class="top_nav">
                    <div class="nav_menu">
                        <nav>            
                            <div class="col-md-12">
                                <div class="school-name">
                                    <?php if (ci()->session->userdata('role_id') != SUPER_ADMIN) { ?>
                                        <?php echo ci()->session->userdata('branch_name'); ?>
                                    <?php } else { ?>
                                        <?php echo ci()->global_setting->brand_title ? ci()->global_setting->brand_title : SMS; ?>
                                    <?php } ?>
                                </div>
                            </div> 
                            <div class="row  class-note">
                                <div class="col-md-6">
                                    <span class="note-data">
                                        <strong><?php echo lang('class'); ?> : </strong> <?php echo $live_class->class_name; ?>,
                                        <strong><?php echo lang('section'); ?> : </strong> <?php echo $live_class->section; ?>                                        
                                    </span>
                                </div>
                                <div class="col-md-6">
                                    <span class="note-data">
                                        <strong><?php echo lang('teacher'); ?> : </strong> <?php echo $live_class->teacher; ?>,
                                        <strong><?php echo lang('subject'); ?> : </strong> <?php echo $live_class->subject; ?>
                                    </span>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>  
                <!-- /top navigation -->
                <div class="right_col" role="main" >                  
                    <div style="text-align: center;"><img src="<?php echo IMG_URL; ?>loading.gif" /></div>
                </div>                
            </div>
        </div>
        
       
        <script src="https://source.zoom.us/1.7.6/lib/vendor/react.min.js"></script>
        <script src="https://source.zoom.us/1.7.6/lib/vendor/react-dom.min.js"></script>
        <script src="https://source.zoom.us/1.7.6/lib/vendor/redux.min.js"></script>
        <script src="https://source.zoom.us/1.7.6/lib/vendor/redux-thunk.min.js"></script>
        <script src="https://source.zoom.us/1.7.6/lib/vendor/jquery.min.js"></script>
        <script src="https://source.zoom.us/1.7.6/lib/vendor/lodash.min.js"></script>
        <script src="https://source.zoom.us/zoom-meeting-1.7.8.min.js"></script>
       
        <script type="text/javascript">
             
            ZoomMtg.preLoadWasm();
            ZoomMtg.prepareJssdk();
            var meetConfig = {
                apiKey: "<?php echo $api_info->zoom_api_key; ?>",
                apiSecret: "<?php echo $api_info->zoom_secret; ?>",
                meetingNumber: "<?php echo $live_class->meeting_id; ?>",
                userName: "<?php echo ci()->session->userdata('name'); ?>",
                passWord: "<?php echo $live_class->meeting_password; ?>",
                leaveUrl: "<?php echo site_url('academic/liveclass/index/'.$live_class->class_id); ?>",
                role: parseInt(1, 10)
            };
            var signature = ZoomMtg.generateSignature({
                meetingNumber: meetConfig.meetingNumber,
                apiKey: meetConfig.apiKey,
                apiSecret: meetConfig.apiSecret,
                role: meetConfig.role,
                success: function(res){
                    console.log(res.result);
                }
            });
            ZoomMtg.init({
                leaveUrl: meetConfig.leaveUrl,
                isSupportAV: true,
                success: function () {
                    ZoomMtg.join(
                        {
                            meetingNumber: meetConfig.meetingNumber,
                            userName: meetConfig.userName,
                            signature: signature,
                            apiKey: meetConfig.apiKey,
                            passWord: meetConfig.passWord,
                            success: function(res){
                               // $('.main_container').hide();
                               //  $('.footer').hide();
                            },
                            error: function(res) {
                                console.log(res);
                            }
                        }
                    );
                },
                error: function(res) {
                    console.log(res);
                }
            });
        </script>    
       
</body>
</html>