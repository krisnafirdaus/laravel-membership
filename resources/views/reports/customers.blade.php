@foreach($customers as $customer)
    {{ $customer->Nama }} - {{ $customer->membership->Nama }}
@endforeach
