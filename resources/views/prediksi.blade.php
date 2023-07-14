<form method="POST" action="{{ route('prediksi.gizi') }}">
    @csrf
    <label for="usia">Usia:</label>
    <input type="text" name="usia" id="usia" required>

    <label for="berat_badan">Berat Badan:</label>
    <input type="text" name="berat_badan" id="berat_badan" required>

    <label for="tinggi_badan">Tinggi Badan:</label>
    <input type="text" name="tinggi_badan" id="tinggi_badan" required>

    <button type="submit">Prediksi Gizi</button>
</form>
