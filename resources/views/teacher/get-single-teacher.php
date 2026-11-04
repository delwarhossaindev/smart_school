<div class="" data-example-id="togglable-tabs">
    <ul  class="nav nav-tabs bordered">
        <li class="active"><a href="#tab_basic_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-info-circle"></i> <?php echo lang('profile'); ?></a> </li>
        <li class=""><a href="#tab_social_info"   role="tab" data-toggle="tab" aria-expanded="true"><i class="fa fa-share"></i> <?php echo lang('social_link'); ?></a> </li>
    </ul>
    <br/>
    
     <div class="tab-content">
        <div  class="tab-pane fade in active" id="tab_basic_info" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                        <th width="20%"><?php echo lang('branch_name'); ?></th>
                        <td width="30%"><?php echo $teacher->branch_name; ?></td>        
                        <th width="20%"><?php echo lang('username'); ?></th>
                        <td width="30%"><?php echo $teacher->username; ?></td>        
                    </tr>
                    <tr>
                        <th><?php echo lang('name'); ?></th>
                        <td><?php echo $teacher->name; ?></td>        
                        <th><?php echo lang('responsibility'); ?></th>
                        <td><?php echo $teacher->responsibility; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('national_id'); ?></th>
                        <td><?php echo $teacher->national_id; ?></td>        
                        <th><?php echo lang('phone'); ?></th>
                        <td><?php echo $teacher->phone; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('present_address'); ?></th>
                        <td><?php echo $teacher->present_address; ?></td>        
                        <th><?php echo lang('permanent_address'); ?></th>
                        <td><?php echo $teacher->permanent_address; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('gender'); ?></th>
                        <td><?php echo lang($teacher->gender); ?></td>        
                        <th><?php echo lang('blood_group'); ?></th>
                        <td><?php echo lang($teacher->blood_group); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('religion'); ?></th>
                        <td><?php echo $teacher->religion; ?></td>        
                        <th><?php echo lang('birth_date'); ?></th>
                        <td><?php echo date(ci()->global_setting->date_format, strtotime($teacher->dob)); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('join_date'); ?></th>
                        <td><?php echo date(ci()->global_setting->date_format, strtotime($teacher->joining_date)); ?></td>        
                        <th><?php echo lang('role'); ?></th>
                        <td><?php echo $teacher->role; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('salary_grade'); ?></th>
                        <td><?php echo $teacher->grade_name; ?></td>        
                        <th><?php echo lang('salary_type'); ?></th>
                        <td><?php echo lang($teacher->salary_type); ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('email'); ?></th>
                        <td><?php echo $teacher->email; ?></td>        
                        <th><?php echo lang('other_info'); ?></th>
                        <td><?php echo $teacher->other_info; ?></td>
                    </tr>

                    <tr>
                        <th><?php echo lang('photo'); ?></th>
                        <td>
                        <?php if($teacher->photo){ ?>
                            <img class="detail-img" src="<?php echo UPLOAD_PATH; ?>teacher-photo/<?php echo $teacher->photo; ?>" alt="" width="70" />
                        <?php } ?>
                        </td>        
                        <th><?php echo lang('resume'); ?></th>
                        <td>
                        <?php if($teacher->resume){ ?>
                            <a target="_blank" href="<?php echo UPLOAD_PATH; ?>teacher-resume/<?php echo $teacher->resume; ?>" class="btn btn-success btn-xs"><i class="fa fa-download"></i> <?php echo lang('download'); ?></a>
                        <?php } ?>
                        </td>
                    </tr>                    
                </tbody>
            </table>

        </div>
        <div  class="tab-pane fade in " id="tab_social_info" > 
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <tbody>
                    
                    <tr>
                        <th><?php echo lang('facebook_url'); ?></th>
                        <td><?php echo $teacher->facebook_url; ?></td>        
                        <th><?php echo lang('linkedin_url'); ?></th>
                        <td><?php echo $teacher->linkedin_url; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('twitter_url'); ?></th>
                        <td><?php echo $teacher->twitter_url; ?></td>        
                        <th><?php echo lang('youtube_url'); ?></th>
                        <td><?php echo $teacher->youtube_url; ?></td>   
                    </tr>
                    <tr>
                        <th><?php echo lang('instagram_url'); ?></th>
                        <td><?php echo $teacher->instagram_url; ?></td>        
                        <th><?php echo lang('pinterest_url'); ?></th>
                        <td><?php echo $teacher->pinterest_url; ?></td>
                    </tr>
                    <tr>
                        <th><?php echo lang('is_view_on_web'); ?></th>
                        <td colspan="3"><?php echo $teacher->is_view_on_web ? lang('yes') : lang('no'); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
     </div>
</div>