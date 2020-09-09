@extends('layouts.layout')

@section('content')

    <section class="vestidos-a-medida">
        <div class="container">
        <form action="{{url('/paypal/pay')}}">
                <div class="row">
                    <div class="col-12 col-md-5 h-condensed">
                        <h5 class="step p-1 mb-4 bg-light"> Detalles de facturación </h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Nombre*</label>
                                <input type="text" class="form-control" name="name" value={{Auth::user()->name}}>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Apellido*</label>
                                <input type="text" class="form-control" name="lastname" value={{Auth::user()->lastname}}>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nombre de la empresa<span> (opcional)</span></label>
                                <input type="text" class="form-control" name="company">
                            </div>
                            <div class="col-md-6"></div><!-- Este col es para hacer el espacio al costado -->
                            <div class="form-group col-md-6">
                                <label>Pais Región*</label>
                                <input type="text" class="form-control" name="country">
                            </div>
                            <div class="col-md-6"></div><!-- Este col es para hacer el espacio al costado -->
                            <div class="form-group col-md-6">
                                <label>Dirección de la calle*</label>
                                <input type="text" class="form-control" name="address">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Piso*</label>
                                <input type="text" class="form-control" name="floor">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Código postal*</label>
                                <input type="text" class="form-control" name="code">
                            </div>
                            <div class="col-md-6"></div><!-- Este col es para hacer el espacio al costado -->
                            <div class="form-group col-md-6">
                                <label>Localidad / ciudad* </label>
                                <input type="text" class="form-control" name="city">
                            </div>
                            <div class="col-md-6"></div><!-- Este col es para hacer el espacio al costado -->
                            <div class="form-group col-md-6">
                                <label>Provincia*</label>
                                <input type="text" class="form-control" name="province">
                            </div>
                            <div class="col-md-6"></div><!-- Este col es para hacer el espacio al costado -->
                            <div class="form-group col-md-6">
                                <label>Teléfono* </label>
                                <input type="text" class="form-control" name="phone">
                            </div>
                            <div class="col-md-6"></div><!-- Este col es para hacer el espacio al costado -->
                            <div class="form-group col-md-6">
                                <label>Dirección de correo electrónico*</label>
                                <input type="email" class="form-control" name="email" value={{Auth::user()->email}}>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Nota del pedido ( opcional)</label>
                                <textarea class="form-control" name="note" rows="4"></textarea>
                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                    <div class="col-12 col-md-2"></div>
                    <div class="col-12 col-md-5 h-condensed">
                        <div class="row">
                            <div class="col-4 bg-light mb-3">
                                <p class="mb-0 py-1 bold"> Producto </p>
                            </div>
                            <div class="col-4 bg-light mb-3">
                                <p class="mb-0 py-1 bold"> Subtotal </p>
                            </div>
                            <div class="col-4 bg-light mb-3">
                                <p class="mb-0 py-1 bold"> Acciones </p>
                            </div>
                        </div>
                        @foreach ($detalles as $item)
                            <div data-toggle="collapse" href="#collapse{{$item->id}}" aria-expanded="false"
                                aria-controls="collapse">
                                <div class="row">
                                    <div class="col-4 mb-1">
                                        <p class="mb-0 py-1">Vestido: {{$item->productorName}} </p>
                                    </div>
                                    <div class="col-4 mb-1">
                                        <p class="mb-0 py-1"> ${{$item->totalPrice}} </p>
                                    </div>
                                    
                                       
                                        <div class="col-4 mb-1">
                                            
                                            <a 
                                                onclick="borratpedido({{$item->id}})"
                                                class="btn h-condensed btn-generic" 
                                                type="submit"
                                            >
                                            Quitar</a>
                                        </div>
                                    
                                </div>
                            </div>
                            <div  style="background-color: #ecf0f1" class="row collapse" id="collapse{{$item->id}}">
                                <div class="col-8 mb-1">
                                    <p class="mb-0 py-1">Vestido: {{$item->productorName}} </p>
                                </div>
                                <div class="col-4 mb-1">
                                    <p class="mb-0 py-1"> ${{$item->productPrice}} </p>
                                </div>
                               @if ($item->bretName)
                               <div class="col-8 mb-1">
                                <p class="mb-0 py-1">Bretel: {{$item->bretName}}</p>
                            </div>
                            <div class="col-md-4 mb-1">
                                <p class="mb-0 py-1"> ${{$item->bretPrice}} </p>
                            </div>
                               @endif
                                <div class="col-8 mb-1">
                                    <p class="mb-0 py-1"> Subtotal </p>
                                </div>
                                <div class="col-4 mb-1">
                                    <p class="mb-0 py-1"> ${{$item->totalPrice}} </p>
                                </div>
                                <div class="col-8 mb-1">
                                    <p class="mb-0 py-1"> Impuestos </p>
                                </div>
                                <div class="col-4 mb-1">
                                    <p class="mb-0 py-1"> $0.00 </p>
                                </div>
                                <div class="col-8 mb-1">
                                    <p class="mb-0 py-1 bold"> Total </p>
                                </div>
                                <div class="col-md-4 mb-1">
                                    <p class="mb-0 py-1 bold"> ${{$item->totalPrice}} </p>
                                </div>
                            </div>

                        @endforeach
                        <div class="row card-payment">
                            <div class="col-md-12 mb-4">
                                <input class="form-check-input" type="radio" name="payment-method" id="card" value="card">
                                <label class="form-check-label" for="card">
                                    Tarjeta de crédito o débito
                                    <span class="logos-pagos visa"><img class="img-fluid"
                                            src="{{ asset('assets/images/PNG/logo-visa.png') }}" /></span>
                                </label>

                            </div>
                            <div class="col-md-12 mb-4">
                                <input class="form-check-input" type="radio" name="payment-method" id="mercado-pago"
                                    value="mercado-pago">
                                <label class="form-check-label" for="mercado-pago">
                                    Mercado Pago
                                </label>
                            </div>
                            <div class="col-md-12 mb-4">
                                <input class="form-check-input" type="radio" name="payment-method" id="paypal"
                                    value="paypal">
                                <label class="form-check-label" for="paypal">
                                    Paypal
                                    <span class="logos-pagos paypal"><img class="img-fluid"
                                            src="{{ asset('assets/images/PNG/logo-paypal.png') }}" /></span>
                                </label>

                                <a class="paypal-link" href="https://www.paypal.com/ar/home" target="_blank">¿Qué es
                                    Paypal?</a>
                            </div>
                            <div class="col-md-12 mb-4">
                                <input class="form-check-input" type="checkbox" value="" id="terminos" checked>
                                <label class="form-check-label" for="terminos">
                                    He leído y estoy de acuerdo con los<br>términos y condiciones de la web*
                                </label>
                            </div>

                            <button type="submit" class="btn h-condensed btn-generic">REALIZAR EL PEDIDO</button>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </section>

    <script>
        function borratpedido(id){
            window.location = "borrarPedido/"+id;
        }
    </script>

@endsection
