@styles('page', asset(mix('css/base/plugins/form-image.css')))
@push('page-scripts')
<script type="text/javascript">
    $(function () {
        let {{$prefixId}}{{$name}}Value=[];
        $('#{{$prefixId}}-{{$name}} input').map(function() {
            {{$prefixId}}{{$name}}Value.push(this.value);
        });

        const {{$prefixId}}{{$name}}AddImage = (url) => {
            $(`<li>
                <input type="hidden" name="{{$name}}{{$multiple?'[]':''}}" value="${url}">
                <i class="fa fa-times"></i>
                <div>
                    <img src="${url}" />
                </div>
            </li>`).insertBefore('#{{$prefixId}}-{{$name}} li.add');
        };

        $('#{{$prefixId}}-{{$name}} li > span').on('click', function (e) {
            const browserWindow = window.open('{{ $url }}','Images Browser','height=700,width=1200');
            browserWindow.addEventListener('mediaSelected', function (e) {
                @if($multiple)
                e.detail.forEach(media => {
                    {{$prefixId}}{{$name}}AddImage(media.url);
                });
                @else
                    $('#{{$prefixId}}-{{$name}} li:not(.add)').remove();
                    {{$prefixId}}{{$name}}AddImage(e.detail[0].url);
                @endif
            });
        });
        $(document).on('click', '#{{$prefixId}}-{{$name}} li .fa-times', function (e) {
            $(this).parent().remove();
        });

        $('#{{$prefixId}}-{{$name}}').parents('form').on('resetForm', function (e) {
            if ({{$prefixId}}{{$name}}Value.length > 0) {
                $('#{{$prefixId}}-{{$name}} li:not(.add)').remove();
                {{$prefixId}}{{$name}}Value.forEach(url => {{$prefixId}}{{$name}}AddImage(url));
            }
        });
    });
</script>
@endpush
<div class="{{ $containerClass }}" id="{{$prefixId}}-{{$name}}">
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
    <ul class="form-image">
        @foreach((array)$value as $url)
        <li>
            <input type="hidden" name="{{$name}}{{$multiple?'[]':''}}" value="{{ $url }}">
            <i class="fa fa-times"></i>
            <div>
                <img src="{{ $url }}" />
            </div>
        </li>
        @endforeach
        <li class="add">
            <span>
                <i class="fa fa-camera"></i>
            </span>
        </li>
    </ul>
    @if($layout == 'horizontal')
    </div>
    @endif
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
