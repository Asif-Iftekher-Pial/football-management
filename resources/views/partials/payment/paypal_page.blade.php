@extends('master.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">


                <div id="paypal-button-container-P-49L33337L23055829MXYFE6Y"></div>  
                {{-- paypal button --}}



            </div>
        </div>
        
    </div>
@endsection

@section('script')

{{-- Do javascript work from here ->>>  --}}

<script src="https://www.paypal.com/sdk/js?client-id=sb&vault=true&intent=subscription" data-sdk-integration-source="button-factory"></script>
<script>
paypal.Buttons({
    style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'subscribe'
    },
    createSubscription: function(data, actions) {
        return actions.subscription.create({
        /* Creates the subscription */
        plan_id: 'P-49L33337L23055829MXYFE6Y'
        });
    },
    onApprove: function(data, actions) {
        alert(data.subscriptionID); // You can add optional success message for the subscriber here
    }
}).render('#paypal-button-container-P-49L33337L23055829MXYFE6Y'); // Renders the PayPal button
</script>

{{-- End here --}}
@endsection