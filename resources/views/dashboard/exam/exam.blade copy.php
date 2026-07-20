@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('exam')
    <div class='container-fluid'>
        <h1 class='h3 mb-0 text-gray-800' style="color: #2572ff">My Exam</h1>
        <div style="background-color: #bebfc1; height: 4px; margin-bottom: 50px;"></div>
        {{-- <h2>Subscription</h2> --}}



<div id="content" class="site-content" bis_skin_checked="1">
        <div class="lp-archive-courses" bis_skin_checked="1">
            
            <div class="lp-content-area" bis_skin_checked="1">
                
                
                <ul class="learn-press-courses" data-layout="grid">
                    @foreach ($Subscribes as $Subscribe)
                    @php
                        $Category = DB::table('exams')->select('e_name','e_info')->where('e_id', $Subscribe->su_c_id)->get();
                        $CategoryName = $Category->first()->e_name ?? 'No Category Found';
                        $CategoryInfo = $Category->first()->e_info ?? 'No Info Available';
                    @endphp 
                                 
                    
                    <li id="post-1026" class="post-1026 lp_course type-lp_course status-publish has-post-thumbnail hentry course_category-computer-science course">
                        <div class="course-item" bis_skin_checked="1">
                            <div class="course-wrap-thumbnail" bis_skin_checked="1">
                                <div class="course-thumbnail" bis_skin_checked="1">
                                    <a href="showexam/{{$Subscribe->su_c_id}}" bis_skin_checked="1">
                                        <div class="thumbnail-preview" bis_skin_checked="1">
                                            <div class="thumbnail" bis_skin_checked="1">
                                                <div class="centered" bis_skin_checked="1">
                                                    <img width="370" height="280" src="https://varsity.mhrtheme.com/wp-content/uploads/2021/09/popular_item_9.png" class="attachment-500x300 size-500x300 wp-post-image" alt="Software Development" loading="lazy" title="Software Development">                
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div><!-- START .course-content --> 
                            <div class="course-content" bis_skin_checked="1">
                                <div class="course-categories" bis_skin_checked="1">
                                    <a href="showexam/{{$Subscribe->su_c_id}}" rel="tag" bis_skin_checked="1">{{$CategoryInfo}}</a>    
                                </div>
                                <span class="course-instructor">
                                    <a href="showexam/{{$Subscribe->su_c_id}}" bis_skin_checked="1"><span></span></a>
                                </span>
                                <a href="showexam/{{$Subscribe->su_c_id}}" class="course-permalink" bis_skin_checked="1">          
                                    <h3 class="course-title">{{$CategoryName}}</h3>
                                </a>
                                <!-- START .course-content-meta --> 
                                
                                <div class="separator" bis_skin_checked="1"></div>
                                <div class="course-info" bis_skin_checked="1">                                    
                                    <div class="clearfix" bis_skin_checked="1"></div>
                                    <!-- START .course-content-footer --> 
                                    <div class="course-footer" bis_skin_checked="1">
                                        <div class="course-price" bis_skin_checked="1">
                                            <span class="price">Days Left: 15</span>
                                        </div>
                                    </div> 
                                    <!-- END .course-content-footer -->      
                                    <div class="course-readmore" bis_skin_checked="1">
                                        <a href="course-details.html" bis_skin_checked="1">View More</a>
                                    </div>       
                                </div>
                            </div> 
                            <!-- END .course-content --> 
                        </div>
                    </li>
                                @endforeach
                    
                    
                    
                    
                    
                    
                </ul>
                
            </div>
        </div>
    </div>




        
        
                    
        
        
        
        
        
        
    </div>
@endsection