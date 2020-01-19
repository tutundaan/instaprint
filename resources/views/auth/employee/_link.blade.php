<label class="label-control" for="">SPK Kesalahan atas nama</label>
<select class="form-control" name="holder">
    @foreach($failures as $failure)
        <option value="{{ $failure->holder }}">{{ $failure->holder }}</option>
    @endforeach
</select>
