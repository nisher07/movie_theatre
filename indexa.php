<?php
include("db.php");
//$sql = mysqli_query($connection, "SELECT * FROM ticket JOIN movies on ticket.movie_id=movies.movie_id");
$sql = mysqli_query($connection, "SELECT * FROM movies ");
$sql1 = mysqli_query($connection, "SELECT * FROM movies ");

/* while($result=mysqli_fetch_array($sql))
  {
  print_r($result);
  }
 */
$num_rows = mysqli_num_rows($sql);
$num_rows1 =mysqli_num_rows($sql1);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src = "./js/jquery.min.js"></script>
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap CSS -->
        <script>
            $(document).ready((function () {
                $('.carousel-showmanymoveone .item').each(function () {
                    var itemToClone = $(this);
                    $('#carousel-tilenav').carousel({
                        interval: 3000
                    });
                    for (var i = 1; i < 6; i++) {
                        itemToClone = itemToClone.next();

                        // wrap around if at end of item collection
                        if (!itemToClone.length) {
                            itemToClone = $(this).siblings(':first');
                        }

                        // grab item, clone, add marker class, add to collection
                        itemToClone.children(':first-child').clone()
                                .addClass("cloneditem-" + (i))
                                .appendTo($(this));
                    }
                });
            }));

        </script>
    </head>
    <body style=" background-color: #fff6e8">
        <?php include ("header.php"); ?>
        <?php 
        if ($num_rows1 > 0) {
                    while ($result1 = mysqli_fetch_array($sql1))
                    {
                        $images = array($result1['image']);
                        $links = array("./".$result1['name'].".php?movie_id=".$result1['movie_id']);
                    }
        }
        ?>
       
        <div>
            <div class="container">
                <div class="container">

                    <h1 class="text-center">Welcome to Movie Zip</h1>
                    <br>
                    <br>



                    <div class="row">
                        <div class="col-md-12">
                            <div class="carousel carousel-showmanymoveone slide" id="carousel-tilenav" data-interval="false">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="<?php echo $links[0];?>"><img src="<?php echo $images[0]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="<?php echo $images[0]; ?>" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="http://placehold.it/500/d6d6d6/333&amp;text=3" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="http://placehold.it/500/002040/eeeeee&amp;text=4" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="http://placehold.it/500/0054A6/fff/&amp;text=5" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="http://placehold.it/500/002d5a/fff/&amp;text=6" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="http://placehold.it/500/eeeeee&amp;text=7" class="img-responsive"></a>
                                        </div>
                                    </div>
                                    <div class="item">
                                        <div class="col-xs-12 col-sm-6 col-md-2">
                                            <a href="#"><img src="http://placehold.it/500/40a1ff/002040&amp;text=8" class="img-responsive"></a>
                                        </div>
                                    </div>
                                </div>
                                <a class="left carousel-control" href="#carousel-tilenav" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                                <a class="right carousel-control" href="#carousel-tilenav" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>

        </div> 
        <br>
        <br>
        <div class="container ">
            <div class="container pull-left col-md-12 ">

                <?php
                
                if ($num_rows > 0) {
                    while ($result = mysqli_fetch_array($sql)) {
                        
                        print_r($result);
                        ?>
                        <div class="col-sm-12" style = "">
                            <div class="col-sm-2">
                                <img class="thumbnail" src="<?php echo $result['image'] ?>" width="140">
                            </div>
                            <div class="col-sm-9">  
                                <h3> <?php echo $result['name']; ?> </h3>

                                <h4> <?php
                                    $handle = fopen($result['description'], 'r');
                                    while (!feof($handle)) {
                                        echo fgets($handle, 1024);
                                        echo '<br />';
                                    }
                                    fclose($handle);
                                    ?> </h4>
                                <h4> Ratings : <?php echo $result['rating']; ?> / 10</h4>
                                <div class="pull-right">
                                    <a class="btn btn-info" href="./<?php echo $result['name'] ?>.php?movie_id=<?php echo $result['movie_id'] ; ?>">see more</a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>


        </div>

    </body>
</html>