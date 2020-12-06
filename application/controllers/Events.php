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
        $this->curd = $this->load->model('Curd_model');
        $this->userdata = $this->session->userdata('logged_in');
    }

    public function listEvents() {
        $allappointment = $this->Event_model->EventDataAll($this->userdata['user_type'] == 'Manager' ? $this->userdata['login_id'] : 0);
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

        $date_time_list = $eventData['date_time_list'];

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
                $this->db->where("id", $appId);
                $this->db->update('events', $data);
                redirect("Events/editEvent/$appId");
            } else {
                $picture = '';
            }
        } else {
            $picture = '';
        }


        if (isset($_POST['set_date'])) {
            $this->db->delete('events_dates', array('event_id' => $appId));
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
            
            $data = array("start_date" => $from_date, "end_date"=>$end_date, "days"=>$days);
            $this->db->set($data);
            $this->db->where("id", $appId);
            $this->db->update('events', $data);
            
            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $temp_date = date("Y-m-d", $i);
                $tempData = array(
                    "event_id" => $appId,
                    "date" => $temp_date,
                    "from_time" => $date_time_list ? $date_time_list[0]['from_time'] : '09:00 AM',
                    "to_time" => $date_time_list ? $date_time_list[0]['to_time'] : '09:00 PM',
                );
                $this->db->insert('events_dates', $tempData);
            }
            redirect("Events/editEvent/$appId");
        }

        $this->load->view('Appointment/appointmentEdit', $data);
    }

    public function addEvent() {
     
        $data = array("last_aid" =>1);

        

        $data['category_list'] = array();

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


            $tempDataEvent = array(
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
                "category_id" => $this->input->post('category_id'),
                "category_name" => $categories_data_acc[$this->input->post('category_id')]['category_name'],
                "start_date" => $from_date,
                "end_date" => $end_date,
                "image" => $file_newname,
                "user_id" => $this->userdata['login_id']
            );
            $this->db->insert('events', $tempDataEvent);
            $event_id = $this->db->insert_id();

            for ($i = $date_from; $i <= $date_to; $i += 86400) {
                $temp_date = date("Y-m-d", $i);
                $tempData = array(
                    "event_id" => $event_id,
                    "date" => $temp_date,
                    "from_time" => $this->input->post('from_time'),
                    "to_time" => $this->input->post('to_time'),
                );
                $this->db->insert('events_dates', $tempData);
            }
            redirect("Events/editEvent/$event_id");
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

    public function eventCategories() {
        $data = array();
        $data['title'] = "Event Categories";
        $data['description'] = "Event Categories";
        $data['form_title'] = "Add Category";
        $data['table_name'] = 'category';
        $form_attr = array(
            "category_name" => array("title" => "Category Name", "required" => true, "place_holder" => "Category Name", "type" => "text", "default" => ""),
            "parent_id" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
            "display_index" => array("title" => "", "required" => false, "place_holder" => "", "type" => "hidden", "default" => ""),
        );

        if (isset($_POST['submitData'])) {
            $postarray = array();
            foreach ($form_attr as $key => $value) {
                $postarray[$key] = $this->input->post($key);
            }
            $this->Curd_model->insert('category', $postarray);
            redirect("Events/eventCategories");
        }


        $categories_data = $this->Curd_model->get('category');
        $data['list_data'] = $categories_data;

        $fields = array(
            "id" => array("title" => "ID#", "width" => "100px"),
            "category_name" => array("title" => "Category Name", "width" => "50%"),
        );

        $data['fields'] = $fields;
        $data['form_attr'] = $form_attr;
        $this->load->view('layout/curd', $data);
    }

}
