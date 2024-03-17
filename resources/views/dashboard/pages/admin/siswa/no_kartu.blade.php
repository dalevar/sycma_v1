<label for="no_kartu" class="form-label">No. Kartu</label>
<input type="text" id="no_kartu_input" class="form-control" name="no_kartu" value="{{ $nokartu }}" />
@error('no_kartu')
    <div class="invalid-feedback">
        {{ $message }}
    </div>
@enderror
