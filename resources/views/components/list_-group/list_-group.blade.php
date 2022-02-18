
<section id="list-group-tabs">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List Group Navigation</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        You can activate a list group navigation without writing any JavaScript by simply specifying
                        <code> data-bs-toggle="list"</code> or on an element. Use these data attributes on
                        <code>.list-group-item</code>.
                    </p>
                    <div class="row mt-1">
                        <div class="col-md-4 col-sm-12">
                            <div class="list-group" id="list-tab" role="tablist">
                            @foreach($options as $key => $option)
                                @if (is_string($option))
                                <a class="list-group-item list-group-item-action @if($key == 0) {{'active'}} @endif" id="{{$option->id}}" data-bs-toggle="list" href="{{$option->href}}" role="tab" aria-controls="{{$option->aria_controls}}">{{__($option->title) }}</a>
                                @endif
                            @endforeach
                                <!-- <a class="list-group-item list-group-item-action" id="list-profile-list" data-bs-toggle="list" href="#list-profile" role="tab" aria-controls="list-profile">Profile</a>
                                <a class="list-group-item list-group-item-action" id="list-messages-list" data-bs-toggle="list" href="#list-messages" role="tab" aria-controls="list-messages">Messages</a>
                                <a class="list-group-item list-group-item-action" id="list-settings-list" data-bs-toggle="list" href="#list-settings" role="tab" aria-controls="list-settings">Settings</a> -->
                            </div>
                        </div>
                        <div class="col-md-8 col-sm-12 mt-1">
                            <div class="tab-content" id="nav-tabContent">
                            @foreach($options as $key => $option)
                                @if (is_string($option))
                                <div class="tab-pane fade show active" id="{{$option->aria_controls}}" role="tabpanel" aria-labelledby="{{$option->aria_controls}}-list">
                                {{__($option->description) }}
                                </div>
                                @endif
                            @endforeach
                                <!-- <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">
                                    <p class="card-text">
                                        Jelly beans topping I love chocolate cake. Lemon drops jujubes jelly I love I love marshmallow
                                        gummies icing. Liquorice jelly-o lemon drops sugar plum.Bear claw chupa chups soufflé tart carrot
                                        cake dessert. I love tiramisu I love marzipan candy canes brownie marshmallow wafer. I love sugar
                                        plum cheesecake gummi bears I love pudding halvah gummi bears.
                                    </p>
                                    <p class="card-text">
                                        I love donut dragée cupcake. Tootsie roll tart soufflé tart powder sesame snaps lollipop. Jelly
                                        beans tart macaroon I love biscuit. I love danish cheesecake sugar plum dragée croissant I love
                                        danish.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
                                    <p class="card-text">
                                        Dragée dessert sweet roll chocolate bar. Gummi bears I love dragée pie I love. Cake pastry I love
                                        cookie.
                                    </p>
                                    <p class="card-text">
                                        Wafer cheesecake cheesecake. Pastry bonbon chocolate pastry pudding topping sweet roll lollipop. I
                                        love macaroon gummi bears cookie topping chocolate bar carrot cake.Sweet roll pastry chocolate cake
                                        tiramisu dessert marzipan pudding cake. Cake macaroon danish jelly beans I love chocolate cookie
                                        sugar plum. Jelly beans chocolate cake sugar plum carrot cake.
                                    </p>
                                </div>
                                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-settings-list">
                                    <p class="card-text">
                                        Muffin apple pie fruitcake. Chocolate cake chocolate cake oat cake I love soufflé brownie. I love
                                        marshmallow topping marshmallow I love.
                                    </p>
                                    <p class="card-text">
                                        Caramels chocolate lollipop marshmallow croissant jelly beans jelly donut I love. Gummies toffee
                                        marshmallow ice cream biscuit. Candy sweet cupcake.Sugar plum cotton candy cupcake chocolate cake
                                        candy liquorice biscuit. Icing powder biscuit dragée gummies fruitcake I love. Sweet jelly-o
                                        fruitcake powder. Dessert gummi bears cake gingerbread tiramisu cake I love caramels dessert.
                                    </p>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>