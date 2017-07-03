<?php

namespace Labmanager\Http\Controllers\administrator;

use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Labmanager\Http\Requests;
use Labmanager\Http\Controllers\Controller;

class ChartController extends Controller
{
	public function getInstitusi()
	{
		$return = collect();
		$helper = collect();
		$collor = ['#FF9E01','#F8FF01','#B0DE09','#04D215','#1AC570','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#C51AC5','#C51A70'];

		// institusi piechart
		$listInstitusi =DB::select("SELECT  nama_jenis_instansi,
			COUNT(*) AS jumlah
			FROM vinstansi
			GROUP BY nama_jenis_instansi", []);

		$i = 0;
		foreach ($listInstitusi as $institusi) {
			$helper->push([
				'title' =>$institusi->nama_jenis_instansi,
				'value' =>$institusi->jumlah,
				'color'  =>$collor[$i]?$collor[$i]:'#DDDDDD',
				]);
			$i++;
		}
		$return->push(['total'=>$helper]);

		// daerah barchart
		$helper = collect();

		$collor2 = ['#FF0F00','#FF9E01','#FCD202','#F8FF01','#B0DE09','#04D215','#1AC570','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#C51AC5','#C51A70'];
		$queryHelper ="";

		$listJnsInstitusi = DB::table('jenisinstansi')->get();

		foreach ($listJnsInstitusi as $jnsInstitusi) {
			$queryHelper .= 'COUNT( CASE WHEN jenisinstansi_id ='.$jnsInstitusi->id.' THEN 1 ELSE NULL END) AS "'.$jnsInstitusi->nama_jenis_instansi.'",';
		}

		$listDaerah = DB::select('SELECT `nama_daerah`,'.$queryHelper.' COUNT(*) AS Total 
			FROM `vinstansi` GROUP BY `nama_daerah`',[]);

		$i = 0;
		foreach ($listDaerah as $daerah) {
			$institusihelper = collect();
			foreach ($listJnsInstitusi as $jnsInstitusi) {
				$nmjns =$jnsInstitusi->nama_jenis_instansi;
				$institusi = collect(['title' =>$nmjns,'value' =>$daerah->$nmjns]);
				$institusihelper->push($institusi);
			}

			$helper->push([
				'title' =>$daerah->nama_daerah,
				'value' =>$daerah->Total,
				'color'  =>$collor2[$i]?$collor2[$i]:'#DDDDDD',
				'subs'   =>[$institusihelper]
				]);
			$i++;
		}

		$return->push(['statistik'=>$helper]);

		//data statistik
		$skr    = Carbon::now('Asia/Jakarta');
		$kmrn    = Carbon::now('Asia/Jakarta')->subDay();
		$blnkmrn = Carbon::now('Asia/Jakarta')->subMonth();
		$thnkmrn = Carbon::now('Asia/Jakarta')->subYear();
		$helper = collect();

		$jmlhr = DB::select("SELECT CASE 
			WHEN DAY(`created_at`)=:skr AND MONTH(`created_at`)=:blnskr AND YEAR(`created_at`)=:thnskr THEN 'skr' 
			WHEN DAY(`created_at`)=:kmrn AND MONTH(`created_at`)=:blnkmrn AND YEAR(`created_at`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END AS hr,
			COUNT(CASE 
			WHEN DAY(`created_at`)=:skr AND MONTH(`created_at`)=:blnskr AND YEAR(`created_at`)=:thnskr THEN 'skr' 
			WHEN DAY(`created_at`)=:kmrn AND MONTH(`created_at`)=:blnkmrn AND YEAR(`created_at`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END) AS totalhr,
			COUNT(*) as total
			FROM instansi 
			GROUP BY hr ORDER BY hr ASC",['skr'=>$skr->day,'blnskr'=>$skr->month,'thnskr'=>$skr->year,'kmrn'=>$kmrn->day,'blnkmrn'=>$kmrn->month,'thnkmrn'=>$kmrn->year]);

		foreach ($jmlhr as $data) {
			$helper->push([$data->hr=>$data->totalhr]);
		}

		$jmlbln = DB::select("SELECT CASE 
			WHEN YEAR(`created_at`)=:thnskr AND MONTH(`created_at`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`created_at`)=:thnkmrn AND MONTH(`created_at`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END AS bln,
			COUNT(CASE 
			WHEN YEAR(`created_at`)=:thnskr AND MONTH(`created_at`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`created_at`)=:thnkmrn AND MONTH(`created_at`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END) AS totalbln
			FROM instansi 
			GROUP BY bln ORDER BY bln ASC",['blnskr'=>$skr->month,'thnskr'=>$skr->year,'blnkmrn'=>$blnkmrn->month,'thnkmrn'=>$blnkmrn->year]);

		foreach ($jmlbln as $data) {
			$helper->push([$data->bln=>$data->totalbln]);
		}

		$jmlthn = DB::select("SELECT CASE 
			WHEN YEAR(`created_at`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`created_at`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END AS thn,
			COUNT(CASE 
			WHEN YEAR(`created_at`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`created_at`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END) AS totalthn
			FROM instansi 
			GROUP BY thn ORDER BY thn ASC",['thnskr'=>$skr->year,'thnkmrn'=>$thnkmrn->year]);

		foreach ($jmlthn as $data) {
			$helper->push([$data->thn=>$data->totalthn]);
		}

		$total = DB::select("SELECT COUNT(*) AS total FROM instansi");

		$helper->push(['total'=>$total[0]->total]);
		$return->push(['jumlah'=>$helper->collapse()]);

		return response()->json($return);
	}

	public function getPasien()
	{
		$return = collect();
		$helper = collect();
		$collor = ['#FF9E01','#B0DE09','#F8FF01','#04D215','#1AC570','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#C51AC5','#C51A70'];

		// data piechart
		$listpasien =DB::select("SELECT
			COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS positif,
			COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS negatif,
			COUNT(CASE WHEN hasil IS NULL THEN 1 END) AS kosong
			FROM vpasien", []);

		foreach ($listpasien as $pasien) {
			$helper->push(['title' =>'TB Positif','value' =>$pasien->positif,'color' =>$collor[0]]);
			$helper->push(['title' =>'TB Negatif','value' =>$pasien->negatif,'color' =>$collor[1]]);
			$helper->push(['title' =>'Blm diperiksa','value' =>$pasien->kosong,'color' =>$collor[2]]);
		}

		$return->push(['total'=>$helper]);

		// data barchart
		$statistik = DB::select("SELECT DATE_FORMAT(`created_at`,'%Y-%m') AS bln,
			COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS positif,
			COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS negatif,
			COUNT(CASE WHEN hasil IS NULL THEN 1 END) AS kosong,
			COUNT(*) AS total
			FROM vpasien
			GROUP BY DATE_FORMAT(`created_at`,'%Y-%m') 
			DESC LIMIT 6", []);

		$statistik = array_values(array_sort($statistik, function ($value) {
			return $value->bln;
		}));

		$return->push(['statistik'=>$statistik]);

		//data statistik
		$skr    = Carbon::now('Asia/Jakarta');
		$kmrn    = Carbon::now('Asia/Jakarta')->subDay();
		$blnkmrn = Carbon::now('Asia/Jakarta')->subMonth();
		$thnkmrn = Carbon::now('Asia/Jakarta')->subYear();
		$helper = collect();

		$jmlhr = DB::select("SELECT CASE 
			WHEN DAY(`created_at`)=:skr AND MONTH(`created_at`)=:blnskr AND YEAR(`created_at`)=:thnskr THEN 'skr' 
			WHEN DAY(`created_at`)=:kmrn AND MONTH(`created_at`)=:blnkmrn AND YEAR(`created_at`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END AS hr,
			COUNT(CASE 
			WHEN DAY(`created_at`)=:skr AND MONTH(`created_at`)=:blnskr AND YEAR(`created_at`)=:thnskr THEN 'skr' 
			WHEN DAY(`created_at`)=:kmrn AND MONTH(`created_at`)=:blnkmrn AND YEAR(`created_at`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END) AS totalhr,
			COUNT(*) as total
			FROM pasien GROUP BY hr ORDER BY hr ASC",['skr'=>$skr->day,'blnskr'=>$skr->month,'thnskr'=>$skr->year,'kmrn'=>$kmrn->day,'blnkmrn'=>$kmrn->month,'thnkmrn'=>$kmrn->year]);

		foreach ($jmlhr as $data) {
			$helper->push([$data->hr=>$data->totalhr]);
		}

		$jmlbln = DB::select("SELECT CASE 
			WHEN YEAR(`created_at`)=:thnskr AND MONTH(`created_at`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`created_at`)=:thnkmrn AND MONTH(`created_at`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END AS bln,
			COUNT(CASE 
			WHEN YEAR(`created_at`)=:thnskr AND MONTH(`created_at`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`created_at`)=:thnkmrn AND MONTH(`created_at`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END) AS totalbln
			FROM pasien GROUP BY bln ORDER BY bln ASC",['blnskr'=>$skr->month,'thnskr'=>$skr->year,'blnkmrn'=>$blnkmrn->month,'thnkmrn'=>$blnkmrn->year]);

		foreach ($jmlbln as $data) {
			$helper->push([$data->bln=>$data->totalbln]);
		}

		$jmlthn = DB::select("SELECT CASE 
			WHEN YEAR(`created_at`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`created_at`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END AS thn,
			COUNT(CASE 
			WHEN YEAR(`created_at`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`created_at`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END) AS totalthn
			FROM pasien GROUP BY thn ORDER BY thn ASC",['thnskr'=>$skr->year,'thnkmrn'=>$thnkmrn->year]);

		foreach ($jmlthn as $data) {
			$helper->push([$data->thn=>$data->totalthn]);
		}

		$total = DB::select("SELECT COUNT(*) AS total FROM pasien");

		$helper->push(['total'=>$total[0]->total]);
		$return->push(['jumlah'=>$helper->collapse()]);

		return response()->json($return);
	}

	public function getSampel()
	{
		$return = collect();
		$helper = collect();
		$collor = ['#FF9E01','#B0DE09','#F8FF01','#04D215','#1AC570','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#C51AC5','#C51A70'];

		// data piechart
		$listSampel =DB::select("SELECT
			COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS positif,
			COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS negatif
			FROM vperiksa", []);

		foreach ($listSampel as $sampel) {
			$helper->push(['title' =>'TB Positif','value' =>$sampel->positif,'color' =>$collor[0]]);
			$helper->push(['title' =>'TB Negatif','value' =>$sampel->negatif,'color' =>$collor[1]]);
		}

		$return->push(['total'=>$helper]);

		// data serialchart
		$statistik = DB::select("SELECT DATE_FORMAT(`tgl_periksa`,'%Y-%m') AS bln,
			COUNT(CASE WHEN hasil='TB Positif' THEN 1 END) AS positif,
			COUNT(CASE WHEN hasil='TB Negatif' THEN 1 END) AS negatif,
			COUNT(CASE WHEN hasil IS NULL THEN 1 END) AS kosong,
			COUNT(*) AS total
			FROM vperiksa
			GROUP BY DATE_FORMAT(`tgl_periksa`,'%Y-%m') 
			DESC LIMIT 6", []);

		$statistik = array_values(array_sort($statistik, function ($value) {
			return $value->bln;
		}));

		$return->push(['statistik'=>$statistik]);

		//data statistik
		$skr    = Carbon::now('Asia/Jakarta');
		$kmrn    = Carbon::now('Asia/Jakarta')->subDay();
		$blnkmrn = Carbon::now('Asia/Jakarta')->subMonth();
		$thnkmrn = Carbon::now('Asia/Jakarta')->subYear();
		$helper = collect();

		$jmlhr = DB::select("SELECT CASE 
			WHEN DAY(`tgl_periksa`)=:skr AND MONTH(`tgl_periksa`)=:blnskr AND YEAR(`tgl_periksa`)=:thnskr THEN 'skr' 
			WHEN DAY(`tgl_periksa`)=:kmrn AND MONTH(`tgl_periksa`)=:blnkmrn AND YEAR(`tgl_periksa`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END AS hr,
			COUNT(CASE 
			WHEN DAY(`tgl_periksa`)=:skr AND MONTH(`tgl_periksa`)=:blnskr AND YEAR(`tgl_periksa`)=:thnskr THEN 'skr' 
			WHEN DAY(`tgl_periksa`)=:kmrn AND MONTH(`tgl_periksa`)=:blnkmrn AND YEAR(`tgl_periksa`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END) AS totalhr,
			COUNT(*) as total
			FROM periksa GROUP BY hr ORDER BY hr ASC",['skr'=>$skr->day,'blnskr'=>$skr->month,'thnskr'=>$skr->year,'kmrn'=>$kmrn->day,'blnkmrn'=>$kmrn->month,'thnkmrn'=>$kmrn->year]);

		foreach ($jmlhr as $data) {
			$helper->push([$data->hr=>$data->totalhr]);
		}

		$jmlbln = DB::select("SELECT CASE 
			WHEN YEAR(`tgl_periksa`)=:thnskr AND MONTH(`tgl_periksa`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`tgl_periksa`)=:thnkmrn AND MONTH(`tgl_periksa`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END AS bln,
			COUNT(CASE 
			WHEN YEAR(`tgl_periksa`)=:thnskr AND MONTH(`tgl_periksa`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`tgl_periksa`)=:thnkmrn AND MONTH(`tgl_periksa`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END) AS totalbln
			FROM periksa GROUP BY bln ORDER BY bln ASC",['blnskr'=>$skr->month,'thnskr'=>$skr->year,'blnkmrn'=>$blnkmrn->month,'thnkmrn'=>$blnkmrn->year]);

		foreach ($jmlbln as $data) {
			$helper->push([$data->bln=>$data->totalbln]);
		}

		$jmlthn = DB::select("SELECT CASE 
			WHEN YEAR(`tgl_periksa`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`tgl_periksa`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END AS thn,
			COUNT(CASE 
			WHEN YEAR(`tgl_periksa`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`tgl_periksa`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END) AS totalthn
			FROM periksa GROUP BY thn ORDER BY thn ASC",['thnskr'=>$skr->year,'thnkmrn'=>$thnkmrn->year]);

		foreach ($jmlthn as $data) {
			$helper->push([$data->thn=>$data->totalthn]);
		}

		$total = DB::select("SELECT COUNT(*) AS total FROM periksa");

		$helper->push(['total'=>$total[0]->total]);
		$return->push(['jumlah'=>$helper->collapse()]);

		return response()->json($return);
	}

	public function getKuisioner()
	{
		$return = collect();
		$helper = collect();
		$collor = ['#FF9E01','#B0DE09','#F8FF01','#04D215','#1AC570','#0D8ECF','#0D52D1','#2A0CD0','#8A0CCF','#CD0D74','#C51AC5','#C51A70'];

		// data piechart
		$listkuisioner =DB::select("SELECT
			COUNT(CASE WHEN kuisioner=0 THEN TRUE END) AS tanpa_kuisioner,
			COUNT(CASE WHEN kuisioner=1 THEN TRUE END) AS mengisi_kuisioner
			FROM pasien", []);

		foreach ($listkuisioner as $kuisioner) {
			$helper->push(['title' =>'Bkn Responden','value' =>$kuisioner->tanpa_kuisioner,'color' =>$collor[0]]);
			$helper->push(['title' =>'Responden','value' =>$kuisioner->mengisi_kuisioner,'color' =>$collor[1]]);
		}

		$return->push(['total'=>$helper]);

		// data serialchart
		$statistik = DB::select("SELECT DATE_FORMAT(`created_at`,'%Y-%m') AS bln,
			COUNT(*) AS total
			FROM vkuisioner
			GROUP BY DATE_FORMAT(`created_at`,'%Y-%m') 
			DESC LIMIT 6", []);

		$statistik = array_values(array_sort($statistik, function ($value) {
			return $value->bln;
		}));

		$return->push(['statistik'=>$statistik]);

		//data statistik
		$skr    = Carbon::now('Asia/Jakarta');
		$kmrn    = Carbon::now('Asia/Jakarta')->subDay();
		$blnkmrn = Carbon::now('Asia/Jakarta')->subMonth();
		$thnkmrn = Carbon::now('Asia/Jakarta')->subYear();
		$helper = collect();

		$jmlhr = DB::select("SELECT CASE 
			WHEN DAY(`created_at`)=:skr AND MONTH(`created_at`)=:blnskr AND YEAR(`created_at`)=:thnskr THEN 'skr' 
			WHEN DAY(`created_at`)=:kmrn AND MONTH(`created_at`)=:blnkmrn AND YEAR(`created_at`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END AS hr,
			COUNT(CASE 
			WHEN DAY(`created_at`)=:skr AND MONTH(`created_at`)=:blnskr AND YEAR(`created_at`)=:thnskr THEN 'skr' 
			WHEN DAY(`created_at`)=:kmrn AND MONTH(`created_at`)=:blnkmrn AND YEAR(`created_at`)=:thnkmrn THEN 'kmrn' 
			ELSE 'z' END) AS totalhr,
			COUNT(*) as total
			FROM kuisioner GROUP BY hr ORDER BY hr ASC",['skr'=>$skr->day,'blnskr'=>$skr->month,'thnskr'=>$skr->year,'kmrn'=>$kmrn->day,'blnkmrn'=>$kmrn->month,'thnkmrn'=>$kmrn->year]);

		foreach ($jmlhr as $data) {
			$helper->push([$data->hr=>$data->totalhr]);
		}

		$jmlbln = DB::select("SELECT CASE 
			WHEN YEAR(`created_at`)=:thnskr AND MONTH(`created_at`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`created_at`)=:thnkmrn AND MONTH(`created_at`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END AS bln,
			COUNT(CASE 
			WHEN YEAR(`created_at`)=:thnskr AND MONTH(`created_at`)=:blnskr THEN 'blnskr'
			WHEN YEAR(`created_at`)=:thnkmrn AND MONTH(`created_at`)=:blnkmrn THEN 'blnkmrn'
			ELSE 'z' END) AS totalbln
			FROM kuisioner GROUP BY bln ORDER BY bln ASC",['blnskr'=>$skr->month,'thnskr'=>$skr->year,'blnkmrn'=>$blnkmrn->month,'thnkmrn'=>$blnkmrn->year]);

		foreach ($jmlbln as $data) {
			$helper->push([$data->bln=>$data->totalbln]);
		}

		$jmlthn = DB::select("SELECT CASE 
			WHEN YEAR(`created_at`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`created_at`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END AS thn,
			COUNT(CASE 
			WHEN YEAR(`created_at`)=:thnskr THEN 'thnskr'
			WHEN YEAR(`created_at`)=:thnkmrn THEN 'thnkmrn'
			ELSE 'z' END) AS totalthn
			FROM kuisioner GROUP BY thn ORDER BY thn ASC",['thnskr'=>$skr->year,'thnkmrn'=>$thnkmrn->year]);

		foreach ($jmlthn as $data) {
			$helper->push([$data->thn=>$data->totalthn]);
		}

		$total = DB::select("SELECT COUNT(DISTINCT pasien_id) AS total FROM kuisioner");

		$helper->push(['total'=>$total[0]->total]);
		$return->push(['jumlah'=>$helper->collapse()]);

		return response()->json($return);
	}
}
