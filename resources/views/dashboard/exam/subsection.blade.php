@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('subsection')
    @php
        $Category = DB::table('exams')->select('e_name')->where('e_id', $e_id)->get();
        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
    @endphp
    <div class='container-fluid'>
        <div class="row">
            <div class="col-md-8">
                <h1 class='h3 mb-0 text-gray-800' style="color: #2572ff">{{ $CategoryName }}</h1>
            </div>
            <div class="col-md-4 mb-1" style="text-align: right;">
            </div>
        </div>
        <div style="background-color: #bebfc1; height: 4px; margin-bottom: 50px;"></div>    
        <form method="POST" action="{{ route('subsectionselected', ['e_id' => $e_id]) }}">
        @csrf
        <input type="hidden" name="e_id" value="{{ $e_id }}">
        <div class="row">
            <div class="col-md-12">
                <spam style="font-size: 20px;">Select Subsection</spam>
            </div>
        </div>
        @php
            $Category = DB::table('exams')->select('e_id','e_name')->where('e_id', $e_id)->get();
            $CLevel1 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Category->first()->e_id)->where('e_status', '1')->get();
            foreach ($CLevel1 as $Level1) {
                echo "<div class='row mt-1 mb-3'>";
                    echo "<div class='col-md-12' style='background-color: #7fb0e1; padding: 5px; border-radius: 5px;padding-top:15px;'>";
                        echo "&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level1->e_inner_level."' >&nbsp;&nbsp;".$Level1->e_name."<label>";
                    echo "</div>";
                echo "</div>";
                $CLevel2 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level1->e_id)->where('e_status', '1')->get();
                foreach ($CLevel2 as $Level2) {
                    echo "<div class='row mt-1'>";
                        echo "<div class='col-md-12'>";
                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level2->e_inner_level."' >&nbsp;&nbsp;".$Level2->e_name."<label>";
                        echo "</div>";
                    echo "</div>";
                    $CLevel3 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level2->e_id)->where('e_status', '1')->get();
                    foreach ($CLevel3 as $Level3) {
                        echo "<div class='row mt-1'>";
                            echo "<div class='col-md-12'>";
                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level3->e_inner_level."' >&nbsp;&nbsp;".$Level3->e_name."<label>";
                            echo "</div>";
                        echo "</div>";
                        $CLevel4 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level3->e_id)->where('e_status', '1')->get();
                        foreach ($CLevel4 as $Level4) {
                            echo "<div class='row mt-1'>";
                                echo "<div class='col-md-12'>";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level4->e_inner_level."' >&nbsp;&nbsp;".$Level4->e_name."<label>";
                                echo "</div>";
                            echo "</div>";
                            $CLevel5 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level4->e_id)->where('e_status', '1')->get();
                            foreach ($CLevel5 as $Level5) {
                                echo "<div class='row mt-1'>";
                                    echo "<div class='col-md-12'>";
                                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level5->e_inner_level."' >&nbsp;&nbsp;".$Level5->e_name."<label>";
                                    echo "</div>";
                                echo "</div>";
                                $CLevel6 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level5->e_id)->where('e_status', '1')->get();
                                foreach ($CLevel6 as $Level6) {
                                    echo "<div class='row mt-1'>";
                                        echo "<div class='col-md-12'>";
                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level6->e_inner_level."' >&nbsp;&nbsp;".$Level6->e_name."<label>";
                                        echo "</div>";
                                    echo "</div>";
                                    $CLevel7 = DB::table('exams')->select('e_id','e_name','e_inner_level')->where('e_level', $Level6->e_id)->where('e_status', '1')->get();
                                    foreach ($CLevel7 as $Level7) {
                                        echo "<div class='row mt-1'>";
                                            echo "<div class='col-md-12'>";
                                                echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label><input type='checkbox' name='TopicSelection[]' value='".$Level7->e_inner_level."' >&nbsp;&nbsp;".$Level7->e_name."<label>";
                                            echo "</div>";
                                        echo "</div>";
                                    }
                                }
                            }
                        }
                    }
                }
            }
        @endphp

<div class="row mt-4">
            <div class="col-md-12" style="text-align: center;">
                <button type="submit" class=" btn btn-success">Done</button>
                
                
            </div>
        </div>






        </form>
    </div>
@endsection