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
            <div class="form-check form-switch @if(!empty($type)) form-check-{{$type}} @endif">
                <input
                    type="checkbox"
                    class="form-check-input {{ $class }}"
                    id="{{$prefixId}}-{{$name}}"
                    name="{{$name}}"
                    @if($disabled)
                    disabled
                    @endif
                    @if($required)
                    required
                    @endif
                    @if($checked)
                    checked
                    @endif
                    value="1"
                    @if(is_array($datas))
                    @foreach($datas as $key => $val)
                    data-{{$key}}="{{$val}}"
                    @endforeach
                    @endif
                />
                @if(!empty($placeholder) || !empty($iconLeft) || !empty($iconRight))
                <label class="form-check-label" for="{{$prefixId}}-{{$name}}">
                    @notEmpty($iconLeft)
                    <span class="switch-icon-left"><i class="{{$iconLeft}}"></i></span>
                    @endNotEmpty
                    @notEmpty($iconRight)
                    <span class="switch-icon-right"><i class="{{$iconRight}}"></i></span>
                    @endNotEmpty
                    {{ $placeholder }}
                </label>
                @endif
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
