@include('Admin::datatable.header')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                @isset($filters)
                <div class="card-header border-bottom">
                    <h4 class="card-title">{{__('Advanced Search')}}</h4>
                </div>
                <!--Search Form -->
                <div class="card-body mt-2">
                    <form class="dt_adv_search" action="#">
                        <div class="row">
                            @foreach($filters as $name => $filter)
                            <div class="col-md-6 col-lg-4 col-12">
                                @switch($filter['type'])
                                @case('select')
                                <x-forms.select :fill="$filter" />
                                @break
                                @default
                                <x-forms.input :fill="$filter" />
                                @endswitch
                            </div>
                            @endforeach
                            <div class="col-12">
                                <button class="btn btn-info" type="submit">{{__('Search')}}</button>
                                <button class="btn btn-secondary" type="reset">{{__('Clear')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
                <hr class="my-0" />
                @endisset
                {{$dataTable->table()}}
            </div>
        </div>
    </div>
@endsection
