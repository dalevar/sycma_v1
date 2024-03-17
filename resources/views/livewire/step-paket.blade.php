    <div class="card">
        <div class="card-title">
            <h4 class="mb-0 mt-4 text-center fw-semibold">Pilih Paket</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col px-auto">
                    <form wire:submit.prevent="nextStep">
                        @foreach ($packages as $paket => $value)
                            <label class="my-1">
                                <div class="card mx-0 card-default" style="border-radius: 10px">
                                    <div class="card-body py-3 container">
                                        <div class="row flex-nowrap">
                                            <div class="col-2 mt-2">
                                                <div class="checkmark">
                                                    <input type="radio" name="product"
                                                        class="product card-input-element"
                                                        id="product-{{ $paket }}" value="{{ $value->id }}"
                                                        wire:model="selectedPackage">

                                                    <svg class="checked-icon displayNone"
                                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24"
                                                        style="fill: rgb(0, 136, 255);transform: ;msFilter:;">
                                                        <path
                                                            d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm-1.999 14.413-3.713-3.705L7.7 11.292l2.299 2.295 5.294-5.294 1.414 1.414-6.706 6.706z">
                                                        </path>
                                                    </svg>

                                                    <svg class='default-icon' xmlns="http://www.w3.org/2000/svg"
                                                        width="24" height="24" viewBox="0 0 24 24"
                                                        style="fill: rgba(233, 233, 233);transform: ;msFilter:;">
                                                        <path
                                                            d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                                                        </path>
                                                        <path
                                                            d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="col-10" style="color: rgb(20,59,94)">
                                                <h5 class="mb-0">Paket {{ $value->nama_product }}</h5>
                                                <p class="mb-0">
                                                    @if ($value->nama_product == 'Ultra Free')
                                                        Paket gratis untuk kebutuhan absensi
                                                    @else
                                                        Paket lengkap untuk kebutuhan absensi
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </label>
                        @endforeach

                        {{-- <label class="my-1">
                        <input type="radio" name="product" wire:model="selectedPackageId" class="card-input-element"
                            value="Ultra Attendance">
                        <div class="card mx-0 card-default card-ultra_free" style="border-radius: 10px">
                            <div class="card-body py-3 container">
                                <div class="row flex-nowrap">
                                    <div class="col-2 mt-2">
                                        <div class="checkmark">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24"
                                                style="fill: rgba(233, 233, 233);transform: ;msFilter:;">
                                                <path
                                                    d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z">
                                                </path>
                                                <path
                                                    d="M9.999 13.587 7.7 11.292l-1.412 1.416 3.713 3.705 6.706-6.706-1.414-1.414z">
                                                </path>
                                            </svg>
                                        </div>

                                    </div>
                                    <div class="col-10" style="color: rgb(20,59,94)">
                                        <h5 class="mb-0">Paket Ultra Attendance</h5>
                                        <p class="mb-0">
                                            Paket lengkap untuk kebutuhan absensi
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </label> --}}
                        <div class="btn btn-block py-3 px-3 mt-4 rounded">
                            <a href="#">Lihat semua paket <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24"
                                    style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;">
                                    <path
                                        d="m11.293 17.293 1.414 1.414L19.414 12l-6.707-6.707-1.414 1.414L15.586 11H6v2h9.586z">
                                    </path>
                                </svg></a>
                        </div>
                </div>
            </div>
            {{-- INFORMASI HARGA, PAJAK, DISKON --}}
            <div class="row">
                <div class="col px-0">
                    <div class="card" style="width: 100%; box-shadow: none;">
                        <div class="card-body px-0 py-0 mt-2">
                            <hr class="border-dashed mb-4">
                            </hr>
                            <!-- Iterasi melalui paket yang dipilih -->
                            <div class="row mb-1 px-3">
                                <div class="col-md-6 px-0">
                                    <span class="fw-semibold">Paket <span id="nama-paket" class="fw-bold"></span></span>
                                </div>
                                <div class="col-md-6 px-0 text-end">
                                    <span class="fw-bold" id="harga">Rp. 0</span>
                                </div>
                            </div>
                            <div class="row mb-1 px-3">
                                <div class="col-md-6 px-0">
                                    <span class="fw-semibold">Pajak <span id="persence"></span></span>
                                </div>
                                <div class="col-md-6 px-0 text-end">
                                    <span class="fw-bold" id="tax">0%</span>
                                </div>
                            </div>
                            <div class="row mb-1 px-3">
                                <div class="col-md-6 px-0">
                                    <span class="fw-semibold">Diskon <span id="persence-disc"></span></span>
                                </div>
                                <div class="col-md-6 px-0 text-end">
                                    <span class="fw-bold" id="diskon">0%</span>
                                </div>
                            </div>
                            <hr class="border-dashed mb-4">
                            </hr>
                            <div class="row mb-1 px-3">
                                <div class="col-md-6 px-0">
                                    <span class="fw-semibold">Total</span>
                                </div>
                                <div class="col-md-6 px-0 text-end">
                                    <span class="fw-bold" id="total">Rp. 0</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary d-grid w-100" wire:click="firstStepSubmit"
                                type="button">Lanjutkan Pendaftaran</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <small class="text-center mt-2">Dengan menyelesaikan pendaftaran berarti Anda telah menyetujui
        Syarat
        dan Ketentuan
        serta
        Kebijakan Privasi Sycma Attendance yang berlaku.</small>

    <script>
        function getPaket(url, id) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    id: id
                },
                success: function(data) {
                    $('#nama-paket').html(data.nama_product);

                    let pajakAsPercentage = parseFloat(data.pajak);
                    let diskonAsPercentage = parseFloat(data.diskon);
                    let taxAmount = (pajakAsPercentage / 100) * Number(data.harga);
                    let diskonAmount = (diskonAsPercentage / 100) * Number(data.harga);

                    // Hapus tanda kurang pada baris di bawah ini
                    let totalHarga = Number(data.harga) + taxAmount - diskonAmount;

                    // Display harga tanpa diskon
                    $('#harga').html('Rp. ' + new Intl.NumberFormat('id-ID', {
                        maximumSignificantDigits: 3
                    }).format(data.harga));

                    // Display persentase pajak dan diskon
                    $('#persence').html(pajakAsPercentage + '%');
                    $('#persence-disc').html(diskonAsPercentage + '%');

                    // Display pajak dengan formatting
                    $('#tax').html('Rp. ' + new Intl.NumberFormat('id-ID', {
                        maximumSignificantDigits: 3
                    }).format(taxAmount));

                    // Display diskon dengan formatting
                    $('#diskon').html('Rp. ' + new Intl.NumberFormat('id-ID', {
                        maximumSignificantDigits: 3
                    }).format(diskonAmount));

                    // Display total harga setelah diskon dan pajak
                    $('#total').html('Rp. ' + new Intl.NumberFormat('id-ID', {
                        maximumSignificantDigits: 4
                    }).format(totalHarga));
                }


            });
        }

        $(document).ready(function() {
            $('.product').click(function() {
                var id = $(this).val();
                var url = "{{ route('product-select') }}";
                getPaket(url, id);
            });

            // Fungsi card paket
            $('.card-input-element').change(function() {
                // Remove any existing selected class from other cards
                $('.card').removeClass('card-default-selected');
                $('.checked-icon').addClass('displayNone');
                $('.default-icon').removeClass('displayNone');

                if ($(this).is(':checked')) {
                    var $card = $(this).closest('.card');
                    $card.addClass('card-default-selected');
                    $card.find('.checked-icon').removeClass('displayNone');
                    $card.find('.default-icon').addClass('displayNone');
                }
            });

        });
    </script>
