<?php
/**
 * The template for displaying edu_quest_post_type custom post type posts. Built to present the questionary results.
 *
 *
 * @package Generate
 */

get_header(); ?>

	<div id="primary" <?php generate_content_class();?>>
		<main id="main" <?php generate_main_class(); ?> itemprop="mainContentOfPage" role="main">
                    <?php do_action('generate_before_main_content'); ?>
                    <div class='inside-article'>
                        <div class='ellak-edu_fos title-wrapper'>
                            <div class='ellak-edu_fos title text'>ΠΙΝΑΚΑΣ ΑΝΟΙΧΤΟΥ ΛΟΓΙΣΜΙΚΟΥ ΣΤΗΝ ΑΚΑΔΗΜΑΙΚΗ-ΕΡΕΥΝΗΤΙΚΗ ΚΟΙΝΟΤΗΤΑ</div>
                            <div class='ellak-edu_fos title controls'>
                                <?php
																//retrieve the post type dynamically here
																$current_post_type='';
																
																global $wpdb;
																global $wp_query;
																//get blog_id here
																$blog_id;
                                //retrieve the distinct field contents tha will fill the select boxes.
																$institutions_query="SELECT DISTINCT meta_value FROM wpcentral_".$blog_id."_postmeta WHERE meta_key LIKE 'edu_quest_institution'";
																$field_institution=$wpdb->get_results($institutions_query, OBJECT);
																$departments_query="SELECT DISTINCT meta_value FROM wpcentral_".$blog_id."_postmeta WHERE meta_key LIKE 'edu_quest_department'";
																$field_department=$wpdb->get_results($departments_query, OBJECT);
																$courses_query="SELECT DISTINCT meta_value FROM wpcentral_".$blog_id."_postmeta WHERE meta_key LIKE 'edu_quest_course'";
																$field_course=$wpdb->get_results($courses_query, OBJECT);
																$software_query="SELECT DISTINCT meta_value FROM wpcentral_".$blog_id."_postmeta WHERE meta_key LIKE 'edu_quest_software'";
																$field_software=$wpdb->get_results($software_query, OBJECT);																
																
																
//                                $thematiki_terms=get_terms('edu_fos_thematiki');
//                                $antikimeno_terms=get_terms('edu_fos_antikimeno');
//                                $vathmida_terms=get_terms('edu_fos_vathmida');
                                
																if(strpos(get_bloginfo('wpurl'), 'dev')){
//																	$action_url = esc_url('https://if:if@'.substr(admin_url('admin-post.php')), 8);
																	$action_url = esc_url(admin_url('admin-post.php'));
																}
																else{
																	$action_url = esc_url(admin_url('admin-post.php'));
																}
																?>
                                <div class='ellak-edu_fos sort-controls sort-controls-outer'>
                                    <form id='main-form' method='post' name='main-form' action='<?php echo $action_url ?>'>
                                        <div class='ellak-edu_fos sort-controls ellak-label'>
																						<?php
