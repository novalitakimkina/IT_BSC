<?php
	include "config.php";
// require_once 'config.php';
// print_r($koneksi);
// exit;
	function get_dimensi($id_dimensi) {
		
		$hasil=mysqli_query($koneksi, "SELECT jawaban,
		CASE jawaban
		WHEN 'A' THEN Count(jawaban)*1 
		WHEN 'B' THEN COUNT(jawaban)*2 
		WHEN 'C' THEN COUNT(jawaban)*3 
		WHEN 'D' THEN COUNT(jawaban)*4 
		WHEN 'E' THEN COUNT(jawaban)*5 
		END as jumlah
		FROM jawaban,tbkuesioner
		WHERE (tbkuesioner.id_kuesioner=jawaban.id_kuesioner) AND
		(tbkuesioner.id_dimensi='$id_dimensi')
		GROUP BY jawaban");
	
		$jumlah=mysqli_num_rows($hasil);
		$urut=0;
		$total=0;
		$kategori="";
		while($row =mysqli_fetch_array($hasil))
		{
			$urut=$urut+1;
			$jawaban=$row["jawaban"];
			$jumlah=$row["jumlah"];
			//echo $urut . ". "; 
			//echo $jawaban ." ";
			
			$stringedit =  str_replace(" ", ",", ($jumlah. " "));
			$total=$total+$jumlah;
			//echo $stringedit;
		}
		//echo "Total : " .$total ."<br>";
		if ($id_dimensi==1) {
			if (($total>=27) and ($total<=48.6)) {
				$kategori="Sangat Buruk";
				$bobot_kinerja=1;
			} elseif (($total>=48.7) and ($total<=70.2)) {
				$kategori="Buruk";
				$bobot_kinerja=2;
			} elseif (($total>=70.3) and ($total<=91.8)) {
				$kategori="Cukup Baik";
				$bobot_kinerja=3;
			} elseif (($total>=91.9) and ($total<=113.4)) {
				$kategori="Baik";
				$bobot_kinerja=4;
			} else {
				$kategori="Sangat Baik";
				$bobot_kinerja=5;
			}

		} elseif ($id_dimensi==2) {
			if (($total>=14) and ($total<=25.3)) {
				$kategori="Sangat Buruk";
				$bobot_kinerja=1;
			} elseif (($total>=25.2) and ($total<=36.4)) {
				$kategori="Buruk";
				$bobot_kinerja=2;
			} elseif (($total>=36.5) and ($total<=47.6)) {
				$kategori="Cukup Baik";
				$bobot_kinerja=3;
			} elseif (($total>=47.7) and ($total<=58.8)) {
				$kategori="Baik";
				$bobot_kinerja=4;
			} else {
				$kategori="Sangat Baik";
				$bobot_kinerja=5;
			}
		} elseif ($id_dimensi==3) {
			if (($total>=12) and ($total<=21.6)) {
				$kategori="Sangat Buruk";
				$bobot_kinerja=1;
			} elseif (($total>=21.7) and ($total<=31.2)) {
				$kategori="Buruk";
				$bobot_kinerja=2;
			} elseif (($total>=31.3) and ($total<=40.8)) {
				$kategori="Cukup Baik";
				$bobot_kinerja=3;
			} elseif (($total>=40.9) and ($total<=50.4)) {
				$kategori="Baik";
				$bobot_kinerja=4;
			} else {
				$kategori="Sangat Baik";
				$bobot_kinerja=5;
			}
		} elseif ($id_dimensi==4) {
			if (($total>=13) and ($total<=23.4)) {
				$kategori="Sangat Buruk";
				$bobot_kinerja=1;
			} elseif (($total>=23.5) and ($total<=33.8)) {
				$kategori="Buruk";
				$bobot_kinerja=2;
			} elseif (($total>=33.9) and ($total<=44.2)) {
				$kategori="Cukup Baik";
				$bobot_kinerja=3;
			} elseif (($total>=44.3) and ($total<=54.6)) {
				$kategori="Baik";
				$bobot_kinerja=4;
			} else {
				$kategori="Sangat Baik";
				$bobot_kinerja=5;
			}
		} 
		//perhitungan KPI
		$sql="SELECT dimensi,bobot FROM tbdimensi where id_dimensi=$id_dimensi";
		$result=mysqli_query($koneksi, $sql);
		$rows=mysqli_fetch_array($result);
		$bobot=$rows['bobot'];
		$KPI=($bobot_kinerja/$bobot)*100;
		//kesimpulan
		if (($KPI>=1) and ($KPI<=20)) {
			$kategori_kpi="Tidak Baik";
		} elseif (($KPI>=21) and ($KPI<=40)) {
			$kategori_kpi="Kurang";
		} elseif (($KPI>=41) and ($KPI<=60)) {
			$kategori_kpi="Cukup";
		} elseif (($KPI>=61) and ($KPI<=80)) {
			$kategori_kpi="Baik";
		} else {
			$kategori_kpi="Sangat Baik";
		}
		echo $KPI;
		$kesimpulan="Kesimpulan KPI dilihat dari Dimensi " .$rows['dimensi'] . " adalah " . $kategori_kpi;
		echo "Kategori : ".$kategori . "<br>";
		
	}

	get_dimensi(1);
?>