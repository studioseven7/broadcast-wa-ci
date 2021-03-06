<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Whatsapp extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Visa_model');
        $this->load->model('Itk_model');
        $this->check_login();
        $this->load->library('form_validation');
    }

    public function send($id, $type){
        // $id = $this->uri->segment(1);
        // $type = $this->uri->segment(2);
        // $type = "visa";
    //   $type    = $this->input->post('type');
      if ($type == 'visa'){
        $user = $this->Visa_model->get_by_id($id);
      } else {
        $user = $this->Itk_model->get_by_id($id);
      }
      $sendwa = $this->sendWa($user);
    //   echo(date('Y-m-d'));
    // echo $sendwa;
      $data = [
        'status_notification'    => 1,
        'send_notification'    => date('Y-m-d'),
      ];
      if ($sendwa == "berhasil") {
        $this->session->set_flashdata('Tambah', 'Success Send Whatsapp !');
        if($type == "visa") {
          $this->Visa_model->update(['id' => $id], $data);
          redirect('visa');
        }
        else {
          $this->Itk_model->update(['id' => $id], $data);
          redirect('itk');
        }
      } else {
        $this->session->set_flashdata('Error', $sendwa);
        if($type == "visa") {
          redirect('visa');
        }
      else {
        redirect('itk');
       }
    }


   }
   private function sendWa($user) {
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'http://localhost:8000/send-message',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => array('number' => $user->no_hp,'message' => "Dear $user->first_name $user->last_name,\n\nWe would like to inform you that deadlines of your permit will be expired $user->date_expired\nWe would like to see you at our office as soon as possible.\nPlease contact us if you have any question.\n\nYours sincerely,\n\n\n\nRohman"),
  ));
  
  $response = curl_exec($curl);
  $a = json_decode($response);
//   echo $a->status;
  if (isset($a->status)) {
      if($a->status == 1){
        $status = "berhasil";
      } else {
        $status = $a->message;
      }
  }else{
      $status = "network error !";
  }


//   print_r($response->getStatus());
//  $a = json_decode($response);
// echo $response->statusCode;
  
  curl_close($curl);
  return $status;
   }
}
?>