//																							echo esc_url('https://if:if@'.substr(admin_url('admin-post.php')), 8);
//																							echo $action_url = esc_url(admin_url('admin-post.php'));
																						?>
                                            Ταξινόμηση κατά: 
                                        </div>
																			
                                        <div class='ellak-edu_fos sort-controls'>
                                            <a href='/?post_type=edu_fos&contr_order=contributions' class='ellak-edu_fos sort-controls by-contributions ellak-disabled'>
                                                <!--<span class='text'>θεματική</span>-->
                                            </a>
                                            <label for='thematiki-select'>Ίδρυμα:</label>
                                            <select id='thematiki-select' class='ellak-edu_fos fos-category-select cf' name='institution'>
                                                <option value='null_option'>ΚΑΝΕΝΑ ΦΙΛΤΡΟ</option>
                                                <?php foreach($field_institution as $institution):?>
                                                <option value='<?php echo urlencode($institution->meta_value) ?> '><?php echo $institution->meta_value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
																			
                                        <div class='ellak-edu_fos sort-controls'>
                                            <a href='/?post_type=edu_quest&contr_order=followers' class='ellak-edu_fos sort-controls by-followers ellak-disabled'>
                                                <!--<span class='text'>γν. αντικείμενο</span>-->
                                            </a>
                                            <label for='antikimeno-select'>Τμήμα:</label>
																						
                                            <select id='antikimeno-select' class='ellak-edu_fos fos-category-select cf' name='department'>
                                                <option value='null_option'>ΚΑΝΕΝΑ ΦΙΛΤΡΟ</option>
                                                <?php foreach($field_department as $department):?>
                                                <option value='<?php echo urlencode($department->meta_value) ?>'><?php echo $department->meta_value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
																			
                                        <div class='ellak-edu_fos sort-controls by-language'>
                                            <a href='<?php echo (add_query_arg(array('post_type'=>'edu_fos', 'contr_order'=>'language'), 'https://edu.ellak.gr/'));?>' class='ellak-edu_fos sort-controls by-language ellak-disabled'>
                                                <!--<span class='text'>εκπ. βαθμίδα</span>-->
                                            </a>
                                            <label for='vathmida-select'>Μάθημα:</label>
                                            <select id='vathmida-select' class='ellak-edu_fos fos-category-select cf' name='course'>
                                                <option value='null_option'>ΚΑΝΕΝΑ ΦΙΛΤΡΟ</option>
                                                <?php foreach($field_course as $course):?>
                                                <option value='<?php echo urlencode($course->meta_value) ?>'><?php echo $course->meta_value; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <input type='hidden' name='action' value='handle_edu_quest_query'>
                                        <button type='submit' value='submit' class='ellak-edu_fos sort-controls filter_submit'>Υποβολή</button>
                                    </form>
                                </div>
                            </div>
														
														
                            <!-- The section to make available the CSV file link -->
