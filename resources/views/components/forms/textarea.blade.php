<div class="{{ $containerClass }}">
    @if($layout == 'horizontal')
    <div class="col-sm-{{$col[0]}}">
    @endif
    <label class="form-label" for="{{$prefixId}}-{{$name}}">
        {{ __($title) }}
        @if($required)
            <span class="text-danger">*</span>
        @endif
    </label>
    @if($layout == 'horizontal')
    </div>
    <div class="col-sm-{{$col[1]}}">
    @endif
    <textarea
        id="{{$prefixId}}-{{$name}}"
        name="{{$name}}"
        class="form-control @error($name) is-invalid @enderror"
        @isset($placeholder)
        placeholder="{{ $placeholder }}"
        @endisset
        @if($disabled)
        disabled
        @endif
        @if($required)
        required
            @endif
    >{!! old($name, $value) !!}</textarea>
    @if($layout == 'horizontal')
    </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
