<section id="accordion-with-margin">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Margin</h4>
                </div>
                <div class="card-body">
                    <p class="card-text">
                        To create accordion with margin use <code>.accordion-margin</code> class as a wrapper for your accordion
                        header.
                    </p>
                    <div class="accordion accordion-margin" id="accordionMargin">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMarginOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginOne" aria-expanded="false" aria-controls="accordionMarginOne">
                                    Accordion Item 1
                                </button>
                            </h2>
                            <div id="accordionMarginOne" class="accordion-collapse collapse" aria-labelledby="headingMarginOne" data-bs-parent="#accordionMargin">
                                <div class="accordion-body">
                                    Pastry pudding cookie toffee bonbon jujubes jujubes powder topping. Jelly beans gummi bears sweet roll
                                    bonbon muffin liquorice. Wafer lollipop sesame snaps. Brownie macaroon cookie muffin cupcake candy
                                    caramels tiramisu. Oat cake chocolate cake sweet jelly-o brownie biscuit marzipan. Jujubes donut
                                    marzipan chocolate bar. Jujubes sugar plum jelly beans tiramisu icing cheesecake.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMarginTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginTwo" aria-expanded="false" aria-controls="accordionMarginTwo">
                                    Accordion Item 2
                                </button>
                            </h2>
                            <div id="accordionMarginTwo" class="accordion-collapse collapse" aria-labelledby="headingMarginTwo" data-bs-parent="#accordionMargin">
                                <div class="accordion-body">
                                    Sweet pie candy jelly. Sesame snaps biscuit sugar plum. Sweet roll topping fruitcake. Caramels
                                    liquorice biscuit ice cream fruitcake cotton candy tart. Donut caramels gingerbread jelly-o
                                    gingerbread pudding. Gummi bears pastry marshmallow candy canes pie. Pie apple pie carrot cake.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMarginThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginThree" aria-expanded="false" aria-controls="accordionMarginThree">
                                    Accordion Item 3
                                </button>
                            </h2>
                            <div id="accordionMarginThree" class="accordion-collapse collapse" aria-labelledby="headingMarginThree" data-bs-parent="#accordionMargin">
                                <div class="accordion-body">
                                    Tart gummies dragée lollipop fruitcake pastry oat cake. Cookie jelly jelly macaroon icing jelly beans
                                    soufflé cake sweet. Macaroon sesame snaps cheesecake tart cake sugar plum. Dessert jelly-o sweet
                                    muffin chocolate candy pie tootsie roll marzipan. Carrot cake marshmallow pastry. Bonbon biscuit
                                    pastry topping toffee dessert gummies. Topping apple pie pie croissant cotton candy dessert tiramisu.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingMarginFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionMarginFour" aria-expanded="false" aria-controls="accordionMarginFour">
                                    Accordion Item 4
                                </button>
                            </h2>
                            <div id="accordionMarginFour" class="accordion-collapse collapse" aria-labelledby="headingMarginFour" data-bs-parent="#accordionMargin">
                                <div class="accordion-body">
                                    Cheesecake muffin cupcake dragée lemon drops tiramisu cake gummies chocolate cake. Marshmallow tart
                                    croissant. Tart dessert tiramisu marzipan lollipop lemon drops. Cake bonbon bonbon gummi bears topping
                                    jelly beans brownie jujubes muffin. Donut croissant jelly-o cake marzipan. Liquorice marzipan cookie
                                    wafer tootsie roll. Tootsie roll sweet cupcake.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('page-script')
<script src="{{asset(mix('js/scripts/components/components-accordion.js'))}}"></script>
@endsection