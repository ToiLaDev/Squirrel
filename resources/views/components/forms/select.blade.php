<div class="{{ $containerClass }}">
    @if($layout == 'horizontal')
    <div class="col-sm-{{$col[0]}}">
    @endif
    <label class="form-label" for="{{$prefixId}}-{{$name}}">{{ __($title) }}</label>
    @if($layout == 'horizontal')
    </div>
    <div class="col-sm-{{$col[1]}}">
    @endif
        <select
            id="{{$prefixId}}-{{$name}}"
            name="{{$name}}{{$multiple?'[]':''}}"
            class="form-select {{ $class }} @error($name) is-invalid @enderror"
            @if($disabled)
            disabled
            @endif
            @if($multiple)
            multiple
            @endif
            @if(is_array($datas))
            @foreach($datas as $key => $val)
            data-{{$key}}="{{$val}}"
            @endforeach
            @endif
        >
            @if($slot->isEmpty())
                @isset($default)
                    <option value="">{{ __($default) }}</option>
                @endisset
                @foreach($options as $option)
                    @php
                        if (is_string($option)) {
                            $option = [
                                'title' => ucfirst($option),
                                'value' => $option
                            ];
                        }
                    @endphp
                    <option
                        value="{{$option['value']}}"
                        @if($multiple?in_array($option['value'], $value):$value === $option['value'])
                            selected
                        @endif
                    >{{$option['title']}}</option>
                @endforeach
            @else
                {!! $slot !!}
            @endif
        </select>
    @if($layout == 'horizontal')
    </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
