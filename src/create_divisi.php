<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Divisi.class.php");

$divisi = new Divisi($db_host, $db_user, $db_pass, $db_name);
$divisi->open();

if(isset($_POST["submit"]))
{
    if(isset($_GET["div_bid"]))
    {
        // update bidang divisi
        if(isset($_GET["id_bidang"]))
        {
            $divisi->updateRecordBidang($_GET["id_bidang"]);
            header("Location: divisi.php?div_bid=". $_GET["div_bid"]);
            exit;
        }
        // add bidang divisi
        else
        {
            $divisi->addRecordBidang($_GET["div_bid"]);
            echo "<script>
                    alert('Data berhasil ditambahkan!');
                </script>";
        }
    }
    // update divisi
    else if(isset($_GET["id_divisi"]))
    {
        $divisi->updateRecord($_GET["id_divisi"]);
        header("Location: divisi.php");
        exit;
    }
    // add divisi
    else
    {
        $divisi->addRecord();
        echo "<script>
                alert('Data berhasil ditambahkan!');
            </script>";
    }
}

// get data bidang
if(isset($_GET["id_bidang"]))
{
    $divisi->getDetailBidang($_GET["id_bidang"]);
    $listBidang = $divisi->getResult()[0];
}
// get data divisi
if(isset($_GET["id_divisi"]) || isset($_GET["div_bid"]))
{
    if(isset($_GET["div_bid"])) $divisi->getDivisi($_GET["div_bid"]);
    else $divisi->getDivisi($_GET["id_divisi"]);
    $listDivisi = $divisi->getResult()[0];
}

$divisi->close();
$tp2 = new Template("templates/create_divisi.html");

if(isset($_GET["div_bid"]))
{
    // add value to input tag
    if(isset($_GET["id_bidang"])) $tp2->replace("DATA_NAMA", $listBidang["jabatan"]);
    else $tp2->replace("DATA_NAMA", "");

    $tp2->replace("KEYWORD", "jabatan");
    $tp2->replace("NAMA", "Jabatan");
    $tp2->replace("BACK", "div_bid=" . $_GET["div_bid"]);
    $tp2->replace("LOGO_DIVISI", $listDivisi["nama_divisi"]);
}
else
{
    // add value to input tag
    if(isset($_GET["id_divisi"])) $tp2->replace("DATA_NAMA", $listDivisi["nama_divisi"]);
    else $tp2->replace("DATA_NAMA", "");

    $tp2->replace("KEYWORD", "nama");
    $tp2->replace("NAMA", "Nama");
    $tp2->replace("BACK", "");
    $tp2->replace("LOGO_DIVISI", "Divisi");
}

$tp2->write();
