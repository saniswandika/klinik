<!DOCTYPE html>
<html>
<head>
    <title>Tabel Entropy dan Gain</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Tabel Entropy dan Gain</h1>
    
    <table>
        <tr>
            <th>Atribut</th>
            <th>Entropy</th>
            <th>Gain</th>
        </tr>
        <tr>
            <td>Berat Badan</td>
            <td id="berat_badan_entropy"></td>
            <td id="berat_badan_gain"></td>
        </tr>
        <tr>
            <td>Tinggi Badan</td>
            <td id="tinggi_badan_entropy"></td>
            <td id="tinggi_badan_gain"></td>
        </tr>
    </table>

    <script>
        // Fetch data dari backend menggunakan JavaScript (misalnya dengan menggunakan library Axios)
        axios.get('/get_entropy_gain_data')
            .then(function (response) {
                // Ambil data entropy dan gain dari response JSON
                const data = response.data;
                
                // Isi nilai entropy dan gain ke dalam tabel
                document.getElementById('berat_badan_entropy').textContent = data.berat_badan_entropy;
                document.getElementById('berat_badan_gain').textContent = data.berat_badan_gain;
                document.getElementById('tinggi_badan_entropy').textContent = data.tinggi_badan_entropy;
                document.getElementById('tinggi_badan_gain').textContent = data.tinggi_badan_gain;
            })
            .catch(function (error) {
                console.log(error);
            });
    </script>
</body>
</html>
