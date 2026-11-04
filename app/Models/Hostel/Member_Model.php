<?php

namespace App\Models\Hostel;




class Member_Model extends \App\Legacy\MY_Model {
    
    function __construct() {
        parent::__construct();
    }
    
     public function get_hostel_member_list($is_hostel_member = 1, $branch_id = null, $class_id = null) {

        
        $this->db->select('ST.*,SC.branch_name, HM.id AS hm_id, H.name AS hostel_name, R.room_no, R.room_type, R.cost, E.roll_no, C.name AS class_name, S.name AS section');
        $this->db->from('students AS ST');
        $this->db->join('enrollments AS E', 'E.student_id = ST.id', 'left');
        $this->db->join('classes AS C', 'C.id = E.class_id', 'left');
        $this->db->join('sections AS S', 'S.id = E.section_id', 'left');
        $this->db->join('hostel_members AS HM', 'HM.user_id = ST.user_id', 'left');
        $this->db->join('hostels AS H', 'H.id = HM.hostel_id', 'left');
        $this->db->join('rooms AS R', 'R.id = HM.room_id', 'left');
        $this->db->join('schools AS SC', 'SC.id = ST.branch_id', 'left');
        
        //if($class_id){
            $this->db->where('E.class_id', $class_id);   
        //}
        
        $this->db->where('E.academic_year_id', $this->academic_year_id);
       
        
        if(!$is_hostel_member){
             $this->db->where('ST.status_type', 'regular');
        } 
        $this->db->where('ST.is_hostel_member', $is_hostel_member);
        
        if($this->session->userdata('role_id') != SUPER_ADMIN){
            $this->db->where('ST.branch_id', $this->session->userdata('branch_id'));
        }
        
        if($this->session->userdata('role_id') == GUARDIAN){
           $this->db->where('ST.guardian_id', $this->session->userdata('profile_id'));
        }
        
        if($this->session->userdata('role_id') == SUPER_ADMIN && $branch_id){
            $this->db->where('ST.branch_id', $branch_id);
        }         
        $this->db->where('ST.status_type', 'regular');
        $this->db->order_by('HM.id', 'DESC');
        
        if($is_hostel_member){
            $this->db->group_by('HM.user_id', 'DESC');
        }else{
            $this->db->group_by('E.student_id', 'DESC');
        }
        
        return $this->db->get()->result();
    }
}
