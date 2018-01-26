<?php


get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?> itemprop="mainContentOfPage" role="main">
			<?php do_action('generate_before_main_content'); ?>
      
      <?php
      /*
       * include the plugin.php file if not available.
       */
      if ( ! function_exists( 'get_plugins' ) || ! function_exists( 'is_plugin_active_for_network' ) ) {
	require_once ABSPATH . 'wp-admin/includes/plugin.php';
      }

      /**
       * gathering all site url's in an array
       */
      
      $sites_list=get_sites();
      $plugins_list=get_plugins();
      $sites__inactive_plugins=array();
      $netwide_inactive_plugins=array();
      $active_plugins__in_sites=array();
      //if(is_array($plugins_list) && !empty($plugins_list)){}
      /*
       * fill the array with all the plugin names
       * just to have something to compare with
       * array_intersect
       */
      foreach(array_keys($plugins_list) as $plugin_handle){
          $netwide_inactive_plugins[]=$plugins_list[$plugin_handle]["Name"];
      }
      //var_dump($netwide_inactive_plugins);
      
      foreach($sites_list as $site_obj){
        switch_to_blog($site_obj->id);
        $domain=$site_obj->domain;
        foreach(array_keys($plugins_list) as $plugin_handle){
            if(!is_plugin_active($plugin_handle)){
                $sites__inactive_plugins[$domain][]=$plugins_list[$plugin_handle]["Name"];
            }
            else{
                $plugin_name=$plugins_list[$plugin_handle]["Name"];
                $active_plugins__in_sites[$plugin_name][]=$domain;
            }
        }
      }
      $number_of_sites= sizeof($sites_list);
      foreach($sites_list as $site_obj){
          $domain=$site_obj->domain;
          $netwide_inactive_plugins=array_intersect($sites__inactive_plugins[$domain], $netwide_inactive_plugins);
      }
      
      foreach(array_keys($plugins_list) as $plugin_handle){
          foreach($sites_list as $site_obj){
              if(true);
          }
      }
      
      ?>
                    <table style="width: 100%;">     
      <?php
        foreach(array_keys($plugins_list) as $plugin_handle){
            $is_plugin_active_network='';
            $plugin_name=$plugins_list[$plugin_handle]["Name"];
            $plugin_text_domain=$plugins_list[$plugin_handle]["TextDomain"];
            //print_r($plugins_list[$plugin_handle]);
            //echo '<br> <br>';
            //echo $plugin_handle.'<br>';
            if(is_plugin_active_for_network($plugin_handle)){
                echo 'einai';
                $is_plugin_active_network=' - network';
            }
            //echo "<th>$plugin_name"." ".$is_plugin_active_network."</th>";
            echo "<th>$plugin_name"." * ".$plugin_text_domain.$is_plugin_active_network."</th>";
            //echo var_dump($active_plugins__in_sites[$plugin_name]);
            foreach($active_plugins__in_sites[$plugin_name] as $current_site){
                echo "<tr><td>$current_site</td></tr>";
            }
        }
      ?>
                    </table>
      
      <?php do_action('generate_after_main_content'); ?>
      
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();
