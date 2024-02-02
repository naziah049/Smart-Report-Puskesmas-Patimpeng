<table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
    <thead>
        <tr>
            <th colspan="10" style="text-align: center; font-size: 14px; border: 1px solid black;"><b>Data Report Keluhan Pasien</b></th>
        </tr>
        <tr>
            <th style="text-align: center; border: 1px solid black;">No</th>
            <th style="width: 20; border: 1px solid black;">Jenis Pemeriksaan</th>
            <th style="width: 30; border: 1px solid black;">Pasien</th>
            <th style="width: 30; border: 1px solid black;">Dokter</th>
            <th style="width: 35; border: 1px solid black;">Keluhan</th>
            <th style="width: 15; border: 1px solid black;">Perlu Rujukan</th>
            <th style="width: 30; border: 1px solid black;">Resep</th>
            <th style="width: 30; border: 1px solid black;">Jadwal</th>
            <th style="width: 30; border: 1px solid black;">Estimasi Jam</th>
            <th style="width: 30; border: 1px solid black;">Tanggal Input Keluhan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
            <tr>
                <td style="text-align: center; border: 1px solid black;">{{ $loop->iteration }}</td>
                <td style="border: 1px solid black;">
                    @if ($item->is_online == 1)
                        Online
                    @else
                        Offline
                    @endif
                </td>
                <td style="border: 1px solid black;">{{ $item->user->name }}</td>
                <td style="border: 1px solid black;">{{ $item->dokter->name }}</td>
                <td style="border: 1px solid black;">{{ $item->keluhan }}</td>
                <td style="border: 1px solid black;">{{ $item->parah }}</td>
                <td style="border: 1px solid black;">{{ $item->resep }}</td>
                <td style="border: 1px solid black;">{{ $item->nomor_antrian }}</td>
                <td style="border: 1px solid black;">{{ $item->estimasi_jam }}</td>
                <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($item->created_at)->isoFormat('D MMMM Y') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
