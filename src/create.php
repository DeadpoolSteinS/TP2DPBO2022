<?php

include("conf.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Ormawa.class.php");

$ormawa = new Ormawa($db_host, $db_user, $db_pass, $db_name);
$ormawa->open();

if(isset($_POST["submit"]))
{
    if(isset($_GET["id"]))
    {
        $ormawa->updateRecord($_GET["id"]);

        if(isset($_GET["id_divisi"])) $dest = "index.php?id_divisi=" . $_GET["id_divisi"] . "&id=" . $_GET["id"];
        else $dest = "index.php?id=" . $_GET["id"];

        echo "<script>
                alert('Data berhasil diupdate!');
                document.location.href = '" . $dest . "';
            </script>";
    }
    else
    {
        $ormawa->addRecord();
        echo "<script>
                alert('Data berhasil ditambahkan!');
            </script>";
    }
}

// get divisi value now
if(isset($_GET["id_divisi"])) $ormawa->getDivisi($_GET["id_divisi"]);
else $ormawa->getDivisiAll();
$logo = $ormawa->getResult()[0];

// update data
if(isset($_GET["id"]))
{
    $ormawa->getDetail($_GET["id"]);
    $list = $ormawa->getResult()[0];
}

// get option fro select tag
$ormawa->getSelect($logo["id_divisi"]);
$result = $ormawa->getResult();

if(count($result) == 0)
{
    echo "<script>
            alert('Input Bidang terlebih dahulu!');
            document.location.href = 'create_divisi.php?div_bid=" . $logo["id_divisi"] . "';
        </script>";
}

$data = null;

foreach ($result as $item)
{
    $data .= "<option value='" . $item["id_bidang"] . "'";
    if(isset($_GET["id"]) && $item["id_bidang"] == $list["id_bidang"]) $data .= " selected";
    $data .= ">" . $item["jabatan"] . "</option>";
}

// get link back index
$back =  (isset($_GET["id_divisi"])) ? "id_divisi=" . $_GET["id_divisi"] : "";
$back .= (isset($_GET["id"])) ? "&id=" . $_GET["id"] : "";

// get link to add anggota reference divisi
$addIdDivisi = (isset($_GET["id_divisi"])) ? "id_divisi=" . $_GET["id_divisi"] : "";

$ormawa->close();
$tp2 = new Template("templates/create.html");
$tp2->replace("LOGO", $logo["nama_divisi"]);

if(isset($_GET["id"]))
{
    $tp2->replace("DATA_NIM", $list["nim"]);
    $tp2->replace("DATA_NAMA", $list["nama"]);
    $tp2->replace("DATA_SEMESTER", $list["semester"]);
}
else
{
    $tp2->replace("DATA_NIM", "");
    $tp2->replace("DATA_NAMA", "");
    $tp2->replace("DATA_SEMESTER", "");
}
$tp2->replace("DATA_SELECT", $data);
$tp2->replace("BACK", $back);
$tp2->replace("ADD_ID_DIVISI", $addIdDivisi);
$tp2->write();
