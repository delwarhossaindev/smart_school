<table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
    <tbody>
        <tr>
            <th><?php echo lang('branch_name'); ?></th>
            <td colspan="3"><?php echo $lecture->branch_name; ?></td>
        </tr>
        <tr>
            <th><?php echo lang('lecture_type'); ?></th>
            <td><?php echo lang($lecture->lecture_type); ?></td>
            <th><?php echo lang('title'); ?></th>
            <td><?php echo $lecture->lecture_title; ?></td>        
        </tr>
        <tr>
            <th><?php echo lang('class'); ?></th>
            <td><?php echo $lecture->class_name; ?></td>       
            <th><?php echo lang('section'); ?></th>
            <td><?php echo $lecture->section; ?></td>
        </tr>  
        <tr>
            <th><?php echo lang('subject'); ?></th>
            <td><?php echo $lecture->subject; ?></td>
            <th><?php echo lang('teacher'); ?></th>
            <td><?php echo $lecture->teacher; ?></td>       
        </tr>  
        <tr>   
            <th><?php echo lang('class_lecture'); ?></th>
            <td colspan="3">
                <?php if($lecture->lecture_type == 'power_point' && $lecture->lecture_ppt != ''){ ?>
                    <a target="_blank" href="<?php echo UPLOAD_PATH; ?>video-lecture/<?php echo $lecture->lecture_ppt; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a>
               <?php }else if($lecture->lecture_type == 'youtube' && $lecture->video_id != ''){ ?>
                    <iframe class="youtube-player" type="text/html" style="width:100%; height:350px;" height="350"
                       src="http://www.youtube.com/embed/<?php echo $lecture->video_id; ?>" frameborder="0">
                    </iframe>
               <?php }else if($lecture->lecture_type == 'vimeo' && $lecture->video_id != ''){ ?>
                    
                    <iframe src="https://player.vimeo.com/video/<?php echo $lecture->video_id; ?>" style="width:100%; height:350px;" height="350" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    <script src="https://player.vimeo.com/api/player.js"></script>
                    <script>
                    <!- Your Vimeo SDK player script goes here ->
                    </script>
                    
               <?php } ?>                    
                    
            </td>
        </tr> 
        <tr>
            <th><?php echo lang('note'); ?></th>
            <td><?php echo $lecture->note; ?>   </td>       
            <th><?php echo lang('created'); ?></th>
            <td><?php echo date(ci()->global_setting->date_format, strtotime($lecture->created_at)); ?></td>
        </tr>
    </tbody>
</table>
