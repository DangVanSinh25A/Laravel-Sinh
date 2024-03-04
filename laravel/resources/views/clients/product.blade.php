@extends ('layouts.client')
@section('title')
{{$title}}
@endsection

@section ('sidebar')
    @parent
<h3>Product Sidebar</h3>
@endsection

@section('content')
<h1>Sản phẩm</h1>
<x-package-alert></x-package-alert>
@push('scripts')
<script>
    console.log('push 2')
</script>
@endpush
@endsection

@section('css')

@endsection

@section ('js')

@endsection

@push('scripts')
<script>
    console.log('push')
</script>
@endpush