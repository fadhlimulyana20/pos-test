<?php

function cb($a, $b) {
    return strtotime($a->tanggal) - strtotime($b->tanggal);
}
$saldoawal = 100000;
$mutasi = array(
    (object)["tanggal"=>"2021-10-01","masuk"=>200000,"keluar"=>0,"saldo"=>0],
    (object)["tanggal"=>"2021-10-03","masuk"=>300000,"keluar"=>0,"saldo"=>0],
    (object)["tanggal"=>"2021-10-05","masuk"=>150000,"keluar"=>0,"saldo"=>0],
    (object)["tanggal"=>"2021-10-02","masuk"=>0,"keluar"=>100000,"saldo"=>0],
    (object)["tanggal"=>"2021-10-04","masuk"=>0,"keluar"=>150000,"saldo"=>0],
    (object)["tanggal"=>"2021-10-06","masuk"=>0,"keluar"=>50000,"saldo"=>0]
);

$saldoMutasi = array();
usort($mutasi, 'cb');

foreach ($mutasi as $key => $value) {
    $saldoawal = $saldoawal + ($value->masuk - $value->keluar);
    $saldoMutasiItem = (object)[
        "tanggal" => $value->tanggal,
        "masuk" => $value->masuk,
        "keluar" => $value->keluar,
        "saldo" => $saldoawal
    ];
    array_push($saldoMutasi, $saldoMutasiItem);
}

foreach ($saldoMutasi as $key => $value) {
    print_r($value);
}

?>