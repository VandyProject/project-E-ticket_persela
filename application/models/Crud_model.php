<?php
date_default_timezone_set('Asia/Jakarta');
?>
<?php

class Crud_model extends CI_Model {

    
    function colser($table){
        
        $data = $this->db->field_data($table);
        $kolser = [];
        foreach ($data as $c){
            array_push($kolser, $c->name);
        }
        return $kolser;  
    }
    function order($table){
        
        $data = $this->db->field_data($table);
        $der = array($data[0]->name => 'desc');
        
        return $der;  
    }

    function create($table, $data) {
        $this->db->insert($table, $data);
    }

    function read($table, $where = null, $order = null) {
        if ($where == null && $order == null) {
            return $this->db->get($table)->result_array();
        } else if ($where != null && $order == null) {
            return $this->db->where($where)->get($table)->result_array();
        } else if ($where == null && $order != null) {
            return $this->db->order_by($order)->get($table)->result_array();
        } else {
            return $this->db->where($where)->order_by($order)->get($table)->result_array();
        }
    }

    function update($table, $where, $data) {
        $this->db->where($where)->update($table, $data);
    }

    function delete($table, $where) {
        $this->db->where($where)->delete($table);
    }

    function find($table, $where) {
        return $this->db->where($where)->get($table)->result_array();
    }
    
    private function _get_datatables($table,$column_order,$column_search, $order) {

        $this->db->from($table);

        $i = 0;

        foreach ($this->colser($table) as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search

                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_data($table,$column_order, $column_search, $order) {
        $this->_get_datatables($table,$column_order,$column_search, $order);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result_array();
    }
     private function _getfind_datatables($table,$column_order,$column_search, $order, $status, $key) {

        $this->db->where($status,$key)->from($table);

        $i = 0;

        foreach ($this->colser($table) as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search

                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function getfind_data($table,$column_order, $column_search, $order, $status, $key) {
        $this->_getfind_datatables($table,$column_order,$column_search, $order, $status, $key);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
            $this->db->where($status,$key);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    
}
