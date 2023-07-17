<?php

namespace App\Http\Controllers;

use App\Models\data_bayi;
use App\Models\data_bayi_posyandu;
use App\Models\DecisionTreeData;
use App\Models\GiziBayi;
use App\Models\vitalSign;
use Illuminate\Http\Request;

class PrediksiGiziController extends Controller
{
    public function index()
    {


        return view('baby_nutrition.index');
    }
    public function klasifikasiGiziBayi(Request $request)
    {
        // Mengambil data gizi bayi dari database
        $data = data_bayi_posyandu::all();
            
        // Lakukan perhitungan gizi bayi sesuai atribut yang diinginkan

        // Contoh perhitungan entropy total
        $totalEntropy = $this->hitungEntropyTotal($data);

        // Contoh perhitungan entropy atribut Umur
        $umurEntropy = $this->hitungEntropyUmur($data);

        // Contoh perhitungan entropy atribut Jenis Kelamin
        $jenisKelaminEntropy = $this->hitungEntropyJenisKelamin($data);

        // Contoh perhitungan entropy atribut Berat Badan
        $beratBadanEntropy = $this->hitungEntropyBeratBadan($data);

        // Contoh perhitungan entropy atribut Tinggi Badan
        $tinggiBadanEntropy = $this->hitungEntropyTinggiBadan($data);

        // Contoh perhitungan gain atribut Umur
        $gainUmur = $this->hitungGainUmur($data);

        // Contoh perhitungan gain atribut Jenis Kelamin
        $gainJenisKelamin = $this->hitungGainJenisKelamin($data);

        // Contoh perhitungan gain atribut Berat Badan
        $gainBeratBadan = $this->hitungGainBeratBadan($data);

        // Contoh perhitungan gain atribut Tinggi Badan
        $gainTinggiBadan = $this->hitungGainTinggiBadan($data);

        // ...
        $atributTertinggi = $this->cariAtributDenganGainTertinggi($gainUmur, $gainJenisKelamin, $gainBeratBadan, $gainTinggiBadan);


        // Kembalikan hasil perhitungan gizi bayi dalam bentuk respons JSON
        return response()->json([
            'total_entropy' => $totalEntropy,
            'umur_entropy' => $umurEntropy,
            'jenis_kelamin_entropy' => $jenisKelaminEntropy,
            'tinggi_badan_entropy' => $tinggiBadanEntropy,
            'berat_badan_entropy' => $beratBadanEntropy,
            'gain_umur' => $gainUmur,
            'gain_jenis_kelamin' => $gainJenisKelamin,
            'gain_tinggi_badan' => $gainTinggiBadan,
            'gain_berat_badan' => $gainBeratBadan,
            'atribut_tertinggi' =>   $atributTertinggi,
            // 'jumlah_gizi_buruk' => 'IN DEV',
            // 'jumlah_kasus_gizi_normal' => 'IN DEV',
        ]);
    }

    

    private function cariAtributDenganGainTertinggi($umurGain = 0, $jenisKelaminGain = 0, $beratBadanGain = 0, $tinggiBadanGain = 0)
    {
        $gains = [
            'umur' => $umurGain,
            'jenis_kelamin' => $jenisKelaminGain,
            'berat_badan' => $beratBadanGain,
            'tinggi_badan' => $tinggiBadanGain,
        ];
    
        // Mencari atribut dengan gain tertinggi
        $atributTertinggi = null;
        $gainTertinggi = -PHP_FLOAT_MAX;
        foreach ($gains as $atribut => $gain) {
            if ($gain > $gainTertinggi) {
                $atributTertinggi = $atribut;
                $gainTertinggi = $gain;
            }
        }
    
        return $atributTertinggi;
    }
    
