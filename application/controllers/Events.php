<?php

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Events extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_model');
        $this->userdata = $this->session->userdata('logged_in');
    }

    public function listEvents() {
        $allappointment = $this->Event_model->EventDataAll($this->userdata['user_type'] == 'Manager'?$this->userdata['login_id']:0);
        $data['appointmentdata'] = $allappointment;
        $this->load->view('Appointment/appointmentSetting', $data);
    }

    public function deleteEvent($aid) {
        $this->db->where('aid', $aid);
        $query = $this->db->delete('events');
        redirect('Events/listEvents');
    }

    public function editEvent($appId) {
        $eventData = $this->Event_model->EventData($appId);
        $data['eventData'] = $eventData;
        $appointment_r = $eventData['appointment'];

        $file_newname = "";
        if (!empty($_FILES['picture']['name'])) {
            $config['upload_path'] = 'assets/media';
            $config['allowed_types'] = '*';
            $temp1 = rand(100, 1000000);
            $ext1 = explode('.', $_FILES['picture']['name']);
            $ext = strtolower(end($ext1));
            $file_newname = $temp1 . "1." . $ext;
            $config['file_name'] = $file_newname;
            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if ($this->upload->do_upload('picture')) {
                $uploadData = $this->upload->data();
                $picture = $uploadData['file_name'];

                $data = array("image" => $file_newname);
                $this->db->set($data);
                $this->db->where("aid", $appId);
                $this->db->update('events', $data);
                redirect("Events/editEvent/$appId");
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }


        if (isset($_POST['set_date'])) {
            $this->db->delete('events', array('aid' => $appId));
            $appointmentdata = $eventData['appointment'];
            $from_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $date_from = $from_date;
            $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
            $date_to = $end_date;
            $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
            $from_date_s = date_format(date_create($from_date), "d F");
            $to_date_s = date_format(date_create($end_date), "d F Y");
            $days = $s_date = "$from_date_s - $to_date_s";
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $temp_date = date("Y-m-d", $i);
                $tempData = array(
                    "aid" => $appointment_r['aid'],
                    "venue" => $appointment_r['venue'],
                    "country" => $appointment_r['country'],
                    "title" => $appointment_r['title'],
                    "description" => $appointment_r['description'],
                    "city" => $appointment_r['city'],
                    "state" => $appointment_r['state'],
                    "address" => $appointment_r['address'],
                    "contact_no" => $appointment_r['contact_no'],
                    "website" => $appointment_r['website'],
                    "email" => $appointment_r['email'],
                    "image" => $appointment_r['image'],
                    "days" => $days,
                    "date" => $temp_date,
                    "start_date" => $from_date,
                    "end_date" => $end_date,
                    "from_time" => $appointment_r['from_time'],
                    "to_time" => $appointment_r['to_time'],
                );
                $this->db->insert('events', $tempData);
            }
            redirect("Events/editEvent/$appId");
        }

        $this->load->view('Appointment/appointmentEdit', $data);
    }

    public function addEvent() {
        $this->db->order_by('id desc');
        $query = $this->db->get('events');
        $last_id = $query->row();
        $data = array("last_aid" => $last_id ? ($last_id->id + 1) : 1);
        if (isset($_POST['set_date'])) {

            $file_newname = "";
            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = 'assets/media';
                $config['allowed_types'] = '*';
                $temp1 = rand(100, 1000000);
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "1." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }


            $appId = $this->input->post('aid');
            $from_date = $this->input->post('start_date');
            $end_date = $this->input->post('end_date');
            $date_from = $from_date;
            $date_from = strtotime($date_from); // Convert date to a UNIX timestamp  
            $date_to = $end_date;
            $date_to = strtotime($date_to); // Convert date to a UNIX timestamp  
            $from_date_s = date_format(date_create($from_date), "d F");
            $to_date_s = date_format(date_create($end_date), "d F Y");
            $days = $s_date = "$from_date_s - $to_date_s";
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $temp_date = date("Y-m-d", $i);
                $tempData = array(
                    "aid" => $this->input->post('aid'),
                    "title" => $this->input->post('title'),
                    "description" => $this->input->post('description'),
                    "venue" => $this->input->post('venue'),
                    "country" => $this->input->post('country'),
                    "city" => $this->input->post('city'),
                    "state" => $this->input->post('state'),
                    "address" => $this->input->post('address'),
                    "contact_no" => $this->input->post('contact_no'),
                    "email" => $this->input->post('email'),
                    "website" => $this->input->post('website'),
                    "days" => $days,
                    "date" => $temp_date,
                    "start_date" => $from_date,
                    "end_date" => $end_date,
                    "from_time" => $this->input->post('from_time'),
                    "to_time" => $this->input->post('to_time'),
                    "image" => $file_newname,
                    "user_id" =>  $this->userdata['login_id']
                );
                $this->db->insert('events', $tempData);
            }
            redirect("Events/editEvent/$appId");
        }

        $this->load->view('Appointment/appointmentAdd', $data);
    }

    function xlsReader() {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);

        $filename = 'name-of-the-generated-file.xlsx';

        $writer->save($filename); // will create and save the file in the root of the project
    }

}
