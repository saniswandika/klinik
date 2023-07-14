    <div class="container">
        <h1>Data Gizi Bayi</h1>

        <!-- Form tambah data -->
        <form method="POST" action="{{ route('baby_nutrition.predict') }}">
            @csrf
            <div class="form-group">
                <label for="usia">Usia</label>
                <input type="number" name="usia" id="usia" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="berat_badan">Berat Badan</label>
                <input type="number" step="0.01" name="berat_badan" id="berat_badan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="panjang_badan">Tinggi Badan</label>
                <input type="number" step="0.01" name="panjang_badan" id="panjang_badan" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="status_gizi">Status Gizi</label>
                <input type="text" name="status_gizi" id="status_gizi" class="form-control" required>
            </div> --}}
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <hr>

        <!-- Tampilkan data gizi bayi -->
        {{-- <table class="table">
            <thead>
                <tr>
                    <th>Usia</th>
                    <th>Berat Badan</th>
                    <th>Tinggi Badan</th>
                    <th>Jenis Kelamin</th>
                    <th>Status Gizi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($giziBayi as $bayi)
                    <tr>
                        <td>{{ $bayi->usia }}</td>
                        <td>{{ $bayi->berat_badan }}</td>
                        <td>{{ $bayi->tinggi_badan }}</td>
                        <td>{{ $bayi->jenis_kelamin }}</td>
                        <td>{{ $bayi->status_gizi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table> --}}
    {{-- </div> --}}
{{-- @endsection --}}
