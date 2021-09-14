<?php 
$pre_year = date("Y",strtotime("-1 year"));
$curr_year = date('Y');
$year = $pre_year."-".$curr_year;
?>
<style>
    .footer{
        background-color: #343a40;
        text-align: center;
        align-items: center;
        color: white;
    }
</style>
<footer class="footer">
    <div>MyCodeBlogs &copy; <?php echo $year; ?> | all rights reserved</div>
</footer>