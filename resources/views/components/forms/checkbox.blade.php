<div class="form-check form-check-inline">
    <input
        id="{{$prefixId}}-{{$name}}"
        name="{{$name}}"
        class="form-select @error($name) is-invalid @enderror"
        type="checkbox"
        @if($disabled)
        disabled
        @endif
    >
    <label class="form-label" for="{{$prefixId}}-{{$name}}">{{ __($title) }}</label>
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
