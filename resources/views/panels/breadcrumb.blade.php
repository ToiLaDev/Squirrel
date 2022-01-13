<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">@yield('title')</h2>
                @isset($breadcrumbs)
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        {{-- this will load breadcrumbs dynamically from controller --}}
                        @foreach ($breadcrumbs as $breadcrumb)
                            <li class="breadcrumb-item">
                                @if(isset($breadcrumb['link']))
                                    <a href="{{ $breadcrumb['link'] == 'javascript:void(0)' ? $breadcrumb['link']:url($breadcrumb['link']) }}">
                                        @endif
                                        {{$breadcrumb['name']}}
                                        @if(isset($breadcrumb['link']))
                                    </a>
                                @endif
                            </li>
                        @endforeach
                    </ol>
                </div>
                @endisset
            </div>
        </div>
    </div>
    @isset($withButton)
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
                <a class="btn btn-gradient-primary" href="{{ $withButton['route']===true?url()->previous():route($withButton['route']) }}">
                    <i data-feather="arrow-left"></i>
                    {{__($withButton['title'])}}
                </a>
            </div>
        </div>
    @endisset
</div>
