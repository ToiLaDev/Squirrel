<section id="basic-tabs-components">
    <div class="row match-height">
        <!-- Basic Tabs starts -->
        <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Basic Tab</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach($options as $key => $option)
                            @if (is_string($option))
                            <li class="nav-item">
                                <a class="nav-link @if($key == 0) {{'active'}} @endif" id="{{$option->id}}" data-bs-toggle="tab" href="{{$option->href}}" aria-controls="{{$option->aria_controls}}" role="tab" aria-selected="true">{{__($option->title) }}</a>
                            </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach($options as $key => $option)
                            @if (is_string($option))
                            <div class="tab-pane active" id="{{$option->aria_controls}}" aria-labelledby="{{$option->aria_controls}}-tab" role="tabpanel">
                                {{__($option->description) }}
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Basic Tabs ends -->

        <!-- Tabs with Icon starts -->
        <!-- <div class="col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Tab with icon</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="homeIcon-tab" data-bs-toggle="tab" href="#homeIcon" aria-controls="home" role="tab" aria-selected="true"><i data-feather="home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profileIcon-tab" data-bs-toggle="tab" href="#profileIcon" aria-controls="profile" role="tab" aria-selected="false"><i data-feather="tool"></i> Service</a>
                        </li>
                        <li class="nav-item">
                            <a href="disabledIcon" id="disabledIcon-tab" class="nav-link disabled"><i data-feather="eye-off"></i> Disabled</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="aboutIcon-tab" data-bs-toggle="tab" href="#aboutIcon" aria-controls="about" role="tab" aria-selected="false"><i data-feather="user"></i> Account</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="homeIcon" aria-labelledby="homeIcon-tab" role="tabpanel">
                            <p>
                                Candy canes donut chupa chups candy canes lemon drops oat cake wafer. Cotton candy candy canes marzipan
                                carrot cake. Sesame snaps lemon drops candy marzipan donut brownie tootsie roll. Icing croissant bonbon
                                biscuit gummi bears. Pudding candy canes sugar plum cookie chocolate cake powder croissant.
                            </p>
                            <p>
                                Carrot cake tiramisu danish candy cake muffin croissant tart dessert. Tiramisu caramels candy canes
                                chocolate cake sweet roll liquorice icing cupcake. Candy cookie sweet roll bear claw sweet roll.
                            </p>
                        </div>
                        <div class="tab-pane" id="profileIcon" aria-labelledby="profileIcon-tab" role="tabpanel">
                            <p>
                                Dragée jujubes caramels tootsie roll gummies gummies icing bonbon. Candy jujubes cake cotton candy.
                                Jelly-o lollipop oat cake marshmallow fruitcake candy canes toffee. Jelly oat cake pudding jelly beans
                                brownie lemon drops ice cream halvah muffin. Brownie candy tiramisu macaroon tootsie roll danish.
                            </p>
                            <p>
                                Croissant pie cheesecake sweet roll. Gummi bears cotton candy tart jelly-o caramels apple pie jelly
                                danish marshmallow. Icing caramels lollipop topping. Bear claw powder sesame snaps.
                            </p>
                        </div>
                        <div class="tab-pane" id="disabledIcon" aria-labelledby="disabledIcon-tab" role="tabpanel">
                            <p>
                                Chocolate croissant cupcake croissant jelly donut. Cheesecake toffee apple pie chocolate bar biscuit
                                tart croissant. Lemon drops danish cookie. Oat cake macaroon icing tart lollipop cookie sweet bear claw.
                            </p>
                        </div>
                        <div class="tab-pane" id="aboutIcon" aria-labelledby="aboutIcon-tab" role="tabpanel">
                            <p>
                                Gingerbread cake cheesecake lollipop topping bonbon chocolate sesame snaps. Dessert macaroon bonbon
                                carrot cake biscuit. Lollipop lemon drops cake gingerbread liquorice. Sweet gummies dragée. Donut bear
                                claw pie halvah oat cake cotton candy sweet roll. Cotton candy sweet roll donut ice cream.
                            </p>
                            <p>
                                Halvah bonbon topping halvah ice cream cake candy. Wafer gummi bears chocolate cake topping powder.
                                Sweet marzipan cheesecake jelly-o powder wafer lemon drops lollipop cotton candy.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- Tabs with Icon ends -->
    </div>
</section>
@section('page-script')
<script src="{{asset('js/scripts/components/components-navs.js')}}"></script>
@endsection