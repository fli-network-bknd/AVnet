<!-- users_id = <?php echo $user_id; ?> -->
<?php
include $global['systemRootPath'] . 'plugin/YouPHPFlix2/view/modeFlixHead.php';
?>
<link href="<?php echo getURL('plugin/YouPHPFlix2/view/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo getURL('plugin/Gallery/style.css'); ?>" rel="stylesheet" type="text/css"/>
<style>
    #bigVideoCarousel{
        height: auto;
    }
    .posterDetails {
        padding: 10px !important;
    }
    .modeFlixContainer{
        padding: 0;
    }
    .topicRow{
        margin: 0;
    }
    #loading{
        display: none;
    }
    .topicRow h2{
        display: none;
    }
    #channelHome #bigVideo{
        margin-bottom: 0 !important;
    }
</style>