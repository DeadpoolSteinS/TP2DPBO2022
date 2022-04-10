<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Divisi.class.php");

$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

if(isset($_GET["id_hapus"]))
{
    if(isset($_GET["div_bid"]))
    {
        $divisi->deleteBidang($_GET["id_hapus"]);
        $divisi->close();
        header("Location: divisi.php?div_bid=" . $_GET["div_bid"]);
    }
    else
    {
        $divisi->delete($_GET["id_hapus"]);
        $divisi->close();
        header("Location: divisi.php");
    }
    exit;
}

if(isset($_GET["div_bid"]))
{
    // get all bidang reference by get div_bid
    $divisi->getBidangAll($_GET["div_bid"]);
    $result = $divisi->getResult();
    // get divisi reference by get div_bid
    $divisi->getDivisi($_GET["div_bid"]);
    $namaDivisi = $divisi->getResult()[0]["nama_divisi"];
}
else
{
    // get all divisi data
    $divisi->getDivisiAll();
    $result = $divisi->getResult();
}

$data = null; $no = 1;

foreach ($result as $list) {
    if(!isset($_GET["div_bid"]))
    {
        // get total pengurus on divisi
        $divisi->countRowDivisi($list["id_divisi"]);
        $total = $divisi->getResult()[0]["COUNT(*)"];

        $data .= "<div class='table'>
                    <p>" . $no++ . "</p>
                    <p>" . $list["nama_divisi"] . "</p>
                    <p>" . $total . "</p>
                    <div class='action'>
                        <a href='create_divisi.php?id_divisi=" . $list["id_divisi"] . "'>Edit</a>
                        <a href='divisi.php?id_hapus=" . $list["id_divisi"] . "'>Hapus</a>
                        <a href='index.php?id_divisi=" . $list["id_divisi"] . "'>Anggota</a>
                        <a href='divisi.php?div_bid=" . $list["id_divisi"] . "'>Bidang</a>
                    </div>
                </div>";
    }
    else
    {
        // get total pengurus on bidang
        $divisi->countRowBidang($list["id_bidang"]);
        $total = $divisi->getResult()[0]["COUNT(*)"];

        $data .= "<div class='table'>
                    <p>" . $no++ . "</p>
                    <p>" . $list["jabatan"] . "</p>
                    <p>" . $total . "</p>
                    <div class='action'>
                        <a href='create_divisi.php?div_bid=" . $list["id_divisi"] . "&id_bidang=" . $list["id_bidang"] . "'>Edit</a>
                        <a href='divisi.php?div_bid=" . $list["id_divisi"] . "&id_hapus=" . $list["id_bidang"] . "'>Hapus</a>
                    </div>
                </div>";
    }
}

// get link to add anggota reference divisi
$addIdDivisi = (isset($_GET["div_bid"])) ? "div_bid=" . $_GET["div_bid"] : "";

$divisi->close();
$tp2 = new Template("templates/divisi.html");
$tp2->replace("DATA_TABEL", $data);

// add link and Logo for add data bidang
if(isset($_GET["div_bid"]))
{
    $tp2->replace("LOGO_DIVISI", $namaDivisi);
    $tp2->replace("NAMA_ON_TABEL", "Jabatan");
}
else
{
    $tp2->replace("LOGO_DIVISI", "Divisi");
    $tp2->replace("NAMA_ON_TABEL", "Nama");
}

$tp2->replace("DIV_BID", $addIdDivisi);
$tp2->write();
