<?php
define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DATABASE_NAME', 'xxcoupon_cms');

//Connect with the database
$db = new mysqli(HOST, USERNAME, PASSWORD, DATABASE_NAME);
if ($db->connect_errno) :
    die('Connect error:' . $db->connect_error);
endif;

if ((!isset($db) || ($db_conn = $db->connect_errno)) && is_dir('install')) {

    require_once 'install/index.php';
    //die('Connected');

} else if ($db_conn) {

    die('Failed to connect to MySQL (' . $db->connect_errno . ') ' . $db->connect_error);
}
//Fetch rating deatails from database
$query = "SELECT rating_number, FORMAT((total_points / rating_number),1) as average_rating FROM view_rating WHERE post_id = 1 AND status = 1";
$result = $db->query($query);
$ratingRow = $result->fetch_assoc();



?>
<div>
    <script language="javascript" type="text/javascript">
        $(function() {
            $("#rating_star").spaceo_rating_widget({
                starLength: '5',
                initialValue: '',
                callbackFunctionName: 'processRating',
                imageDirectory: 'content/uploads/images/',
                // imageDirectory: 'C:\xampp\htdocs\coupon_project\content\themes\Slick\assets\img\widget_star.gif',
                inputAttr: 'post_id'
            });
        });

        function processRating(val, attrVal) {
            $.ajax({
                type: 'POST',
                url: 'rating.php',
                data: 'post_id=1&points=' + val,
                dataType: 'json',
                success: function(data) {
                    if (data.status == 'ok') {
                        alert('You have rated ' + val + ' to SPACE-O');
                        $('#avgrat').text(data.average_rating);
                        $('#totalrat').text(data.rating_number);
                    } else {
                        alert('please after some time.');
                    }
                }
            });
        }
    </script>
    <input name="rating" value="0" id="rating_star" type="hidden" postID="1" />
    <div class="overall-rating">(Average Rating <span id="avgrat"><?php echo $ratingRow['average_rating']; ?></span>
        Based on <span id="totalrat"><?php echo $ratingRow['rating_number']; ?></span> rating)</span></div>
</div>