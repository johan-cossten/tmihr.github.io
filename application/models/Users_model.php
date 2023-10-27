<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    public function verify_and_save()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));

        $profile_picture = '';
        if (!empty($_FILES['profile_picture']['name'])) {
            $config['upload_path']          = './uploads/users/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 500;
            $config['max_width']            = 500;
            $config['max_height']           = 500;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_picture')) {
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
            } else {
                $profile_picture = 'uploads/users/' . $this->upload->data('file_name');
            }
        }

        $query = $this->db->query("SELECT * FROM HR_USERS WHERE USERNAME='$new_user'")->num_rows();
        if ($query > 0) {
            return "This username already exist.";
        }

        $query = $this->db->query("SELECT * FROM HR_USERS WHERE EMAIL='$email'")->num_rows();
        if ($query > 0) {
            return "This Email ID already exist.";
        }

        $pass = md5($pass);
        $CUR_DATE = date("d-m-Y");
        $query1 = "INSERT INTO TMI.HR_USERS(USERNAME,PASSWORD,EMAIL,ROLE_ID, CREATE_DATE,CREATE_BY,CREATE_COMP,STATUS,PROFILE_PICTURE, DEPT) 
		VALUES('$new_user','$pass', '$email', $role_id,  TO_DATE('$CUR_DATE', 'dd/mm/yyyy'), '$cur_name', '$system_name', 1, '$profile_picture', '$dept')";
        if ($this->db->simple_query($query1)) {
            $this->session->set_flashdata('success', 'Success!! New User created Succssfully!!');
            return "success";
        } else {
            // return "failed";
            return $query1;
        }
    }

    public function verify_and_update()
    {
        extract($this->security->xss_clean(html_escape(array_merge($this->data, $_POST))));
        $profile_picture = '';
        if (!empty($_FILES['profile_picture']['name'])) {

            $config['upload_path']          = './uploads/users/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 500;
            $config['max_width']            = 500;
            $config['max_height']           = 500;

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_picture')) {
                $error = array('error' => $this->upload->display_errors());
                print($error['error']);
                exit();
            } else {
                $profile_picture = 'uploads/users/' . $this->upload->data('file_name');
            }
        }


        if (isset($new_user)) {
            $query = $this->db->query("SELECT * FROM HR_USERS WHERE USERNAME='$new_user' and ID<>$q_id")->num_rows();
            if ($query > 0) {
                return "This username already exist.";
            }
        }

        $query = $this->db->query("SELECT * FROM HR_USERS WHERE EMAIL='$email' and ID<>$q_id")->num_rows();
        if ($query > 0) {
            return "This Email ID already exist.";
        }

        if (isset($new_user)) {
            $this->db->set("USERNAME", $new_user);
        }
        if (isset($email)) {
            $this->db->set("EMAIL", $email);
        }
        if (isset($dept)) {
            $this->db->set("DEPT", $dept);
        }
        if (isset($role_id)) {
            $this->db->set("ROLE_ID", $role_id);
        }
        if (isset($profile_picture)) {
            $this->db->set("PROFILE_PICTURE", $profile_picture);
        }
        $this->db->where("ID", $q_id);
        $q1 = $this->db->update("HR_USERS");

        if ($q1) {
            $this->session->set_flashdata('success', 'Success!! User Updated Succssfully!!');
            return "success";
        } else {
            return "failed";
        }
    }

    public function status_update($userid, $status)
    {
        $query1 = "UPDATE TMI.HR_USERS SET STATUS='$status' WHERE ID=$userid";
        if ($this->db->simple_query($query1)) {
            echo "success";
        } else {
            echo "failed";
        }
    }

    public function password_update($currentpass, $newpass, $data)
    {

        $query = $this->db->query("SELECT * FROM HR_USERS WHERE PASSWORD='$currentpass' AND ID=" . $data['cur_userid']);
        if ($query->num_rows() == 1) {

            $query1 = "UPDATE HR_USERS SET PASSWORD='$newpass' WHERE ID=" . $data['cur_userid'];
            if ($this->db->simple_query($query1)) {
                return "success";
            } else {
                return "failed";
            }
        } else {
            return "Invalid Current Password!";
        }
    }
    //Get users deatils
    public function get_details($id)
    {
        $data = $this->data;
        $query = $this->db->query("SELECT * FROM HR_USERS WHERE ID=$id");
        if ($query->num_rows() == 0) {
            show_404();
            exit;
        } else {
            $query = $query->row();
            $data['q_id'] = $query->ID;
            $data['username'] = $query->USERNAME;
            $data['email'] = $query->EMAIL;
            $data['dept'] = $query->DEPT;
            $data['role_id'] = $query->ROLE_ID;
            $data['profile_picture'] = $query->PROFILE_PICTURE;
            $data['pass'] = $query->PASSWORD;
            return $data;
        }
    }

    public function delete_user($id)
    {
        if ($id == 1) {
            echo "Restricted! Can't Delete User Admin!!";
            exit();
        }
        $query1 = "DELETE FROM HR_USERS WHERE ID=$id";
        if ($this->db->simple_query($query1)) {
            echo "success";
            $this->session->set_flashdata('success', 'Success!! User Deleted Succssfully!');
        } else {
            echo "failed";
        }
    }
}
