@styles('vendor', [
    asset(mix('vendors/css/editors/quill/katex.min.css')),
    asset(mix('vendors/css/editors/quill/monokai-sublime.min.css')),
    asset(mix('vendors/css/editors/quill/quill.snow.css'))
])
@scripts('vendor', [
    asset(mix('vendors/js/editors/quill/katex.min.js')),
    asset(mix('vendors/js/editors/quill/highlight.min.js')),
    asset(mix('vendors/js/editors/quill/quill.min.js')),
    asset(mix('js/scripts/quill-imageBrowser.js'))
])
@push('page-scripts')
    <script type="text/javascript">
        $(function () {
            let {{$prefixId}}Editor = new Quill('#{{$prefixId}}-editor .editor', {
                bounds: '#{{$prefixId}}-editor .editor',
                modules: {
                    formula: true,
                    syntax: true,
                    imageBrowser: {
                        url: '{{ route('admin.media.window', ['type'=>'image']) }}'
                    },
                    toolbar: [
                        [
                            {
                                font: []
                            },
                            {
                                size: []
                            }
                        ],
                        ['bold', 'italic', 'underline', 'strike'],
                        [
                            {
                                color: []
                            },
                            {
                                background: []
                            }
                        ],
                        [
                            {
                                script: 'super'
                            },
                            {
                                script: 'sub'
                            }
                        ],
                        [
                            {
                                header: '1'
                            },
                            {
                                header: '2'
                            },
                            'blockquote',
                            'code-block'
                        ],
                        [
                            {
                                list: 'ordered'
                            },
                            {
                                list: 'bullet'
                            },
                            {
                                indent: '-1'
                            },
                            {
                                indent: '+1'
                            }
                        ],
                        [
                            'direction',
                            {
                                align: []
                            }
                        ],
                        ['link', 'image', 'video', 'formula'],
                        ['clean']
                    ]
                },
                theme: 'snow'
            });
            const content = {{$prefixId}}Editor.getContents();

            {{$prefixId}}Editor.on('text-change', function () {
                $('#{{$prefixId}}-{{$name}}').val({{$prefixId}}Editor.root.innerHTML);
            });

            $('#{{$prefixId}}-editor .editor').parents('form').on('resetForm', function (e) {
                {{$prefixId}}Editor.setContents(content);
            });

        });
    </script>
@endpush
<div class="{{ $containerClass }}">
    <label class="form-label">{{ __($title) }}</label>
    <textarea
        id="{{$prefixId}}-{{$name}}"
        name="{{$name}}"
        class="hidden"
    >{!! old($name, $value) !!}</textarea>
    <div id="{{$prefixId}}-editor" @error($name) class="is-invalid" @enderror>
        <div class="editor">{!! old($name, $value) !!}</div>
    </div>
    @error($name)
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
