<?php

class Mpengaduans extends CI_Model {

	function get_data() {

		$this->db->order_by('id', 'ASC');
		return $this->db->get('pengaduan')->result();

	}

	function cek_data($id) {

		$this->db->where('id', $id);
		return $this->db->get('pengaduan')->row();

	}

	function insert_data_($data) {

		return $this->db->insert('balas_pengaduan', $data);

	}
	function insert_data($data) {

		return $this->db->insert('pengaduan', $data);

	}

	function update_data($data, $id) {

		$this->db->where('id', $id);
		return $this->db->update('pengaduan', $data);

	}

	function delete_data($id) {

		$this->db->where('id', $id);
		return $this->db->delete('balas_pengaduan');

	}

	function delete_data_($id) {

		$this->db->where('id', $id);
		return $this->db->delete('pengaduan');

	}

	function make_query()
	{
		$this->db->select('pengaduan.*')
				 ->from("pengaduan");
			 if(isset($_POST["search"]["value"]))
			 {
						$this->db->like("nama_pengadu", $_POST["search"]["value"]);
						$this->db->or_like("judul_pengaduan", $_POST["search"]["value"]);
			 }
			 if(isset($_POST["order"]))
			 {
						$this->db->order_by($_POST['order']['0']['column'], $_POST['order']['0']['dir']);
			 }
			 else
			 {
						$this->db->order_by('tanggal', 'DESC');
			 }
	}

	function make_datatables(){
			 $this->make_query();
			 if($_POST["length"] != -1)
			 {
						$this->db->limit($_POST['length'], $_POST['start']);
			 }
			 $query = $this->db->get();
			 return $query->result();
	}

	function get_filtered_data(){
			 $this->make_query();
			 $query = $this->db->get();
			 return $query->num_rows();
	}

	function get_all_data()
	{
			 $this->db->select("*");
			 $this->db->from("pengaduan");
			 return $this->db->count_all_results();
	}


}
