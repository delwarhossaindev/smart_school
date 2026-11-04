<section class="page-breadcumb-area bg-with-black">
    <div class="container text-center">
        <div class="breadcrumb-content">
            <h2 class="title"><?php echo lang('event'); ?></h2>
            <ul class="links">
                <li><a href="<?php echo site_url($school->branch_url); ?>"><?php echo lang('home'); ?></a></li>
                <li><a href='javascript:void(0);'><?php echo lang('all_event'); ?></a></li>
            </ul>
        </div>
    </div>
</section>

<section class="page-event-area">
    <div class="container">
        <div class="row justify-content-center">
        <?php if(isset($events) && !empty($events)){ ?>
            <?php foreach($events AS $obj){ ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="single-event">
                    <div class="img">
                        <?php if(isset($obj->image) && !empty($obj->image)){ ?>
                            <img src="<?php echo UPLOAD_PATH; ?>event/<?php echo $obj->image; ?>" alt="">
                        <?php }else{ ?>
                            <img src="<?php echo IMG_URL; ?>news-image.jpg" alt="">
                        <?php } ?> 
                    </div>
                    <div class="content">
                        <h2 class="title"><a href="<?php echo site_url($school->branch_url.'/event-detail/'.$obj->id); ?>"><?php echo $obj->title; ?></a></h2>
                        <ul class="list">
                            <li class="info"><span class="icon"><i class="fas fa-user"></i></span><?php echo $obj->event_for ? $obj->event_for : lang('all'); ?> (<?php echo lang('event_for'); ?>)</li>
                            <li class="info"><span class="icon"><i class="far fa-calendar-alt"></i></span><?php echo date(ci()->global_setting->date_format, strtotime($obj->event_from)); ?> (<?php echo lang('start_date'); ?>)</li>
                            <li class="info"><span class="icon"><i class="far fa-calendar-alt"></i></span><?php echo date(ci()->global_setting->date_format, strtotime($obj->event_to)); ?> (<?php echo lang('end_date'); ?>)</li>
                            <li class="info"><span class="icon"><i class="fas fa-map-marker-alt"></i></span><?php echo $obj->event_place; ?></li>
                        </ul>
                        <div class="more text-center">
                            <a href="<?php echo site_url($school->branch_url.'/event-detail/'.$obj->id); ?>" class="link glbscl-link-btn hvr-bs"><?php echo lang('read_more'); ?></a>
                        </div>
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