<!--                            <div class="ellak-edu_fos download-csv">
                              <a href="https://edu.ellak.gr/wp-content/uploads/sites/11/2017/03/edu_fos_final.csv">
                                <span class="ellak-edu_fos download-csv-text">Κατεβάστε όλα τα στοιχεία σε CSV.</span>
                              </a>  
                            </div>-->
                        </div>
											
                        <div class='ellak-edu_fos fos-query-details main-wrapper'>
                            <div class='ellak-edu_fos fos-query-details padding-div'>
                                <?php
                                if($wp_query->found_posts<=0){
                                    $parameters_string="<div class='ellak-edu-fos edu-fos-query-details query-details-title-label'>".$wp_query->found_posts.' εγγραφές ικανοποιούν τις τρέχουσες παραμέτρους αναζήτησης:</div>'.PHP_EOL;
                                }
                                else if($wp_query->found_posts<=1){
                                    $parameters_string="<div class='ellak-edu-fos edu-fos-query-details query-details-title-label'>".$wp_query->found_posts.' εγγραφή ικανοποιεί τις τρέχουσες παραμέτρους αναζήτησης:</div>'.PHP_EOL;
                                }
                                else {
                                    $parameters_string="<div class='ellak-edu-fos edu-fos-query-details query-details-title-label'>".$wp_query->found_posts.' εγγραφές ικανοποιούν τις τρέχουσες παραμέτρους αναζήτησης:</div>'.PHP_EOL;
                                }
                                    $tmp_thematiki=get_term_by('slug', get_query_var('thematiki'),'edu_fos_thematiki');
                                    if($tmp_thematiki)
                                        $parameters_string.="<div class='ellak-edu-fos edu-fos-query-details query-details-line><span class='ellak-edu-fos edu-fos-query-details query-details-label'>θεματική: </span><span class='ellak-edu-fos edu-fos-query-details query-details-value'>".$tmp_thematiki->name."</span></div>".PHP_EOL;
                                    $tmp_vathmida=get_term_by('slug', get_query_var('vathmida'),'edu_fos_vathmida');
                                    if($tmp_vathmida)
                                        $parameters_string.="<div class='ellak-edu-fos edu-fos-query-details query-details-line><span class='ellak-edu-fos edu-fos-query-details query-details-label'>βαθμίδα: </span><span class='ellak-edu-fos edu-fos-query-details query-details-value'>".$tmp_vathmida->name."</span></div>".PHP_EOL;
                                    $tmp_antikimeno=get_term_by('slug', get_query_var('antikimeno'),'edu_fos_antikimeno');
                                    if($tmp_antikimeno)
                                        $parameters_string.="<div class='ellak-edu-fos edu-fos-query-details query-details-line><span class='ellak-edu-fos edu-fos-query-details query-details-label'>αντικείμενο: </span><span class='ellak-edu-fos edu-fos-query-details query-details-value'>".$tmp_antikimeno->name."</span></div>";
                                    echo $parameters_string;
                                ?>
                            </div>
                        </div>
											
                        <div class='ellak-edu_fos fos-entry-set main-wrapper'>
                            <?php
                            if($wp_query->have_posts()):
                                while($wp_query->have_posts()):
                                    $wp_query->the_post();
                                    if(get_the_title()!==null && strcmp(get_the_title(), '')):?>
                                        <div class='ellak-edu_fos fos-entry main-wrapper'>
																					
                                            <div class='ellak-edu_fos fos-entry title-text-wrapper'>
                                                <div class='ellak-edu_fos fos-entry title-text' role='button' data-toggle='collapse' data-target='#<?php the_ID(); ?>-details'>
                                                    <?php the_field('edu_quest_software', get_the_ID()) ?>
                                                </div>
                                            </div>
																					
                                            <div id='<?php the_ID(); ?>-details' class='ellak-edu_fos fos-entry details-container collapse'>
                                                <div class='ellak-edu_fos fos-entry details-wrapper'>
                                                    <?php $tmp=get_field('edu_quest_institution');
                                                    if(isset($tmp) && strcmp($tmp, '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Ίδρυμα: </span>
                                                        <span class='ellak-edu_fos fos-entry details-value'><?php the_field('edu_quest_institution', get_the_ID()); ?></span>
                                                    </div>
                                                    <?php endif?>
																									
                                                    <?php
                                                    if(get_field('edu_quest_department', get_the_ID()) && strcmp(get_field('edu_quest_department', get_the_ID()), '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Τμήμα: </span>
																													<span class='ellak-edu_fos fos-entry details-value'><?php echo get_field('edu_quest_department', get_the_ID()) ?></span>
                                                    </div>
                                                    <?php endif?>
																									
                                                    <?php $tmp;
                                                    if(get_field('edu_quest_course', get_the_ID()) && strcmp(get_field('edu_quest_course', get_the_ID()), '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Μάθημα: </span>
                                                        <span class='ellak-edu_fos fos-entry details-value'><?php echo get_field('edu_quest_course', get_the_ID()) ?></span>
                                                    </div>
                                                    <?php endif?>
                                                    
																										<?php
                                                    if(get_field('edu_quest_software_url', get_the_ID()) && strcmp(get_field('edu_quest_software_url', get_the_ID()), '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>URL: </span>
																												<span class='ellak-edu_fos fos-entry details-value'><a href="<?php echo get_field('edu_quest_software_url', get_the_ID()) ?>" target="_blank">click here</a></span>
                                                    </div>
                                                    <?php endif?>
                                                    <?php
                                                    if(isset(get_the_terms(get_the_ID(), 'edu_fos_vathmida')[0]->name) && strcmp(get_the_terms(get_the_ID(), 'edu_fos_vathmida')[0]->name, '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Εκπ. Βαθμίδα: </span>
                                                        <span class='ellak-edu_fos fos-entry details-value'>
                                                          <?php
                                                          $out_str='';
                                                          foreach(get_the_terms(get_the_ID(), 'edu_fos_vathmida') as $temp_term){
                                                            $out_str=$out_str.$temp_term->name.', ';
                                                          }
                                                          echo substr($out_str, 0, -2);
                                                          ?>
                                                        </span>
                                                    </div>
                                                    <?php endif?>
                                                    <?php
                                                    if(isset(get_the_terms(get_the_ID(), 'edu_fos_adia')[0]->name) && strcmp(get_the_terms(get_the_ID(), 'edu_fos_adia')[0]->name, '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Άδεια: </span>
                                                        <span class='ellak-edu_fos fos-entry details-value'><?php echo get_the_terms(get_the_ID(), 'edu_fos_adia')[0]->name; ?></span>
                                                    </div>
                                                    <?php endif?>
                                                    <?php
                                                    if(isset(get_the_terms(get_the_ID(), 'edu_fos_idos')[0]->name) && strcmp(get_the_terms(get_the_ID(), 'edu_fos_idos')[0]->name, '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Είδος: </span>
                                                        <span class='ellak-edu_fos fos-entry details-value'><?php echo get_the_terms(get_the_ID(), 'edu_fos_idos')[0]->name; ?></span>
                                                    </div>
                                                    <?php endif?>
                                                    <?php
                                                    if(isset(get_the_terms(get_the_ID(), 'edu_fos_litourgiko')[0]->name) && strcmp(get_the_terms(get_the_ID(), 'edu_fos_litourgiko')[0]->name, '')):
                                                    ?>
                                                    <div class='ellak-edu_fos fos-entry details-entry'>
                                                        <span class='ellak-edu_fos fos-entry details-label'>Λειτουργικό: </span>
                                                        <span class='ellak-edu_fos fos-entry details-value'><?php echo get_the_terms(get_the_ID(), 'edu_fos_litourgiko')[0]->name; ?></span>
                                                    </div>
                                                    <?php endif?>
                                                </div>
                                            </div>
                                        </div> <!-- main-wrapper -->
                                        <?php endif ?>
                            <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                          <div class='ellak-edu_fos paging-buttons ellak-container'>
                              <div class='ellak-edu_fos paging-buttons ellak-main-wrapper'>
                                  <div class='ellak-edu_fos paging-buttons ellak-button'>
                                  <?php echo paginate_links(); ?>
                                  <?php // var_dump($wp_query); ?>
                                  </div>
                              </div>
                          </div>
											
											
											<section id="opendata-section">
												<div id="edu-quest-opendata">
													<h3>ΑΝΟΙΧΤΑ ΔΕΔΟΜΕΝΑ</h3>
													<ul>
														<?php if(is_user_logged_in()): ?>
														<li>Για να κατεβάσετε τα αποτελέσματα του ερωτηματολογίου ως Ανοιχτά Δεδομένα υπό μορφή αρχείου csv, κάνετε κλικ <a href="<?= get_stylesheet_directory_uri().'/assets/files/edu_quest_opendata.csv'?>" target="_blank">εδώ</a></li>
														<li>Τελευταία ενημέρωση: <strong><?php echo get_post_meta(6735, 'edu_quest_update_date', true) ?></strong></li>
														<?php else: ?>
														<li>Για να κατεβάσετε τα αποτελέσματα του ερωτηματολογίου ως Ανοιχτά Δεδομένα υπό μορφή αρχείου csv, εγγραφειτε στο site της <a href="https://www.ellak.gr/register" target="_blank">ΕΕΛΛΑΚ</a>.</li>
														<?php endif; ?>

														<li>Μπορείτε να συμπληρώσετε το ερωτηματολόγιο κάνοντας κλικ <a href="https://edu-quest.ellak.gr" target="_blank">εδώ</a>.</li>
													</ul>
												</div>
											</section>
											
                    </div><!-- inside-article -->           
                                    
			<?php do_action('generate_after_main_content'); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php 
do_action('generate_sidebars');
get_footer();
