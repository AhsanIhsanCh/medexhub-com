@extends('admin.adminlayout')
@section('conversation')
<style>
.type-pill{display: inline-flex;align-items: center;padding: 7px 10px;border-radius: 999px;border: 1px solid #dce8e5;color: #355269;background: #f8faf9;font-weight: 700;font-size: 13px;}
.type-pill.exam{background: #edf5ff; border-color: #d8e8fb; color: #285f91;}
.type-pill.revision{background: #e8f7f4; border-color: #cfeae5; color: #0b5b53;}
</style>
<div class="page-wrapper">
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Conversation</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Conversation</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
         
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
                        <div class="search-set">
                            <div class="search-input"><span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span></div>
                        </div>
                        <div class="d-flex table-dropdown my-xl-auto right-content align-items-center flex-wrap row-gap-3">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-white btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">Show No. of Conversations</a>
                                <ul class="dropdown-menu  dropdown-menu-end p-3">
                                    <li><a href="/admin-conversation/100" class="dropdown-item rounded-1">Last 100 Conversations</a></li>
                                    <li><a href="/admin-conversation/250" class="dropdown-item rounded-1">Last 250 Conversations</a></li>
                                    <li><a href="/admin-conversation/500" class="dropdown-item rounded-1">Last 500 Conversations</a></li>
                                    <li><a href="/admin-conversation/1000" class="dropdown-item rounded-1">Last 1000 Conversations</a></li>
                                    <li><a href="/admin-conversation/99999" class="dropdown-item rounded-1">Last All Conversations</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive no-search">
                            <table class="table datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px;text-align: center;">Sr #</th>
                                        <th>Message</th>
                                        <th style='text-align: center;'>No of Message</th>
                                        <th style='text-align: center;'>Last Reply</th>
                                        <th style='text-align: center;'>Date</th>
                                        <th style="width: 150px;text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Conversations as $Conversation)
                        @php
                            if ($Conversation->co_qt_id == 1) 
                                {
                                    $StyleClass = "type-pill exam";
                                    $QuestionIDNo =  "MCQ ID : ".$Conversation->co_q_id;
                                    $QuestionInner = "0";
                                }
                            if ($Conversation->co_qt_id == 2) 
                                {
                                    $StyleClass = "type-pill revision";
                                    $QuestionIDNo =  "EMQ ID : ".$Conversation->co_q_id;
                                    $QuestionInner =  "Question No : ".$Conversation->co_inner_q;
                                }
                            $Co_Q_ID = $Conversation->co_q_id;
                            $ConversationsInner = DB::table('conversation')->where('co_q_id', $Conversation->co_q_id)->where('co_inner_q', $Conversation->co_inner_q)->orderBy('updated_at', 'desc')->get();
                            $ConversationCount = $ConversationsInner->count();

                            $Co_ID = $ConversationsInner->first()->co_id;
                            $Q_ID = $ConversationsInner->first()->co_q_id;
                            $Q_Inner_ID = $ConversationsInner->first()->co_inner_q;
                            $QT_ID = $ConversationsInner->first()->co_qt_id;
                            $QT_Created = $ConversationsInner->first()->created_at;
                            $QT_u_id = $ConversationsInner->first()->co_u_id;
                            $Users = DB::table('users')->select('u_fname','u_lname')->where('id', $QT_u_id)->get();
                            $UserName = $Users->first()->u_fname." ".$Users->first()->u_lname;


                            $LinkData = array($Q_ID,$Q_Inner_ID,$QT_ID);
                            $stringLinkData = implode(",",$LinkData);
                        @endphp
                        <tr>
                            <td style="text-align: center;">{{ $loop->iteration }}</td>
                            <td style="max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $ConversationsInner->first()->co_message }}<br>
                            <span class="{{ $StyleClass }}" style="font-size:11px;max-height:20px;background-color: #f6faf9;"> {{ $QuestionIDNo }}</span>
                                @if($QuestionInner != 0)
                                    <span class="{{ $StyleClass }}" style="font-size:11px;max-height:20px;background-color: #f6faf9;"> {{ $QuestionInner }}</span>
                                @endif
                            </td>
                            <td style="text-align: center;">{{ $ConversationCount }}</td>
                            <td style="text-align: center;">{{ $UserName }}</td>
                            <td style="text-align: center;">{{ $QT_Created }}</td>
                            <td style='text-align:center;'>
                                <a href='/adminEditExam/'><i class="fas fa-comment-alt-edit"></i></a>
                                <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#viewModal"><i class="fas fa-eye"></i></button>
                            </td>
                            
                        </tr>
                    @endforeach
                                   
                                
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright-footer d-flex align-items-center justify-content-between border-top bg-white gap-3 flex-wrap">
        <p class="fs-13 text-gray-9 mb-0">© 2015–{{ date('Y') }} <a href="https://www.medexhub.com" target="_blank" class="link-primary">MedExHub</a>. All Right Reserved</p>
        <p>Designed & Developed By <a href="https://www.it-ocean.net" target="_blank" class="link-primary">It-Ocean.Net</a></p>
    </div>
</div>
@endsection