<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PRINT SURAT PENGANTAR</title>
</head>
<style type="text/css">
    body {
        width: 20cm;
        height: 1 cm;
        margin-top: 0.04inch;
        /* margin-bottom: 1 cm;
        margin-left: 1 cm;
        margin-right: 0.6cm; */
        padding: 0;
        orientation: portrait;
    }
</style>

<body onload="print()">
    <?php 
        $return1 = $this->db->query("SELECT
                                        nama_hj,
                                        DATE_FORMAT(a.tgl, '%d %M %Y') AS tgl,
                                        FORMAT(SUM(a.qty * b.harga), 0) AS total_harga
                                    FROM
                                        tbl_transaksi a
                                    LEFT JOIN tbl_daftarlimbahpadat b ON b.id = a.nama_barang
                                    WHERE
                                        a.no_sj = '$no_sj' 
                                    ORDER BY
                                        a.id ASC")->row(); 
    ?>
    <br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?= $return1->tgl; ?></b>
    <br><br><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?= $return1->nama_hj ?></b>
    <br><br><br><br><br><p style="line-height: 12px;">&nbsp;</p>
    <table border="0" style="font-family: 'Times New Roman', Times, serif;" width="100%">
        <body>
            <?php
                $return = $this->db->query("SELECT
                                                a.tgl,
                                                a.no_sj,
                                                a.qty,
                                                b.satuan,
                                                b.nama_muatan,
                                                FORMAT(b.harga, 0) AS harga_satuan,
                                                FORMAT(a.qty * b.harga, 0) AS total_harga
                                            FROM
                                                tbl_transaksi a
                                            LEFT JOIN tbl_daftarlimbahpadat b ON b.id = a.nama_barang
                                            WHERE
                                                a.no_sj = '$no_sj' 
                                            ORDER BY
                                                (a.qty * b.harga) DESC;")->result_array(); 
            ?>
            <?php foreach($return AS $row_transaksi) : ?>
            <tr>
                <td style="width: 7%; ">&nbsp;</td>
                <td style="width: 13%; text-align: right;"><?= $row_transaksi['qty'] ?> <?= $row_transaksi['satuan'] ?>&nbsp;&nbsp;&nbsp;</td>
                <td style="width: 63.8%;"><?= $row_transaksi['nama_muatan'] ?>&nbsp;@ Rp. <?= $row_transaksi['harga_satuan'] ?></td>
                <td style="text-align: right;">Rp. </td>
                <td style="text-align: right;"><?= $row_transaksi['total_harga'] ?></td>
            </tr>
            <?php endforeach; ?>
        </body>
        <foot>
            <tr>
                <th colspan="2" align="right">
                    <br>
                    <td>&nbsp;</td> 
                    <td>&nbsp;</td>
                </th>
            </tr>
            <tr>
                <th colspan="2" align="right">
                    <br>
                    <td><b>TOTAL</b></td> 
                    <td style="text-align: right;">Rp. </td>
                    <td style="text-align: right;"><?= $return1->total_harga; ?></td>
                </th>
            </tr>
        </foot>
    </table>
</body>

</html>