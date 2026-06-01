@php
use Carbon\Carbon; 
@endphp
@extends('admin.assets.adminlayout')
@section('content')
<div class="container-fluid">
    @if($qt_id == 1)
        @include('admin.source.question.questiontype.mcqedit')
    @endif
    @if($qt_id == 2)
        @include('admin.source.question.questiontype.emqedit')
    @endif
    @if($qt_id == 3)
        @include('admin.source.question.questiontype.flashcardedit')
    @endif
</div>
@endsection