    private function hitungEntropyTotal($data)
    {
        $totalData = $data->count();
    
        // Menghitung jumlah kemunculan setiap kelas (misalnya status gizi)
        $classCounts = $data->groupBy('status_gizi')->map->count();
    
        // Menghitung entropy total
        $entropyTotal = 0;
        foreach ($classCounts as $classCount) {
            $classProbability = $classCount / $totalData;
            $entropyTotal -= $classProbability * log($classProbability, 2);
        }
    
        return $entropyTotal;
    }
    private function hitungEntropyUmur($data)
    {
        $totalData = $data->count();

        // Membagi data menjadi dua kelompok berdasarkan umur
        $umurKurang23 = $data->where('Umur_bulan', '<=', 23);
        $umurLebih24 = $data->where('Umur_bulan', '>=', 24);

        // Menghitung jumlah kemunculan setiap kelas di setiap kelompok umur
        $classCountsKurang23 = $umurKurang23->groupBy('status_gizi')->map->count();
        $classCountsLebih24 = $umurLebih24->groupBy('status_gizi')->map->count();

        // Menghitung entropy setiap kelompok umur
        $entropyUmurKurang23 = $this->hitungEntropy($classCountsKurang23, $totalData);
        $entropyUmurLebih24 = $this->hitungEntropy($classCountsLebih24, $totalData);

        // Menghitung entropy atribut Umur
        $entropyUmur = ($umurKurang23->count() / $totalData) * $entropyUmurKurang23
            + ($umurLebih24->count() / $totalData) * $entropyUmurLebih24;

        return $entropyUmur;
    }

    private function hitungEntropy($classCounts, $totalData)
    {
        // dd($classCounts);
        $entropy = 0;
        foreach ($classCounts as $classCount) {
            $classProbability = $classCount / $totalData;
            $entropy -= $classProbability * log($classProbability, 2);
        }
        return $entropy;
    }
    private function hitungEntropyJenisKelamin($data)
    {
        $totalData = $data->count();

        // Menghitung jumlah kemunculan setiap kelas (misalnya status gizi) untuk setiap jenis kelamin
        $classCountsLakiLaki = $data->where('jenis_kelamin', 'L')->groupBy('status_gizi')->map->count();
        $classCountsPerempuan = $data->where('jenis_kelamin', 'P')->groupBy('status_gizi')->map->count();

        // Menghitung entropy setiap jenis kelamin
        $entropyLakiLaki = $this->hitungEntropy($classCountsLakiLaki, $totalData);
        $entropyPerempuan = $this->hitungEntropy($classCountsPerempuan, $totalData);

        // Menghitung entropy atribut Jenis Kelamin
        $entropyJenisKelamin = ($data->where('jenis_kelamin', 'L')->count() / $totalData) * $entropyLakiLaki
            + ($data->where('jenis_kelamin', 'P')->count() / $totalData) * $entropyPerempuan;

        return $entropyJenisKelamin;
    }
    private function hitungEntropyTinggiBadan($data)
    {
        $totalData = $data->count();

        // Membagi data menjadi dua kelompok berdasarkan tinggi badan
        $tinggiKurang87 = $data->where('tinggi_badan', '<=', 87);
        $tinggiLebih88 = $data->where('tinggi_badan', '>=', 88);

        // Menghitung jumlah kemunculan setiap kelas di setiap kelompok tinggi badan
        $classCountsKurang87 = $tinggiKurang87->groupBy('status_gizi')->map->count();
        $classCountsLebih88 = $tinggiLebih88->groupBy('status_gizi')->map->count();

        // Menghitung entropy setiap kelompok tinggi badan
        $entropyTinggiKurang87 = $this->hitungEntropy($classCountsKurang87, $totalData);
        $entropyTinggiLebih88 = $this->hitungEntropy($classCountsLebih88, $totalData);

        // Menghitung entropy atribut Tinggi Badan
        $entropyTinggiBadan = ($tinggiKurang87->count() / $totalData) * $entropyTinggiKurang87
            + ($tinggiLebih88->count() / $totalData) * $entropyTinggiLebih88;

        return $entropyTinggiBadan;
    }
    private function hitungEntropyBeratBadan($data)
    {
        $totalData = $data->count();

        // Membagi data menjadi dua kelompok berdasarkan berat badan
        $beratKurang10 = $data->where('Berat_Badan', '<=', 16);
        $beratLebih10 = $data->where('Berat_Badan', '>=', 16);
   
        // Menghitung jumlah kemunculan setiap kelas di setiap kelompok berat badan
        $classCountsKurang10 = $beratKurang10->groupBy('status_gizi')->map->count();
        $classCountsLebih10 = $beratLebih10->groupBy('status_gizi')->map->count();
        // dd($beratLebih10->count());

        // Menghitung entropy setiap kelompok berat badan
        $entropyBeratKurang10 = $this->hitungEntropy($classCountsKurang10, $totalData);
        $entropyBeratLebih10 = $this->hitungEntropy($classCountsLebih10, $totalData);
        // Menghitung entropy atribut Berat Badan
        $entropyBeratBadan = ($beratKurang10->count() / $totalData) * $entropyBeratKurang10
            + ($beratLebih10->count() / $totalData) * $entropyBeratLebih10;

        return $entropyBeratBadan;
    }
    private function hitungGainUmur($data)
    {
        $totalData = $data->count();

        // Menghitung entropy total
        $entropyTotal = $this->hitungEntropyTotal($data);

        // Menghitung entropy atribut Umur
        $entropyUmur = $this->hitungEntropyUmur($data);

        // Menghitung gain atribut Umur
        $gainUmur = $entropyTotal - $entropyUmur;

        return $gainUmur;
    }

