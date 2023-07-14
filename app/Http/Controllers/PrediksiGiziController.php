<?php

namespace App\Http\Controllers;

use App\Models\data_bayi;
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
        // Validasi input
        $validatedData = $request->validate([
            'berat_badan' => 'required|numeric',
            'panjang_badan' => 'required|numeric',
            'usia' => 'required|integer',
            'jenis_kelamin' => 'required',
        ]);
    
        // Ambil dataset dari database
        $dataset = GiziBayi::all()->toArray();
    
        // Atribut prediktor yang digunakan untuk membangun pohon keputusan
        $attributes = ['berat_badan', 'panjang_badan'];
    
        // Atribut target yang ingin diprediksi
        $targetAttribute = 'berat_badan';
    
        // Hitung entropy awal
        $entropy = $this->hitungEntropy($dataset, $targetAttribute);
    
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
        // dd($bestAttribute);
        // Bangun pohon keputusan
        $decisionTree = $this->bangunPohonKeputusan($dataset, $attributes, $targetAttribute);
    
        // Tentukan status gizi berdasarkan pohon keputusan
        $status_gizi = $this->tentukanStatusGizi($validatedData, $decisionTree);
    
        // Simpan data bayi ke dalam tabel "data_bayi"
        data_bayi::create([
            'berat_badan' => $validatedData['berat_badan'],
            'panjang_badan' => $validatedData['panjang_badan'],
            'usia' => $validatedData['usia'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],
            'status_gizi' => $status_gizi,
        ]);
    
        return response()->json(['GiziBayi' => $status_gizi]);
    }
    
    private function hitungEntropy($dataset, $targetAttribute)
    {
        $totalExamples = count($dataset);
        $categories = [];
    
        // Hitung jumlah contoh untuk setiap kategori pada atribut target
        foreach ($dataset as $data) {
            $category = $data[$targetAttribute];
            if (!isset($categories[$category])) {
                $categories[$category] = 0;
            }
            $categories[$category]++;
        }
    
        $entropy = 0;
    
        // Hitung probabilitas dan entropy
        foreach ($categories as $categoryCount) {
            $probability = $categoryCount / $totalExamples;
            $entropy -= $probability * log($probability, 2);
        }
        // dd($entropy);
        return $entropy;
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
