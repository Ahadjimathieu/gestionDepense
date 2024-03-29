<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid mt-100 mb-100">
        <div id="ui-view">
            <div>
                <div class="card">
                    <div class="card-header">

                        Invoice<strong>#BBB-245432</strong>
                        <div class="pull-right">
                            <a class="btn btn-sm btn-info" href="#" data-abc="true"><i
                                    class="fa fa-print mr-1"></i> Print</a>
                            <a class="btn btn-sm btn-info" href="#" data-abc="true"><i
                                    class="fa fa-file-text-o mr-1"></i> Save</a>
                        </div>



                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-4">
                                <h6 class="mb-3">From:</h6>
                                <div><strong>BBBootstrap Inc.</strong></div>
                                <div>546 Aston Avenue</div>
                                <div>NYC, NY 12394</div>
                                <div>Email: contact@bbbootstrap.com</div>
                                <div>Phone: +1 848 389 9289</div>
                            </div>

                            <div class="col-sm-4">
                                <h6 class="mb-3">To:</h6>
                                <div><strong>Facebook Inc.</strong></div>
                                <div>345, SA Road</div>
                                <div>Cupertino CA 92154</div>
                                <div>Email: billings@facebook.com</div>
                                <div>Phone: +1 894 989 9898</div>
                            </div>

                            <div class="col-sm-4">
                                <h6 class="mb-3">Details:</h6>
                                <div>Invoice<strong> #BBB-245432</strong></div>
                                <div>March 22, 2020</div>
                                <div>VAT: BBB0909090</div>
                                <div>Account Name: BANK OF AMERICA</div>
                                <div><strong>SWIFT code: 985798579487</strong></div>
                            </div>

                        </div>

                        <div class="table-responsive-sm">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                       
                                        <th>Désignation</th>
                                        <th>Prix unitaire(m²)</th>
                                        <th class="center">Longueur</th>
                                        <th class="right">Largeur</th>
                                        <th class="right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $details as $detail )
                                        
                                  
                                    <tr>
                                    
                                        <td class="left">{{ $detail->designation }}</td>
                                        <td class="left">{{ $detail->prix }}</td>
                                        <td class="center">{{ $detail->longueur }}</td>
                                        <td class="right">{{ $detail->largeur }}</td>
                                        <td class="right">{{ $detail->total }}</td>
                                    </tr>
                                    
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-sm-5">Contrary to popular belief, Lorem Ipsum is not simply random
                                text. It has roots in a piece of classical Latin literature from 45 BC, making it over
                                2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in
                                Virginia.</div>
                            <div class="col-lg-4 col-sm-5 ml-auto">
                                <table class="table table-clear">
                                    <tbody>
                                        <tr>
                                            <td class="left"><strong>Subtotal</strong></td>
                                            <td class="right">$8500</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Discount (20%)</strong></td>
                                            <td class="right">$160</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>VAT (10%)</strong></td>
                                            <td class="right">$90</td>
                                        </tr>
                                        <tr>
                                            <td class="left"><strong>Total</strong></td>
                                            <td class="right"><strong>$9000</strong></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="pull-right">
                                    <a class="btn btn-sm btn-success" href="#" data-abc="true"><i
                                            class="fa fa-paper-plane mr-1"></i> Proceed to payment</a>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
