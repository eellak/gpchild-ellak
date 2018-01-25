<?php

/**
 * Switching to central blog
 */

//switch_to_blog(1);

//echo 'blog id---->'.get_current_blog_id();

/**
 * Creating the user query to search for users registered after 2016.09.01
 */

$user_q_args=array(
    'number'=>3000,
    'offset'=>000,
    'date_query'=>array(
        array('after'=>array(
            'year'=>2016,
            'month'=>9,
            'day'=>1
        ))
    )
);
$user_q=new WP_User_Query($user_q_args);

/**
 * Starting the User Loop
 */
$i=0;
echo "<div>plithos=".sizeof($user_q->results)."</div>";

//var_dump($user_q->results);

$ellak_newsletter=array();
$ma_newsletter=array();
$cc=array();
$mailing_lists=array();

if(!empty($user_q->results)):
  foreach($user_q->results as $user):
//  
//  echo $i++;
//  $u_data=get_userdata($user->ID);
//  echo 'email--->'.$u_data->user_email."<br>";
//  echo 'registration date--->'.$u_data->user_registered."<br>";
  
  if(!empty(get_user_meta($user->ID, 'news_ellak'))){
    //echo $user->user_email.'--->ellak newsletter<br>';
    $ellak_newsletter[]=$user->user_email;
  }
  if(!empty(get_user_meta($user->ID, 'news_ellak_28'))){
    //echo $user->user_email.'--->ma newsletter<br>';
    $ma_newsletter[]=$user->user_email;
  }
  if(!empty(get_user_meta($user->ID, 'news_ellak_19'))){
    //echo $user->user_email.'--->cc radio<br>';
    $cc[]=$user->user_email;
  }
  if(!empty(get_user_meta($user->ID, 'user_lists_reg'))){
    //echo $user->user_email.'--->mailing lists<br>';
    $mailing_lists[]=$user->user_login.'---'.$user->user_email;
//    echo "<ul style='margin-left: 30px; margin-top: -0px;>";
//    foreach(get_user_meta($user->ID, 'user_lists_reg')[0] as $user_interest){
//      echo "<li>$user_interest</li>";
//    }
//    echo "</ul>";
  }
  ?>
  <div class="nl-missed-users user-entry" style="margin: 20px;">
  <?php //print_r(get_user_meta($user->ID)); ?>
  </div>
  <?php endforeach;
endif;

echo "<div style='margin: 20px;'>";
echo "<h3>ELLAK NEWSLETTER</h3>";
foreach($ellak_newsletter as $entry){
  echo $entry.'<br>';
}
echo "</div>";

echo "<div style='margin: 20px;'>";
echo "<h3>MA NEWSLETTER</h3>";
foreach($ma_newsletter as $entry){
  echo $entry.'<br>';
}
echo "</div>";

echo "<div style='margin: 20px;'>";
echo "<h3>CC RADIO</h3>";
foreach($cc as $entry){
  echo $entry.'<br>';
}
echo "</div>";

echo "<div style='margin: 20px;'>";
echo "<h3>MAILING LISTS</h3>";
foreach($mailing_lists as $entry){
  echo $entry.'<br>';
}
echo "</div>";

//restore_current_blog();