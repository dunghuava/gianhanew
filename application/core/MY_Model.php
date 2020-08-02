<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* MY_Model
* 
* @author Pham Quoc Hieu <quochieuhcm@gmail.com > | 0949.133.224
* @copyright 2015
*/
class MY_model extends CI_Model
{
    protected $table_name = '';
    function __construct(){
        parent::__construct();
        
    }
    /**
    * Display all record.
    *
    * @param  string  $column ('id, title,...')
    * @param  string  $order_by ('id', 'desc'); 
    * @param  int    $limit ('1, 2,...') 
    * @return result_array;
    */
    public function get_all_table($column = null,$join = array(),$order_by=array(),$limit=null)
    {
        $this->open();
        if ($column != null){
            $this->db->select($column);
        }
        if (!empty($join) && is_array($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key,$value);
            }
        }
        if (!empty($order_by) && is_array($order_by)) {
            foreach ($order_by as $key => $order)
                 $this->db->order_by($key, $order);
        }
        if ($limit !=null) {
            $this->db->limit($limit);
        }
        return $this->db->get($this->table_name)->result_array();
    }
    public function insert($data)
    {
        $this->open();
        $this->db->insert($this->table_name, $data);
        return $this->db->insert_id();
    }
    public function update($data, $condition = array())
    {
        $this->open();
        if (!empty($condition) && is_array($condition))
            foreach ($condition as $key => $value)
                if (is_numeric($key))
                    $this->db->where($value);
                else
                    $this->db->where($key, $value);
        $this->db->update($this->table_name, $data);
    }
    public function delete($condition){
        $this->open();
        if (!empty($condition) && is_array($condition))
            foreach ($condition as $key => $value)
                if (is_numeric($key))
                    $this->db->where($value);
                else
                    $this->db->where($key, $value);
        $this->db->delete($this->table_name);
    }
    public function deleteImage($field,$condition,$link)
    {
        $this->db->select($field);
        if (!empty($condition) && is_array($condition))
            foreach ($condition as $key => $value)
                if (is_numeric($key))
                    $this->db->where($value);
                else
                    $this->db->where($key, $value);
        $img = $this->db->get($this->table_name);
        if ($img->num_rows() > 0)
        {
            $data = $img->row_array();
            if ($data[$field] != ""){
                unlink('.'.$link.$data[$field]);
                if (file_exists('.'.$link.'thumb_'.$data[$field])){
                   unlink('.'.$link.'thumb_'.$data[$field]);
                }
            }
        }
    }
    public function excuteQuery($sql,$row=null){
        $this->open();
        $r = $this->db->query($sql);
        if (empty($r) || !is_object($r)){
            return NULL;
        }
        if ($row == 'result'){
            return $r->result_array();
        }else{
            return $r->row_array();
        }
        
    }
    
    private $isConnected = false;
    public function open(){
        if ($this->isConnected){
            if (empty($this->db)){
                $CI = & get_instance();
                $CI->load->database();
                $this->db = $CI->db;
            }
            return;
        }
        
        $this->isConnected = true;
        $CI = & get_instance();
        if (empty($CI->db)){
            $CI->load->database();
            $this->db = $CI->db;
        }
        $this->table_name = $this->dbprefix($this->table_name);
    }
    public function close(){
        if (!empty($this->db))
            $this->db->close();
        $this->isConnected = false;
    }
    public function dbprefix($table) {
        if (!$this->isConnected)
            $this->open();
        if (empty($this->db->dbprefix) || startsWith($table, $this->db->dbprefix))
            return $table;
        return $this->db->dbprefix($table);
    }
    public function beginTransaction(){
        $this->db->trans_begin();
    }
    
    public function finishTransaction(){
        if ($this->db->trans_status() === FALSE){
            $this->db->trans_rollback();
        }
        else{
            $this->db->trans_commit();
        }        
    }
    
    public function commit(){
        $this->db->trans_commit(); 
    }
    
    public function rollback(){
        $this->db->trans_rollback();
    }
} 