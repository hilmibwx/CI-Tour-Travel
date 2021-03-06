<!DOCTYPE html>
<html>
<head>
    <title>Cetak PDF</title>
    <style>
        table, td, th {    
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 8px;
        }

    </style>
</head>
<body>
    <h2 align="center">Laporan Pemesanan Tour Guide</h2>
    <table>
        <thead>
            <tr>
                <th width="10px"><center>No.</center></th>
                <th width="20px"><center>Nama</center></th>
                <th width="30px"><center>Alamat</center></th>
                <th width="20px"><center>Tour Guide</center></th>
                <!-- <th><center> Anggota</center></th> -->
                <th width="20px"><center> Total</center></th>
            </tr>
        </thead>
        <tbody>

            <?php 
            $no=0;
            $jumlah = 0;
            foreach($laporan as $p){ ?>
            <tr>
                <td><center><?php echo ++$no;?></center></td>
              
                <td><center><?php echo $p->nama_pemesan ?></center></td>
                <td><center><?php echo $p->alamat ?></center></td>
                <td><center>
                    
                             <?php 
                            $guide = $this->Tour_guide_model->get_tour_guide($p->id_tourguide);
                            echo $guide->nama_tourguide ?>
                        
                </center></td>
                <td><center><?php echo 'Rp. '.number_format( $p->total, 2,',','.') ?></center></td>
            </tr>
            <?php

            $jumlah = $jumlah + $p->total;
             } ?>
          

            <?php 
            if(count($laporan)==0){
              echo "<tr><td colspan='6' align='center'>Tidak Ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <br>
    <h6>Jumlah Transaksi: <?php echo count($laporan); ?></h6>
    <h6>Jumlah Pemasukan: <?php echo 'Rp. '.number_format($jumlah, 2,',','.')  ?></h6>

     <script type="text/javascript">
         window.print();
      </script>
</body>
</html>