    private function hitungGainJenisKelamin($data)
    {
        $totalData = $data->count();

        // Menghitung entropy total
        $entropyTotal = $this->hitungEntropyTotal($data);

        // Menghitung entropy atribut Jenis Kelamin
        $entropyJenisKelamin = $this->hitungEntropyJenisKelamin($data);

        // Menghitung gain atribut Jenis Kelamin
        $gainJenisKelamin = $entropyTotal - $entropyJenisKelamin;

        return $gainJenisKelamin;
    }

    private function hitungGainBeratBadan($data)
    {
        $totalData = $data->count();
      
        // Menghitung entropy total
        $entropyTotal = $this->hitungEntropyTotal($data);

        // Menghitung entropy atribut Berat Badan
        $entropyBeratBadan = $this->hitungEntropyBeratBadan($data);

        // Menghitung gain atribut Berat Badan
        $gainBeratBadan = $entropyTotal - $entropyBeratBadan;

        return $gainBeratBadan;
    }

    private function hitungGainTinggiBadan($data)
    {
        $totalData = $data->count();

        // Menghitung entropy total
        $entropyTotal = $this->hitungEntropyTotal($data);

        // Menghitung entropy atribut Tinggi Badan
        $entropyTinggiBadan = $this->hitungEntropyTinggiBadan($data);

        // Menghitung gain atribut Tinggi Badan
        $gainTinggiBadan = $entropyTotal - $entropyTinggiBadan;

        return $gainTinggiBadan;
    }
    
    private function hitungJumlahKasusAtributUmur($data)
    {
        $UmurbulanKurangDari23bulan = $data->where('Umur_bulan', '<=', 23)->count();
        $UmurLebihdari24bulan = $data->where('Umur_bulan', '>=',24)->count();

        return [
            'Umur bulan Kurang Dari 23 bulan' => $UmurbulanKurangDari23bulan,
            'Umur Lebih dari 24 bulan' => $UmurLebihdari24bulan,
        ];
    }

    private function hitungJumlahKasusAtributJenisKelamin($data)
    {
        $jumlahKasusLakiLaki = $data->where('jenis_kelamin', 'L')->count();
        $jumlahKasusPerempuan = $data->where('jenis_kelamin', 'P')->count();

        return [
            'Laki-laki' => $jumlahKasusLakiLaki,
            'Perempuan' => $jumlahKasusPerempuan,
        ];
    }

