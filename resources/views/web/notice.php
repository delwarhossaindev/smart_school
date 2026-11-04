<section class="page-breadcumb-area bg-with-black">
    <div class="container text-center">
        <div class="breadcrumb-content">
            <h2 class="title"><?php echo lang('notice'); ?></h2>
            <ul class="links">
                <li><a href="<?php echo site_url($school->branch_url); ?>"><?php echo lang('home'); ?></a></li>
                <li><a href="javascript:void(0);"><?php echo lang('all_notice'); ?></a></li>
            </ul>
        </div>
    </div>
</section>

<section class="page-notice-area">
    <div class="container">
        <div class="row">
         <?php if(isset($notices) && !empty($notices)){ ?>
            <?php foreach($notices AS $obj){ ?>
            <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                <div class="single-notice">
                    <h2 class="title"><a href="<?php echo site_url($school->branch_url.'/notice-detail/'.$obj->id); ?>"><?php echo $obj->title; ?></a></h2>                    
                    <ul class="meta">
                        <li class="info"><span class="icon"><i class="fas fa-user"></i></span> <?php echo lang('by'); ?> / <?php echo $obj->name; ?></li>
                        <li class="info"><span class="icon"><i class="far fa-calendar-alt"></i></span> <?php echo date(ci()->global_setting->date_format, strtotime($obj->date)); ?></li>
                    </ul>
                    <ul class="meta">
                        <li class="info"><span class="icon"><i class="fas fa-users"></i></span> <?php echo lang('notice_for'); ?>: <?php echo $obj->notice_for ? $obj->notice_for : lang('all'); ?></li>
                    </ul>
                    <div class="text"><?php echo strip_tags(substr($obj->notice, 0, 170)); ?> ...</div>
                    <div class="more text-right">
                        <a href="<?php echo site_url($school->branch_url.'/notice-detail/'.$obj->id); ?>" class="link glbscl-link-btn hvr-bs"><?php echo lang('read_more'); ?></a>
                    </div>
                </div>
            </div>  
           <?php } ?> 
        <?php }else{ ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <p class="text-center"><strong><?php echo lang('no_data_found'); ?></strong></p>
            </div>
        <?php } ?>   
        </div>
    </div>
</section>
