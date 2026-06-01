@php
use Carbon\Carbon; 
@endphp
@extends('admin.assets.adminlayout')
@section('content')
<div class="container-fluid">
    @if($qt_id == 1)
        @include('admin.source.question.questiontype.mcqadd')
    @endif
    @if($qt_id == 2)
        @include('admin.source.question.questiontype.emqadd')
    @endif
    @if($qt_id == 3)
        @include('admin.source.question.questiontype.flashcardadd')
    @endif
</div>
@endsection