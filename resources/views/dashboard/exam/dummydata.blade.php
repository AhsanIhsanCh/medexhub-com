 <!-- <div class="col-lg-3"  > -->
                <h3>Your Performance</h3>
                <div style="background-color: #6593ed; height: 4px; margin-bottom: 20px;"></div>
                <div style="position: sticky; top:0;">
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <div class="card-body" style="height: 130px;" >
                            <h5 class="card-title">Timer</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            <div style="text-align: center;">
                                <!-- <p style="font-size: 30px;font-weight: bold;" id="timer"></p> -->
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        
                        <div class="card-body" >
                            <h5 class="card-title">Progress</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card-body">
                                        <div class="chart-pie">
                                            <canvas id="myPieChart" width="100%" height="220"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                            <div class="mt-1 text-center small">
                                <span class="mr-2"><i class="fas fa-circle" style="color:#ccffcc;"></i> Questions answered</span>
                                <span class="mr-2"><i class="fas fa-circle" style="color:#cccccc;"></i> Question Left</span>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="width: 100%;border-radius: 10px;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                        <div class="card-body" >
                            <h5 class="card-title">Questions Navigational</h5>
                            <div style="background-color: #c7ccd5; height: 2px; margin-bottom: 20px;"></div>
                            
                            @foreach ($Tests as $object)
                                @php
                                    $QNNumber = "1";
                                    $QNs = explode(',', $object->t_questions);
                                    $QNsCount = count($QNs);
                                    for($q = 0; $q < $QNsCount; $q++)
                                        {
                                            $QN = explode(':', $QNs[$q]);
                                            $QNType = $QN[1];
                                            if($QNType == '1')
                                                {
                                                    if($QN[3] == 0)
                                                        {
                                                            echo '<a class="btn btn-secondary btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                        }
                                                    else 
                                                        {
                                                            echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';    
                                                        }    
                                                    $QNNumber++;    
                                                }
                                            if($QNType == '2')
                                                {
                                                    $QNDB = DB::table('questions')->select('q_question_id')->where('q_id', $QN[0])->get();
                                                    $QNID = $QNDB->first()->q_question_id ?? 'No Question Found';
                                                    $QNEMQ = DB::table('questions_emq')->select('emq_q_count')->where('emq_id', $QNID)->get();
                                                    $EMQQNCount = $QNEMQ->first()->emq_q_count ?? 0;
                                                    for($r = 1; $r <= $EMQQNCount; $r++)
                                                        {
                                                            $QNEMQ1Ans = explode(".", $QN[2]);
                                                            $QNEMQ2Ans = explode("'", $QNEMQ1Ans[$r-1]);
                                                            if($QN[3] == 0)
                                                                {
                                                                    echo '<a class="btn btn-secondary btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            else 
                                                                {
                                                                    echo '<a class="btn btn-success btn-sm m-1" style="border-radius: 50%; width: 40px; height: 40px;padding-top:8px;" href="#questionpos'.$QNNumber.'">'.$QNNumber.'</a>';
                                                                }
                                                            $QNNumber++;    
                                                        }
                                                }    
                                        }    
                                @endphp
                            @endforeach  
                        </div>
                    </div>
                </div>
            <!-- </div> -->