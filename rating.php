<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<head>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

    <?php include 'includes/navbar.php'; ?>

    <div class="content-wrapper">
        <div class="container">

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-sm-9">
                        <h1 class="page-header">YOUR CART</h1>
                        <div class="box box-solid">
                            <div class="box-body">
                                <?php
                                include('config.php');
                                $post_id = '2'; // yor page ID or Article ID
                                ?>

                                <div class="container23">
                                    <div class="rate">
                                        <div id="1" class="btn-1 rate-btn"></div>
                                        <div id="2" class="btn-2 rate-btn"></div>
                                        <div id="3" class="btn-3 rate-btn"></div>
                                        <div id="4" class="btn-4 rate-btn"></div>
                                        <div id="5" class="btn-5 rate-btn"></div>
                                    </div>
                                    <br>
                                    <div class="box-result">
                                        <?php
                                        $query = mysqli_query($db,"SELECT * FROM star");
                                        while($data = mysqli_fetch_assoc($query)){
                                            $rate_db[] = $data;
                                            $sum_rates[] = $data['rate'];
                                        }
                                        if(@count($rate_db)){
                                            $rate_times = count($rate_db);
                                            $sum_rates = array_sum($sum_rates);
                                            $rate_value = $sum_rates/$rate_times;
                                            $rate_bg = (($rate_value)/5)*100;
                                        }else{
                                            $rate_times = 0;
                                            $rate_value = 0;
                                            $rate_bg = 0;
                                        }
                                        ?>
                                        <div class="result-container">
                                            <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                                            <div class="rate-stars"></div>
                                        </div>
                                        <p style="margin:5px 0px; font-size:16px; text-align:center">Rated <strong><?php echo substr($rate_value,0,3); ?></strong> out of <?php echo $rate_times; ?> Review(s)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if(isset($_SESSION['user'])){
                            echo "
	        					<div id='paypal-button'></div>
	        				";
                        }
                        else{
                            echo "
	        					<h4>You need to <a href='login.php'>Login</a> to rating.</h4>
	        				";
                        }
                        ?>
                    </div>
                    <div class="col-sm-3">
                        <?php include 'includes/sidebar.php'; ?>
                    </div>
                </div>
            </section>

        </div>
    </div>
    <?php $pdo->close(); ?>
    <?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>
<script>
    $(function(){
        $('.rate-btn').hover(function(){
            $('.rate-btn').removeClass('rate-btn-hover');
            var therate = $(this).attr('id');
            for (var i = therate; i >= 0; i--) {
                $('.btn-'+i).addClass('rate-btn-hover');
            };
        });

        $('.rate-btn').click(function(){
            var therate = $(this).attr('id');
            var dataRate = 'act=rate&post_id=<?php echo $post_id; ?>&rate='+therate; //
            $('.rate-btn').removeClass('rate-btn-active');
            for (var i = therate; i >= 0; i--) {
                $('.btn-'+i).addClass('rate-btn-active');

            };
            $.ajax({
                type : "POST",
                url : "ajax.php",
                data: dataRate,
                success:function(){}
            });
            window.location.reload();
        });
    });
</script>
</body>
</html>
