<?php

class Divisi extends DB
{
    function __construct($db_host='', $db_user='', $db_password='', $db_name='')
	{
		$this->DB($db_host, $db_user, $db_password, $db_name);
	}

    function getDivisiAll()
    {
        $query = "SELECT * FROM divisi";
        return $this->execute($query);
    }

    function getDivisi($id)
    {
        $query = "SELECT * FROM divisi WHERE id_divisi=$id";
        return $this->execute($query);
    }

    function addRecord()
    {
        $nama  = htmlspecialchars($_POST["nama"]);
        $query = "INSERT INTO divisi values (NULL, '$nama')";
        return $this->execute($query);
    }

    function updateRecord($id)
    {
        $nama  = htmlspecialchars($_POST["nama"]);
        $query = "UPDATE divisi SET nama_divisi='$nama' WHERE id_divisi=$id";
        return $this->execute($query);
    }

    function delete($id)
    {
        $query = "DELETE FROM divisi WHERE id_divisi=$id";
        return $this->execute($query);
    }

    function deleteBidang($id)
    {
        $query = "DELETE FROM bidang_divisi WHERE id_bidang=$id";
        return $this->execute($query);
    }

    function getBidangAll($id)
    {
        $query = "SELECT * FROM bidang_divisi WHERE id_divisi=$id";
        return $this->execute($query);
    }

    function getDetailBidang($id)
    {
        $query = "SELECT * FROM bidang_divisi WHERE id_bidang=$id";
        return $this->execute($query);
    }

    function addRecordBidang($id)
    {
        $jabatan = htmlspecialchars($_POST["jabatan"]);
        $query = "INSERT INTO bidang_divisi VALUES (NULL, '$jabatan', $id)";
        return $this->execute($query);
    }

    function updateRecordBidang($id)
    {
        $jabatan = htmlspecialchars($_POST["jabatan"]);
        $query   = "UPDATE bidang_divisi SET jabatan='$jabatan' WHERE id_bidang=$id";
        return $this->execute($query);
    }

    function countRowDivisi($id)
    {
        $query = "SELECT COUNT(*) FROM pengurus WHERE id_bidang IN (SELECT id_bidang FROM bidang_divisi WHERE id_divisi=$id)";
        return $this->execute($query);
    }

    function countRowBidang($id)
    {
        $query = "SELECT COUNT(*) FROM pengurus WHERE id_bidang=$id";
        return $this->execute($query);
    }
}