    private function hitungJumlahKasusAtributBeratBadan($data)
    {
        $jumlahKasusKurang10 = $data->where('Berat_Badan', '<=', 10)->count();
        $jumlahKasusLebih10 = $data->where('Berat_Badan', '>=', 10)->count();

        return [
            '<=10' => $jumlahKasusKurang10,
            '>=10' => $jumlahKasusLebih10,
        ];
    }

    private function hitungJumlahKasusAtributTinggiBadan($data)
    {
        $jumlahKasusKurang87 = $data->where('tinggi_badan', '<=', 87)->count();
        $jumlahKasusLebih88 = $data->where('tinggi_badan', '>=', 88)->count();

        return [
            '<=87' => $jumlahKasusKurang87,
            '>=88' => $jumlahKasusLebih88,
        ];
    }
    




    
    private function hitungGain($dataset, $targetAttribute, $attribute)
    {
        $totalExamples = count($dataset);
        $attributeValues = [];
    
        // Hitung jumlah contoh untuk setiap nilai pada atribut
        foreach ($dataset as $data) {
            $value = $data[$attribute];
            if (!isset($attributeValues[$value])) {
                $attributeValues[$value] = 0;
            }
            $attributeValues[$value]++;
        }
    
        $gain = $this->hitungEntropy($dataset, $targetAttribute);
    
        // Hitung gain
        foreach ($attributeValues as $valueCount) {
            $probability = $valueCount / $totalExamples;
            $subset = array_filter($dataset, function ($data) use ($attribute, $value) {
                return $data[$attribute] == $value;
            });
            $subsetEntropy = $this->hitungEntropy($subset, $targetAttribute);
            $gain -= $probability * $subsetEntropy;
        }
        // dd($gain);
        return $gain;
    }
    
    
    private function bangunPohonKeputusan($dataset, $attributes, $targetAttribute)
    {
        // Jika semua contoh dalam dataset memiliki nilai yang sama pada atribut target, return node daun dengan nilai tersebut
        $uniqueValues = array_unique(array_column($dataset, $targetAttribute));
        if (count($uniqueValues) === 1) {
            return reset($uniqueValues);
        }
    
        // Jika tidak ada atribut yang tersisa, return nilai atribut target yang paling umum
        if (count($attributes) === 0) {
            $categoryCounts = array_count_values(array_column($dataset, $targetAttribute));
            arsort($categoryCounts);
            return key($categoryCounts);
        }
    
        $bestAttribute = '';
        $bestGain = -INF;
    
        // Cari atribut dengan gain tertinggi
        foreach ($attributes as $attribute) {
            $gain = $this->hitungGain($dataset, $targetAttribute, $attribute);
            if ($gain > $bestGain) {
                $bestAttribute = $attribute;
                $bestGain = $gain;
            }
        }
    
        $node = [
            'attribute' => $bestAttribute,
            'children' => []
        ];
    
        // Pisahkan dataset berdasarkan nilai atribut terbaik
        $attributeValues = array_unique(array_column($dataset, $bestAttribute));
        foreach ($attributeValues as $value) {
            $subset = array_filter($dataset, function ($data) use ($bestAttribute, $value) {
                return $data[$bestAttribute] == $value;
            });
            $subsetAttributes = array_diff($attributes, [$bestAttribute]);
    
            $node['children'][$value] = $this->bangunPohonKeputusan($subset, $subsetAttributes, $targetAttribute);
        }
    
        return $node;
    }
    private function tentukanStatusGizi($data, $decisionTree)
    {
        while (is_array($decisionTree)) {
            $attribute = $decisionTree['attribute'];
            $value = $data[$attribute];
            
            if (isset($decisionTree['children'][$value])) {
                $decisionTree = $decisionTree['children'][$value];
            } else {
                // Jika tidak ada cabang dengan nilai atribut yang sesuai, kembalikan nilai default atau handle kasus tidak ditemukan
                return 'Nilai tidak ditemukan';
            }
        }
    
        return $decisionTree;
    }
}
