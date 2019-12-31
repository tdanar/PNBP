@extends('layout')
@section('content')
<div class="clear"></div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1 style="font-size:30px; font-family:nerismed;">PERATURAN TERKAIT PENERIMAAN NEGARA BUKAN PAJAK</h1>
            <div class="table-responsive">
                <table border="0" cellspacing="0" cellpadding="0" style="border: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th style="width: 43px; background-color: #003366; color: #fff;"><p align="center"><span style="color: #fff;">NO</span></p></th>
                            <th style="width: 762px; background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">URAIAN</span></p></th>
                            <th style="width: 230px; background-color: #003366; color: #ffffff;"><p align="center"><span style="color: #fff;">LINK</span></p></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($peraturan as $index => $value)
                            @php
                                if(($index+1) % 2 == 0){
                                    $back = "background-color: #bababa;";
                                }else{
                                    $back = "background-color: #ededed;";
                                }
                            @endphp
                            <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; {{$back}}"><p>{{$index+1}}.</p></td>
                            <td style="width: 762px; {{$back}}">{{$value->judul}}<br/>{{$value->uraian}}</td>
                            <td style="width: 230px; {{$back}}"><a href="{{$value->link}}"><p align="center">Klik di Sini</p></a></td>
                            </tr>
                        @endforeach

                        {{-- <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>2.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Instruksi Presiden Nomor 4 Tahun 2018 tentang Peningkatan Pengawasan Penerimaan Pajak atas Belanja Pemerintah dan Penerimaan Negara Bukan Pajak</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/4TAHUN2018INPRES.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>3.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 3 Tahun 2018 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Keuangan</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/3TAHUN2018PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>4.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 5 Tahun 2016 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Lembaga Administrasi Negara</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/5TAHUN2016PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>5.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 5 Tahun 2019 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Mahkamah Agung dan Badan Peradilan yang berada di bawahnya</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/5TAHUN2019PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>6.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 8 Tahun 2019 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Badan Tenaga Nuklir Nasional</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/8TAHUN2019PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>7.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 11 Tahun 2012 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Badan Kepegawaian Negara</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/11TAHUN2012PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>8.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 15 Tahun 2016 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Perhubungan</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/15TAHUN20016PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>9.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 30 Tahun 2018 tentang Perubahan PP Nomor 5 Tahun 2016 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Lembaga Administrasi Negara</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/30TAHUN2018PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>10.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 31 Tahun 2017 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Perdagangan</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/31TAHUN2017PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>11.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 32 Tahun 2017 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Badan Pengawas Obat dan Makanan</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/32TAHUN2017PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>12.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 33 Tahun 2017 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Lembaga Penyiaran Publik Televisi Republik Indonesia</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/33TAHUN2017PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>13.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 35 Tahun 2016 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Pertanian</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/35TAHUN2016PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>14.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 37 Tahun 2018 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak di Bidang Usaha Pertambangan Mineral</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/37TAHUN2018PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>15.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 42 Tahun 2018 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Ketenagakerjaan</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/42TAHUN2018PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>16.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Pemerintah Nomor 45 Tahun 2016 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Hukum dan Hak Asasi Manusia</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/45TAHUN2016PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>17.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Pemerintah Nomor 60 Tahun 2016 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kepolisian Negara Republik Indonesia</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/60TAHUN2016PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>18.</p></td>
                            <td style="width: 562px; background-color: #bababa">Peraturan Pemerintah Nomor 65 Tahun 2012 tentang Jenis dan Tarif atas Jenis Penerimaan Negara Bukan Pajak yang Berlaku pada Kementerian Tenaga Kerja dan Transmigrasi</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/Peraturan%20Pemerintah/65TAHUN2012PP.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p>19.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Menteri Keuangan Nomor 194/PMK.02/2018 tentang Tata Cara Pengelolaan PNBP dari Penyelenggaraan Jaminan Kesehatan Nasional pada Fasilitas Kesehatan Tingkat Pertama dan Fasilitas Kesehatan Rujukan Tingkat Lanjutan Milik Pemerintah Pusat</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/PMK/194~PMK.02~2018Per.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #bababa;"><p>20.</p></td>
                            <td style="width: 562px; background-color: #bababa;">Peraturan Menteri Keuangan Nomor 203/PMK.02/2018 tentang Perubahan Kedua atas PMK Nomor 124/PMK.02/2016 tentang Petunjuk Teknis Akuntansi PNBP dari Kegiatan Hulu Minyak dan Gas Bumi</td>
                            <td style="width: 430px; background-color: #bababa;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/PMK/203~PMK.02~2018Per.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr>
                        <tr valign="top">
                            <td class="rtecenter" style="; text-align: center; width: 43px; background-color: #ededed;"><p></p>21.</p></td>
                            <td style="width: 562px; background-color: #ededed;">Peraturan Menteri Keuangan Nomor 204/PMK.02/2018 tentang Perubahan atas PMK Nomor 221/PMK.02/2017 tentang Petunjuk Teknis Akuntansi PNBP dari Kegiatan Usaha Panas Bumi</td>
                            <td style="width: 430px; background-color: #ededed;"><a href="http://repo.portalitjen.depkeu.go.id/filerepo/Inspektorat%20V/Portal%20Pengawasan%20PNBP/Peraturan%20PNBP/PMK/204~PMK.02~2018Per.pdf"><p align="center">Klik di Sini</p></a></td>
                        </tr> --}}
                    </tbody>
                    </table>
            </div>
        </div>
    </div>
</div>
@endsection
