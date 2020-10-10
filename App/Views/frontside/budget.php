


<div class="page-heading text-center">

    <div class="container zoomIn animated">

        <h1 class="page-title">Budget and Finance <span class="title-under"></span></h1>
        <p class="page-description">
            Himachal Pradesh Human Rights Commission , Pines Grove Building Shimla 171002
        </p>

    </div>

</div>

<div class="main-container">

    <div class="container">

        <div class="row">

            <div class="col-md-12 fadeIn animated">

                <p>
                    The Budget allocated to each of its agency , indication particulars of all plans , proposed expenditures and reports on disbursement made
                </p>

            </div>


        </div>

        <div class="row ">

            <div class="col-md-12 fadeIn">

                <h2 class="title-style-2"> Budget <span class="title-under"></span></h2>

                <h4>Year <?php echo $year; ?></h4>
                <table class="table table-style-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>SOE</th>
                            <th>Budget Allotted</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($result)){
                            $total=0;
                            foreach($result as $row){
                                $total=$total+$row['budget_amount'];
                            ?>
                        <tr>
                            <th scope="row">1</th>
                            <td><?php echo $row['budget_soe']; ?></td>
                            <td><?php echo $row['budget_amount']; ?></td>
                        </tr>
                        <?php
                            }
                        }
                        ?>                                               
                        <tr>
                            <th scope="row"></th>
                            <td><strong>Total</strong></td>
                            <td><strong><?php echo $total; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <!--
                                                                <h4>TABLE STYLE 2</h4>
                                                            <table class="table table-style-2">
                                                              <thead>
                                                                <tr>
                                                                  <th>#</th>
                                                                  <th>First Name</th>
                                                                  <th>Last Name</th>
                                                                  <th>Username</th>
                                                                </tr>
                                                              </thead>
                                                              <tbody>
                                                                <tr>
                                                                  <th scope="row">1</th>
                                                                  <td>Mark</td>
                                                                  <td>Otto</td>
                                                                  <td>@mdo</td>
                                                                </tr>
                                                                <tr>
                                                                  <th scope="row">2</th>
                                                                  <td>Jacob</td>
                                                                  <td>Thornton</td>
                                                                  <td>@fat</td>
                                                                </tr>
                                                                <tr>
                                                                  <th scope="row">3</th>
                                                                  <td>Larry</td>
                                                                  <td>the Bird</td>
                                                                  <td>@twitter</td>
                                                                </tr>
                
                                                                  <tr>
                                                                  <th scope="row">1</th>
                                                                  <td>Mark</td>
                                                                  <td>Otto</td>
                                                                  <td>@mdo</td>
                                                                </tr>
                                                                <tr>
                                                                  <th scope="row">2</th>
                                                                  <td>Jacob</td>
                                                                  <td>Thornton</td>
                                                                  <td>@fat</td>
                                                                </tr>
                                                                <tr>
                                                                  <th scope="row">3</th>
                                                                  <td>Larry</td>
                                                                  <td>the Bird</td>
                                                                  <td>@twitter</td>
                                                                </tr>
                
                                                              </tbody>
                                                            </table>
                -->					
            </div>

        </div>

    </div>

</div> <!-- /.main-container  -->


