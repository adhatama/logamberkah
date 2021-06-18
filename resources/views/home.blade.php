<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logam Berkah</title>

    <link rel="stylesheet" type="text/css" href="/semantic/semantic.min.css">

    <style>
        .ui.green {
            background-color: #10B981;
        }

        #hero h1.ui.header {
            font-size: 3.7rem;
        }

        #hero h1.ui.header .sub.header {
            font-size: 1.7rem;
        }

        #hero .statistic .label {
            text-transform: none;
            font-size: 1.1em;
        }
    </style>
</head>

<body>
    <div id="hero" class="ui inverted raised green segment"
        style="margin-top: 4rem; margin-bottom: 4rem; padding: 4rem;">
        <div class="ui two column stackable grid container">
            <div class="middle aligned column">
                <h1 class="ui inverted header">
                    Logam Berkah
                    <div class="sub header">Beli emas tak pernah se-syariah ini</div>
                </h1>
                <div class="ui section divider"></div>
                <div class="ui small inverted statistics" style="margin-top: 2rem;">
                    <div class="statistic" style="padding-right: 1em">
                        <div class="value">
                            {{ price_format($hargaKamiJualEmasCerticard1Gr->harga) }}
                        </div>
                        <div class="label">
                            Harga Kami Jual / gr
                        </div>
                    </div>
                    <div class="statistic">
                        <div class="value">
                            {{ price_format($hargaKamiBeliEmasCerticard1Gr->harga) }}
                        </div>
                        <div class="label">
                            Harga Kami Beli / gr
                        </div>
                    </div>
                </div>
                <p style="margin-top: 1.5rem">Terakhir diperbarui: <strong>17 Juni 2021 10:00</strong></p>
            </div>
            <div class="column">
                <div class="ui raised padded compact segment">
                    <div class="ui two column grid">
                        <div class="column">
                            <h3>Simulator Emas Certicard</h3>

                            <table class="ui very compact padded very basic table">
                                <tbody>
                                    @foreach ($hargaKamiJualEmasCerticardList as $row)
                                    <tr>
                                        <td class="four wide">{{ $row->gram }} gram</td>
                                        <td class="five wide">{{ price_format($row->harga, 'Rp') }}</td>
                                        <td class="three wide">
                                            <div class="ui fluid tiny input">
                                                <input class="input-gram" data-harga="{{ $row->harga }}" type="text" value="0" style="text-align: center" oninput="calculateTotal()">
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="ui list">
                                <div class="item">
                                    <h4>Total Gram: <span id="total-gram">0</span> gram</h4>
                                </div>
                                <div class="item">
                                    <h4>Total: Rp<span id="total-harga">0</span></h4>
                                </div>
                            </div>
                        </div>
                        <div class="column">
                            <h3>Catatan</h3>
                            <div class="ui bulleted relaxed list">
                                <div class="item">Harga LM dapat berubah setiap saat tanpa pemberitahuan terlebih dahulu
                                </div>
                                <div class="item">Simulasi perhitungan di atas hanya berupa ilustrasi saja</div>
                                <div class="item">Untuk kepastian harga & ketersediaan LM silakan hubungi petugas kami
                                </div>
                            </div>

                            <button class="ui green button" style="margin-top: 2rem">
                                Transaksi via WhatsApp Sekarang!
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- You MUST include jQuery before Fomantic -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.3.1/dist/jquery.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.8.7/dist/semantic.min.js"></script> --}}
    <script src="/semantic/semantic.min.js"></script>

    <script>
        var total = 0;
        function calculateTotal(harga) {
            let totalGram = 0;
            let totalHarga = 0;
            $('.input-gram').each(function (item) {
                totalGram += parseInt($(this).val())
                totalHarga += $(this).data('harga') * $(this).val()
            })

            totalGram = totalGram ? totalGram : 0
            totalHarga = totalHarga ? totalHarga : 0
            // var nf = new Intl.NumberFormat();
            // $('#total-gram').html(nf.format(totalGram))
            // $('#total-harga').html(nf.format(totalHarga))
            $('#total-gram').html(totalGram.toLocaleString('id-ID'))
            $('#total-harga').html(totalHarga.toLocaleString('id-ID'))
        }
    </script>
</body>

</html>
