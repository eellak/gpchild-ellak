<?php

/**
 * Switching to central blog
 */

//switch_to_blog(1);

echo 'blog id---->'.get_current_blog_id();

/**
 * Creating the user query to search for users registered after 2016.09.01
 */

$user_q_args=array(
    'date_query'=>array(
        array('after'=>array(
            'year'=>2016,
            'month'=>9,
            'day'=>1
        ))
    )
);
$user_q=new WP_User_Query($user_q_args);

//restore_current_blog();
/**
 * Starting the User Loop
 */
$i=0;
echo "<div>plithos=".sizeof($user_q->results)."</div>";

if(!empty($user_q->results)):
  foreach($user_q->results as $user):
  
  echo $i++;
  $u_data=get_userdata($user->ID);
  echo 'email--->'.$u_data->user_email."<br>";
  echo 'registration date--->'.$u_data->user_registered."<br>";
  
  if(!empty(get_user_meta($user->ID, 'news_ellak'))){
    echo $user->user_email.'--->ellak newsletter<br>';
  }
  if(!empty(get_user_meta($user->ID, 'news_ellak_28'))){
    echo $user->user_email.'--->ma newsletter<br>';
  }
  if(!empty(get_user_meta($user->ID, 'news_ellak_19'))){
    echo $user->user_email.'--->cc radio<br>';
  }
  if(!empty(get_user_meta($user->ID, 'user_lists_reg'))){
    echo $user->user_email.'--->mailing lists<br>';
    echo "<ul style='margin-left: 30px; margin-top: -0px;>";
    foreach(get_user_meta($user->ID, 'user_lists_reg')[0] as $user_interest){
      echo "<li>$user_interest</li>";
    }
    echo "</ul>";
  }
  ?>
  <div class="nl-missed-users user-entry" style="margin: 20px;">
  <?php //print_r(get_user_meta($user->ID)); ?>
  </div>
  <?php endforeach;
endif;
