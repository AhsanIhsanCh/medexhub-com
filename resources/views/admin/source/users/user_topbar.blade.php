<?php
        $Ahsan = 0;
        // $SQLA = mysqli_query($Conn, "SELECT u_id FROM user");
        // $ResA = mysqli_num_rows($SQLA);
        // $PA = ($ResA / $ResA) * 100;
        // $SQLB = mysqli_query($Conn, "SELECT u_id FROM user WHERE u_ut_id = 4");
        // $ResB = mysqli_num_rows($SQLB);
        // $PB = ($ResB / $ResA) * 100;
        // $SQLC = mysqli_query($Conn, "SELECT u_id FROM user WHERE u_ut_id = 7");
        // $ResC = mysqli_num_rows($SQLC);
        // $PC = ($ResC / $ResA) * 100;
        // $SQLD = mysqli_query($Conn, "SELECT u_id FROM user WHERE u_ut_id = 8");
        // $ResD = mysqli_num_rows($SQLD);
        // $PD = ($ResD / $ResA) * 100;
    ?>
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total User(<?=$Ahsan;?>)</div>
                            <div class="row no-gutters align-items-center" style="padding-top:10px;">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=round($Ahsan,2);?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: <?=$PA?>%" aria-valuenow="10" aria-valuemin="0"aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users-cog fa-3x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        
        <!--Teacher-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Teacher (<?=$Ahsan;?>)</div>
                            <div class="row no-gutters align-items-center" style="padding-top:10px;">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=round($Ahsan,2);?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?=$PB?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"> <i class="fas fa-users-cog fa-3x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!--Validating-->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Validating(<?=$ResC;?>)</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=round($PC,2);?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?=$PC?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users-cog fa-3x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <!--Banned-->  
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Banned(<?=$ResD;?>)</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=round($PD,2);?>%</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?=$PD?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users-cog fa-3x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>