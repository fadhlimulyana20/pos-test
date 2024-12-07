<?php

$saldoAwalStok = 0;
$saldoAwalStokRp = 0;
$kartuStok = array(
    (object)[
        "tanggal" => "2021-10-01",
        "masuk" => 10,
        "keluar" => 0,
        "saldoQty" => 0,
        "masukRp" => 10000,
        "keluarRp" => 0,
        "saldoRp" => 0
    ],
    (object)[
        "tanggal" => "2021-10-03",
        "masuk" => 45,
        "keluar" => 0,
        "saldoQty" => 0,
        "masukRp" => 36000,
        "keluarRp" => 0,
        "saldoRp" => 0
    ],
    (object)[
        "tanggal" => "2021-10-05",
        "masuk" => 40,
        "keluar" => 0,
        "saldoQty" => 0,
        "masukRp" => 35000,
        "keluarRp" => 0,
        "saldoRp" => 0
    ],
    (object)[
        "tanggal" => "2021-10-02",
        "masuk" => 0,
        "keluar" => 5,
        "saldoQty" => 0,
        "masukRp" => 0,
        "keluarRp" => 0,
        "saldoRp" => 0
    ],
    (object)[
        "tanggal" => "2021-10-04",
        "masuk" => 0,
        "keluar" => 40,
        "saldoQty" => 0,
        "masukRp" => 0,
        "keluarRp" => 0,
        "saldoRp" => 0
    ],
    (object)[
        "tanggal" => "2021-10-06",
        "masuk" => 0,
        "keluar" => 35,
        "saldoQty" => 0,
        "masukRp" => 0,
        "keluarRp" => 0,
        "saldoRp" => 0
    ]
);

function StockSort($kartu_stok, $saldo_awal_stok, $saldo_awal_stok_rp) {
    usort($kartu_stok, function ($a, $b) {
        return strtotime($a->tanggal) - strtotime($b->tanggal);
    });
    
    foreach ($kartu_stok as $key => $value) {
        $saldo_awal_stok = $saldo_awal_stok + ($value->masuk - $value->keluar);
        $value->saldoQty = $saldo_awal_stok;

        if ($key < 1) {
            $saldo_awal_stok_rp = $value->masukRp - $value->keluarRp;
            $value->saldoRp = $saldo_awal_stok_rp;
        } else {
            $keluar_rp = ($saldo_awal_stok_rp / $kartu_stok[$key-1]->saldoQty) * $value->keluar;
            $value->keluarRp = $keluar_rp;
            $saldo_awal_stok_rp = $saldo_awal_stok_rp + ($value->masukRp - $keluar_rp);
            $value->saldoRp = $saldo_awal_stok_rp;
        }
    }

    print_r($kartu_stok);
}

StockSort($kartuStok, $saldoAwalStok, $saldoAwalStokRp);