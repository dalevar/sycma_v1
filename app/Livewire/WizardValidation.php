<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Package;
use App\Models\Product;
use App\Models\Sekolah;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class WizardValidation extends Component
{
    use WithFileUploads;
    public $currentStep = 1;
    public $successMessage = '';
    public $name, $email, $password, $nama_sekolah, $logo_sekolah;
    public $selectedPackage;


    public function render()
    {
        $packages = Product::software()->get();

        $packageIds = [];
        foreach ($packages as $package) {
            $packageId = $package->id;
            $packageIds[] = $packageId;
        }

        $package = Product::findMany($packageIds);

        return view('livewire.wizard-validation', compact('packages', 'packageId', 'package'));
    }

    private function validateStep()
    {
        if ($this->currentStep == 1) {
            $this->validate([
                'selectedPackage' => 'required',
            ]);
        } elseif ($this->currentStep == 2) {
            $this->validate([
                'nama_sekolah' => 'required',
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'logo_sekolah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $this->logo_sekolah = $this->logo_sekolah->store('logo_sekolah', 'public');
        }
    }

    public function firstStepSubmit()
    {
        $this->validateStep();
        $this->currentStep = 2;
    }

    public function secondStepSubmit()
    {
        $this->validateStep();

        $this->currentStep = 3;

        session()->flash('success', 'Daftar akun berhasil, silahkan login');
    }

    public function submitForm()
    {
        $this->validateStep();

        $sekolah = Sekolah::create([
            'nama_sekolah' => $this->nama_sekolah,
            'logo_sekolah' => $this->logo_sekolah,
        ]);

        $sekolahId = $sekolah->id;

        User::create([
            'sekolah_id' => $sekolahId,
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'product_id' => $this->selectedPackage,
        ]);

        $this->currentStep = 3;
    }


    public function back($step)
    {
        $this->currentStep = $step;
    }

    public function getPaket(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return $product;
    }

    public function updateProductSelection($productName)
    {
        $this->product_id = $productName;
    }
}
