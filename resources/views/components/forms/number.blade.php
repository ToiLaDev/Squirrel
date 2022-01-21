@styles('page', asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')))
@scripts('page', asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')))
@push('page-scripts')
    <script type="text/javascript">
        $(function () {
            $('#{{$prefixId}}-{{$name}}').TouchSpin({
                step: {{ __($step) }},
                decimals: {{ __($decimals) }},
                @if($min !== null)
                min: {{ __($min) }},
                @endif
                @if($max !== null)
                max: {{ __($max) }},
                @endif
                @if($postfix !== null)
                postfix: '{{ __($postfix) }}',
                @endif
                @if($prefix !== null)
                prefix: '{{ __($prefix) }}',
                @endif
                buttondown_class: '{{ __($downClass) }}',
                buttonup_class: '{{ __($upClass) }}',
                buttondown_txt: '<i class="{{ __($downIcon) }}"></i>',
                buttonup_txt: '<i class="{{ __($upIcon) }}"></i>'
            });
        });
    </script>
@endpush
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
            <div class="input-group @if($disabled) disabled-touchspin @endif">
                <input
                    type="number"
                    id="{{$prefixId}}-{{$name}}"
                    name="{{$name}}"
                    value="{{ old($name, $value) }}"
                    class="{{ $class }}"
                    @if($disabled)
                    disabled
                    @endif
                    @if($required)
                    required
                    @endif
                    @if(is_array($datas))
                    @foreach($datas as $key => $val)
                    data-{{$key}}="{{$val}}"
                    @endforeach
                    @endif
                />
            </div>
            @if($layout == 'horizontal')
        </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
