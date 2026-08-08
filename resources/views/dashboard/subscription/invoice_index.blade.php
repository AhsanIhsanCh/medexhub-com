@php
use Carbon\Carbon;    
@endphp
@extends('dashboard.layoutDashboard')
@section('invoice')
    <section class="content-panel">
        <div class="title-row">
            <div>
                <span class="title-kicker">Subscription</span>
                <h1>Invoice</h1>
                <p class="title-subtitle">Prepare with structure, revise with purpose, and track every step of your exam journey.</p>
            </div>
            <div class="db-actions"></div>
        </div>
        <div class="quick-row" aria-label="Quick stats">
            <div class="quick-card">
                <div class="quick-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5V5a2 2 0 0 1 2-2h13v18H6a2 2 0 0 1-2-1.5Z"/><path d="M8 7h7"/></svg>
                </div>
                <div><strong>8</strong><span>Exam collections</span></div>
            </div>
            <div class="quick-card">
                <div class="quick-icon green">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 6 9 17l-5-5"/></svg>
                </div>
                <div><strong>1,240</strong><span>Questions completed</span></div>
            </div>
            <div class="quick-card">
                <div class="quick-icon pink">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 8v4l3 3"/><circle cx="12" cy="12" r="9"/></svg>
                </div>
                <div><strong>15</strong><span>Days left</span></div>
            </div>
        </div>
        @if($Invoices->count() == 0)
            <div class="alert alert-info" role="alert" style="margin-top: 15px;">
                You have no invoices available. Please make a purchase to generate an invoice.
            </div>
        @else
            <div class="card-body">
                <div class="table-wrap">
                    <table id="dataTable" >
                        <thead>
                            <tr>
                                <th  style="width: 10%;">Sr # <span class="sort"></span></th>
                                <th  style="width: 30%;">Invoice No. <span class="sort"></span></th>
                                <th  style="width: 25%;">Date <span class="sort"></span></th>
                                <th  style="width: 10%;">Amount <span class="sort"></span></th>
                                <th style="width: 10%;">Discount <span class="sort"></span></th>
                                <th  style="width: 15%;">Net Total <span class="sort"></span></th>
                                <th  style="width: 15%;">Action<span class="sort"></span></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th >Sr #</th>
                                <th>Invoice No.</th>
                                <th>Date</th>
                                <th >Amount</th>
                                <th >Discount</th>
                                <th >Net Total</th>
                                <th >Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($Invoices as $Invoice)
                                @php
                                    $InvoiceID = $Invoice->in_id;
                                    $InvoiceYear = date('Y'); 
                                    $InvoiceNo = "MED-".$InvoiceYear."-".str_pad($Invoice->in_id, 6, "0", STR_PAD_LEFT);
                                    $InvoiceDate = Carbon::parse($Invoice->in_date)->format('F j, Y');
                                    $InvoiceAmount = $Invoice->in_total;
                                    $InvoiceDiscount = $Invoice->in_discount;
                                    $InvoiceTotal = $Invoice->in_pay;
                                @endphp
                                <tr>
                                    <td style="text-align: center;">{{ $loop->iteration }}</td>
                                    <td style="text-align: center;">{{ $InvoiceNo}}</span></td>
                                    <td style="text-align: center;">{{ $InvoiceDate }}</td>
                                    <td style="text-align: center;"> {{ $InvoiceAmount }}</td>
                                    <td style="text-align: center;">{{ $InvoiceDiscount }}</td>
                                    <td style="text-align: center;">{{ $InvoiceTotal }}</td>
                                    <td style="text-align: center;">

                                        
                                    <button
                        type="button"
                        class="open-invoice"
                        data-url="{{ route('ajaxinvoice', ['in_id' => $InvoiceID]) }}"
                        style="border:0; background:none;"
                    >
                        Open
                    </button>
                                    
                                    
                                        
                                    </td>
                                </tr>





                            @endforeach   
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </section>
    <script>
        function closedatadiv() {
        const dataDiv = document.getElementById('datadiv');
        dataDiv.style.display = 'none';
        dataDiv.innerHTML = '';
        }
        document.addEventListener('click', function (event) {
            const button = event.target.closest('.open-invoice');
                if (!button) {
                    return;
                    }
            const dataDiv = document.getElementById('datadiv');
            const urlPath = button.dataset.url;
            dataDiv.style.display = 'block';
            dataDiv.innerHTML = 'Loading...';
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {
                if (this.status >= 200 && this.status < 300) {
                    dataDiv.innerHTML = this.responseText;
                    } else {
                    dataDiv.innerHTML = 'Unable to load invoice.';
                    }
            };
            xhttp.onerror = function () {
                dataDiv.innerHTML = 'Network error.';
                };
            xhttp.open('GET', urlPath, true);
            xhttp.send();
        });
    </script>
    <div id="datadiv"></div>
@endsection