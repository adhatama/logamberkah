<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/tailwind.css">

    <style>

    </style>
</head>

<body>
    <section class="hero py-20">
        <div class="flex items-center px-10 bg-green-500" style="height: 70vh">
            <div class="flex-1 ml-40 text-white">
                <h1 class="text-4xl font-black">
                    Logam Berkah
                </h1>
                <p class="text-2xl pt-5">
                    Beli emas tak pernah se-syariah ini
                </p>
                <div class="flex mt-5">
                    <div class="flex flex-col mr-5">
                        <div class="font-bold">Harga Kami Jual</div>
                        <div class="text-xl">Rp900.000</div>
                    </div>
                    <div class="flex flex-col">
                        <div class="font-bold">Harga Kami Beli</div>
                        <div class="text-xl">Rp840.000</div>
                    </div>
                </div>
            </div>
            <div class="flex-1">
                <div class="grid grid-cols-6 shadow-lg bg-white rounded-xl px-5 py-5">
                    <div class="col-span-3">
                        <h2 class="text-xl pb-3 font-bold">Simulator emas certicard</h2>

                        <table class="table-fixed">
                            <tbody>
                                @foreach (range(1, 8) as $row)
                                <tr>
                                    <td class="pr-10 py-1 text-left">{{ $row }} gram</td>
                                    <td class="pr-10">Rp900.000</td>
                                    <td class="">
                                        <input type="number" class="w-10 shadow-lg text-center" value="0">
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <h4 class="mt-5">Total Gram: 10 gram</h4>
                        <h4>Total: Rp100.000.000</h4>
                    </div>

                    <div class="col-span-3 mx-10">
                        <h2 class="text-md pb-3 font-bold mt-1">Catatan</h2>
                        <ul class="text-sm list-disc">
                            <li>Harga LM dapat berubah setiap saat tanpa pemberitahuan terlebih dahulu</li>
                            <li>Simulasi perhitungan di atas hanya berupa ilustrasi saja</li>
                            <li>Untuk kepastian harga & ketersediaan LM silakan hubungi petugas kami</li>
                        </ul>

                        <button class="mt-5 btn-green">
                            Transaksi via WhatsApp Sekarang!
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
