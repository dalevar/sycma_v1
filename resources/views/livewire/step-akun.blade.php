{{-- <div class="card"> --}}
<div class="card-title">
    <h4 class="mb-0 mt-4 text-center fw-semibold">Buat Akun</h4>
</div>
<div class="card-body">
    <h6 class="fw-medium">Paket : <span class="fw-bold">
            @if ($product_id = 1)
                Ultra Free
            @elseif ($product_id = 2)
                Ultra Attendance
            @endif
        </span></h6>

    <hr class="border-dashed mb-4">
    <form wire:submit.prevent="submitForm">
        <div class="mb-3">
            <label for="username" class="form-label">Nama Sekolah <span class="text-danger">*</span></label>
            <input type="text" class="form-control required-indicator" id="nama_sekolah" name="nama_sekolah"
                wire:model="nama_sekolah" placeholder="Contoh : SMK ISFI BANJARMASIN" autofocus />
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" class="form-control required-indicator" id="name" name="name"
                wire:model="name" placeholder="Contoh : admin [nama_sekolah]" autofocus />
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="email" name="email" wire:model="email"
                placeholder="Gunakan Email admin sekolah" />
        </div>
        <div class="mb-3 form-password-toggle">
            <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
            <div class="input-group input-group-merge">
                <input type="password" id="password" class="form-control" name="password" wire:model="password"
                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                    aria-describedby="password" />
                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
            </div>
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Logo Sekolah <span class="text-danger">*</span></label>
            <input class="form-control required-indicator" type="file" id="formFile" name="logo_sekolah"
                wire:model="logo_sekolah" />
            <div id="imagePreview" class=""></div>
        </div>

        <button class="btn btn-primary d-grid w-100" wire:click='secondStepSubmit'>Daftar</button>
        {{-- </form> --}}
    </form>
    <button class="btn underline" wire:click="back(1)"><i class='bx bx-left-arrow-alt'></i>Kembali</button>

</div>
{{-- </div> --}}
