<!-- page content -->
<div class="right_col" role="main">
    <div class="">
        <div class="row top_tiles">                              
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-users" style="font-size: 30px;"></i></div>
                        <div class="count"><?php echo $totaluser['cnt']; ?></div>
                        <h3>Total Customers</h3>
                        <p>Total active/inactive customers</p>
                    </div>
                </div>
            </a> 
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-check-square" style="font-size: 30px;"></i></div>
                        <div class="count"><?php echo $totalactiveuser['cnt']; ?></div>
                        <h3>Active Customers</h3>
                        <p>Total active customers</p>
                    </div>
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-ban" style="font-size: 30px;"></i></div>
                        <div class="count"><?php echo $totalinactiveuser['cnt'];; ?></div>
                        <h3>InActive Customers</h3>
                        <p>Total inactive customers</p>
                    </div>
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-file-text" style="font-size: 30px;"></i></div>
                        <div class="count"><?php echo $totalcases['cnt']; ?></div>
                        <h3>Total Cases</h3>
                        <p>Total Cases</p>
                    </div>
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-file-text" style="font-size: 30px;"></i></div>
                        <div class="count"><?php echo $totalopencases['cnt']; ?></div>
                        <h3>Total Open Cases</h3>
                        <p>&nbsp;</p>                        
                    </div>
                </div>
            </a>
            <a href="#"><div class="animated flipInY col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="tile-stats">
                        <div class="icon"><i class="fa fa-file-text" style="font-size: 30px;"></i></div>
                        <div class="count"><?php echo $totalclosedcases['cnt']; ?></div>
                        <h3>Total Closed Cases</h3> 
                        <p>&nbsp;</p>   
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- /page content -->