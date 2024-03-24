<div>
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step">
                <a href="#step-1" type="button"
                    class="btn btn-circle {{ $currentStep == 1 ? 'btn-primary' : 'btn-default bg-primary' }}">
                    {!! $currentStep != 1
                        ? "<i class='bx bx-check-circle' style='font-size: 36px; color: white;'></i>"
                        : "<i class='bx bx-package' style='font-size: 36px; color: white;'></i>" !!}
                </a>
                <p>Pilih Paket</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-2" type="button"
                    class="btn btn-circle {{ $currentStep >= 2 ? 'btn-primary' : 'btn-default' }}">
                    @if ($currentStep == 1)
                        <i class='bx bx-user-circle text-light' style='font-size: 36px;'></i>
                    @elseif ($currentStep == 2)
                        <i class='bx bx-user-circle' style='font-size: 36px; color: white;'></i>
                    @else
                        <i class='bx bx-check-circle' style='font-size: 36px; color: white;'></i>
                    @endif
                </a>
                <p>Daftar Akun</p>
            </div>
            <div class="stepwizard-step">
                <a href="#step-3" type="button"
                    class="btn btn-circle {{ $currentStep == 3 ? 'btn-primary' : 'btn-default' }}"
                    disabled="disabled">{!! $currentStep < 3
                        ? "<i class='bx bx-badge-check text-light' style='font-size: 36px;'></i>"
                        : "<i class='bx bx-check-circle' style='font-size: 36px;'></i>" !!}</a>
                <p>Selesai</p>
            </div>
        </div>
    </div>
    <div class="row setup-content {{ $currentStep != 1 ? 'displayNone' : '' }}" id="step-1">
        @include('livewire.step-paket')
    </div>

    <div class="row setup-content {{ $currentStep != 2 ? 'displayNone' : '' }}" id="step-2">
        @include('livewire.step-akun')
    </div>

    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @include('livewire.step-selesai')
    </div>
</div>
