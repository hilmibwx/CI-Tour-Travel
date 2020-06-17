<?php
/* 
 * Generated by CRUDigniter v3.2 
 * www.crudigniter.com
 */
 
class Pemesanan_tourguide_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    /*
     * Get pemesanan by id_pemesanan
     */
    function get_pemesanan_tourguide($id_pemesananguide)
    {
        return $this->db->get_where('pemesanan_tourguide',array('id_pemesananguide'=>$id_pemesananguide))->row();
    }

     function datainvoice($invoice)
    {
        return $this->db->get_where('pemesanan_tourguide',array('invoice'=>$invoice))->row();
    }
    
    function get_count()
    {
        return $this->db->count_all('pemesanan_tourguide');
    }
    /*
     * Get all pemesanan
     */
    function get_all_pemesanan_tourguide()
    {
        $this->db->order_by('id_pemesananguide', 'desc');
        return $this->db->get('pemesanan_tourguide')->result_array();
    }

    function data_per_laporan($id, $bulan, $tahun, $keyword) {

        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        $this->db->where("(alamat  LIKE '%{$keyword}%')");
        $this->db->where("id_tourguide = ".$id);
        $this->db->where("status = '1'");

        // $this->db->where("(alamat  LIKE '%{$keyword}%' or provinsi  LIKE '%{$keyword}%' or kabupaten  LIKE '%{$keyword}%')");
        $this->db->order_by('tanggal_sekarang', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

    function data_laporan($bulan, $tahun, $keyword) {

        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        $this->db->where("(alamat  LIKE '%{$keyword}%')");
        $this->db->where("status = '1'");

        // $this->db->where("(alamat  LIKE '%{$keyword}%' or provinsi  LIKE '%{$keyword}%' or kabupaten  LIKE '%{$keyword}%')");
        $this->db->order_by('id_pemesananguide', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }

     function data_cetak($bulan, $tahun) {

        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        // $this->db->where("(alamat  LIKE '%{$keyword}%')");
        $this->db->where("status = '1'");

        // $this->db->where("(alamat  LIKE '%{$keyword}%' or provinsi  LIKE '%{$keyword}%' or kabupaten  LIKE '%{$keyword}%')");
        $this->db->order_by('tanggal_sekarang', 'DESC');
        
        $query = $this->db->get();
        return $query->result();
    }
        
    function data_pemesanan($bulan, $tahun, $keyword) {
        $this->db->order_by('id_pemesananguide', 'DESC');
        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');

        $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        $this->db->where("(alamat  LIKE '%{$keyword}%')");

        // $this->db->where("status = '1'");
        // $this->db->where("(alamat  LIKE '%{$keyword}%' or provinsi  LIKE '%{$keyword}%' or kabupaten  LIKE '%{$keyword}%')");
        
        
        $query = $this->db->get();
        return $query->result();
    }
    /*
     * function to add new pemesanan
     */
    function add_pemesanan_tourguide($params)
    {
        $this->db->insert('pemesanan_tourguide',$params);
        return $this->db->insert_id();
    }
    
    /*
     * function to update pemesanan
     */
    function update_pemesanan_tourguide($id_pemesananguide,$params)
    {
        $this->db->where('id_pemesananguide',$id_pemesananguide);
        return $this->db->update('pemesanan_tourguide',$params);
    }
    
    /*
     * function to delete pemesanan
     */
    function delete_pemesanan_tourguide($id_pemesananguide)
    {
        return $this->db->delete('pemesanan_tourguide',array('id_pemesananguide'=>$id_pemesananguide));
    }

    function pesan_tourguide($id_tourguide, $tgl_pemesanan)
    {
        return $this->db->get_where('pemesanan_tourguide',array('id_tourguide'=>$id_tourguide, 'tanggal_pemesanan'=>$tgl_pemesanan))->result();
    }

    public function tanggal_id($tanggal){
        $tanggal2 = substr($tanggal,8,2);
        $bulan = $this->getBulan_id(substr($tanggal,5,2));
        $tahun = substr($tanggal,0,4);
        return $tanggal2.' '.$bulan.' '.$tahun;      
    }

    

    function tanggal_en($tanggal){
        $tanggal2 = substr($tanggal,3,2);
        $bulan = substr($tanggal,0,2);
        $tahun = substr($tanggal,6,4);
        return $tahun.'-'.$bulan.'-'.$tanggal2;         
    }

    function getBulan_en($bln){
        switch ($bln){
            case 1: 
                return "January";
                break;
            case 2:
                return "February";
                break;
            case 3:
                return "March";
                break;
            case 4:
                return "April";
                break;
            case 5:
                return "May";
                break;
            case 6:
                return "June";
                break;
            case 7:
                return "July";
                break;
            case 8:
                return "August";
                break;
            case 9:
                return "September";
                break;
            case 10:
                return "October";
                break;
            case 11:
                return "November";
                break;
            case 12:
                return "December";
                break;
        }
    }
    function ambil_data($perpage, $offset, $bulan, $tahun, $keyword){
        $this->db->order_by('id_pemesananguide', 'DESC');
         $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        $this->db->where("(alamat  LIKE '%{$keyword}%')");
        return $this->db->get("pemesanan_tourguide", $perpage, $offset)->result();
        
    }

    function cek_invoice($invoice)
    {
        return $this->db->get_where('pemesanan_tourguide',array('invoice'=>$invoice))->row();
    }

     function cari($keyword){
      $this->db->like('nama_pemesan', $keyword); //mencari data yang serupa dengan keyword
      return $this->db->get('pemesanan_tourguide')->result();
    }

    function kuota($id_tourguide){
        $bulan = date('m');
        $tahun = date('Y');
        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        $this->db->where('id_tourguide',$id_tourguide);

         $query = $this->db->get();
        return $query->result();
    }

     function laporanguide($id_guide){
        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        $this->db->where('id_tourguide',$id_guide);
        $this->db->where("status = '1'");

         $query = $this->db->get();
        return $query->result();
    }

    function laporanfilterguide($id_guide,$bulan,$tahun){
        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        $this->db->where('month(tanggal_sekarang)',$bulan);
        $this->db->where('year(tanggal_sekarang)',$tahun);
        $this->db->where('id_tourguide',$id_guide);
        $this->db->where("status = '1'");

        $query = $this->db->get();
        return $query->result();
    }

        


    function laporanpemesan(){
        $this->db->select('*');
        $this->db->from('pemesanan_tourguide');
        // $this->db->where('alamat');
        $this->db->where("status = '1'");

         $query = $this->db->get();
        return $query->result();
    }

    //  function laporanpaket($id_paket){
    //     $this->db->select('*');
    //     $this->db->from('pemesanan');

    //     $this->db->where('nama_paket',$id_paket);

    //      $query = $this->db->get();
    //     return $query->result();
    // }

    
}