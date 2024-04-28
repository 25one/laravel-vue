@extends('product.layout')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('styles/cart_responsive.css') }}">
<style>
.listbuttonremove {
	margin: 10px;   
}
</style>    
@endsection

@section('main')

        <div class="cart_section">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="cart_container">
                            
                            <script>
                                window.carts = @json($carts); //!!!variable from php to js in blade
                            </script>                              

                            <!-- !!!Cart block -->
                            <div class="cart_block">
                                                               
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div> 

@endsection

@section('js')
<script src="{{ mix('js/cart.js') }}"></script> <!-- !!!cart.js -->
<script>

</script>
@endsection