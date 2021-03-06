<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Konfirmasi_t_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get pemesanan by id_pemesanan
     */
    function get_konfirmasi_t($id_konfirmasi)
    {
        return $this->db->get_where('konfirmasi_t',array('id_konfirmasi'=>$id_konfirmasi))->row();
    }
    
    function get_count()
    {
        return $this->db->count_all('konfirmasi_t');
    }
    /*
     * Get all pemesanan
     */
    function get_all_konfirmasi_t()
    {
        $this->db->order_by('id_konfirmasi', 'desc');
        return $this->db->get('konfirmasi_t')->result();
    }
        
    /*
     * function to add new pemesanan
     */
    function add_konfirmasi_t($params)
    {
        $this->db->insert('konfirmasi_t',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update pemesanan
     */
    function update_konfirmasi_t($id_konfirmasi,$params)
    {
        $this->db->where('id_konfirmasi',$id_konfirmasi);
        return $this->db->update('konfirmasi_t',$params);
    }

     function cek_invoice($invoice)
    {
        return $this->db->get_where('konfirmasi_t',array('invoice'=>$invoice))->result();
    }
    
    function upload(){
        $config['upload_path'] = 'resources/upload/bukti_pembayaran';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '2048';
        $config['remove_space'] = TRUE;
    
        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        if($this->upload->do_upload('gambar')){ // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
        }

        function save($upload){
        $data = array(
            // 'deskripsi'=>$this->input->post('input_deskripsi'),
            'gambar' => $upload['gambar']['file_name']
            // 'ukuran_file' => $upload['file']['file_size'],
            // 'tipe_file' => $upload['file']['file_type']
        );
        
        $this->db->insert('konfirmasi_t', $data);
    }

    /*
     * function to delete pemesanan
     */
    function delete_konfirmasi_t($id_konfirmasi)
    {
        return $this->db->delete('konfirmasi_t',array('id_konfirmasi'=>$id_konfirmasi));
    }
    
    function ambil_data($perpage, $offset, $bulan, $tahun){
        $this->db->order_by('id_konfirmasi', 'desc');
         $this->db->where('month(tgl_sekarang)',$bulan);
      $this->db->where('year(tgl_sekarang)',$tahun);
        return $this->db->get("konfirmasi_t", $perpage, $offset)->result();
        
    }

    function data_konfirmasi($bulan, $tahun) {

        $this->db->select('*');
        $this->db->from('konfirmasi_t');
        $this->db->where('month(tgl_sekarang)',$bulan);
        $this->db->where('year(tgl_sekarang)',$tahun);
        // $this->db->where("status = '1'");
        // $this->db->where("(alamat  LIKE '%{$keyword}%' or provinsi  LIKE '%{$keyword}%' or kabupaten  LIKE '%{$keyword}%')");
        $this->db->order_by('id_konfirmasi', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    function cari($keyword){
      $this->db->like('invoice', $keyword); //mencari data yang serupa dengan keyword
      return $this->db->get('konfirmasi_t')->result();
    }

    
}
