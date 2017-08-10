<?php

/*
 Template Name: Edu Quest Template
 */
get_header();

$query_args=array('post_type' => 'edu_quest_post_type', 'posts_per_page' => -1);

$edu_quest_q=new WP_Query($query_args);

$rows_array=array();

if($edu_quest_q->have_posts()):
	while($edu_quest_q->have_posts()):$edu_quest_q->the_post();
	
	$row=array(
			'institution' => get_field('edu_quest_institution'),
			'department' => get_field('edu_quest_department'),
			'course' => get_field('edu_quest_course'),
			'software' => get_field('edu_quest_software'),
			'software_url' => get_field('edu_quest_software_url'),
			);
	
	$rows_array[]=$row;
	
	endwhile;
endif;
?>
	
	
<?php 

if($rows_array){
	$ret_value=json_encode($rows_array);
}
else{
	$ret_value='empty';
}
?>
	
<script>
	var QUEST_ENTRIES = <?php echo $ret_value; ?>;
	console.log(QUEST_ENTRIES)
</script>

<div class="" id="quest-result-main-area">
	<div class="inside-article">
		<h2 class="title">ΠΙΝΑΚΑΣ ΑΝΟΙΧΤΟΥ ΛΟΓΙΣΜΙΚΟΥ ΣΤΗΝ ΑΚΑΔΗΜΑΙΚΗ-ΕΡΕΥΝΗΤΙΚΗ ΚΟΙΝΟΤΗΤΑ</h2>

		<div id="edu-quest-results">

			<section id="instructions-section" v-show="!(filter_type['institution'] || filter_type['course'] || filter_type['department'])">
				<div id="edu-quest-instructions">
					<h3>ΟΔΗΓΙΕΣ ΠΛΟΗΓΗΣΗΣ</h3>
					<ul>
						<li>Για αλφαβητική ταξινόμηση κάνετε κλικ στην κεφαλίδα της στήλης της προτίμησής σας.</li>
						<li>Για εφαρμογή φίλτρων, κάντε κλικ στο πεδίο της προτίμησής σας. Έχετε δυνατότητα εφαρμογής έως και τριών φίλτρων παράλληλα, ίδρυμα, σχολή και μάθημα.</li>
						<li>Για αναίρεση ενός φίλτρου κάνετε κλικ σε κάποιο από τα φίλτρα όπως αυτά εμφανίζονται στη σειρά. Για αναίρεση όλων των φίλτρων, κάνετε κλικ στο "ΚΑΘΑΡΙΣΜΟΣ ΦΙΛΤΡΩΝ".</li>
					</ul>
				</div>
			</section>


			<section id="filter-section" v-show="filter_type['institution'] || filter_type['course'] || filter_type['department']">
				<div id="edu-quest-current-filters">
					<span id="edu-quest-filter-label" v-on:click="filter" >ΤΡΕΧΟΝΤΑ ΦΙΛΤΡΑ: </span>

					<span class="filter-type" v-show="filter_type['institution']" v-on:click="filter_type['institution']=''" > {{ filter_type.institution }} </span>

					<span class="bread-delim" v-show="filter_type['institution'] && filter_type['department']">>></span>

					<span class="filter-type" v-show="filter_type['department']" v-on:click="filter_type['department']=''" > {{ filter_type.department }} </span>

					<span class="bread-delim" v-show="filter_type['course'] && filter_type['department'] || filter_type['institution'] && filter_type['course']">>></span>

					<span class="filter-type" v-show="filter_type['course']" v-on:click="filter_type['course']=''" > {{ filter_type.course }} </span>

					<div id="clear-filters-wrapper"><span id="clear-filters" v-on:click="clearFilters">ΚΑΘΑΡΙΣΜΟΣ ΦΙΛΤΡΩΝ</span></div>
				</div>
			</section>

			<table id="results-table">
				<tr id="edu-quest-title-row">
					<th class="edu-clickable" v-on:click="sort('institution')" v-bind:class="{ sorted: sort_by === 'institution', reverse: sort_reverse }" >ΙΔΡΥΜΑ</th>
					<th class="edu-clickable" v-on:click="sort('department')" v-bind:class="{ sorted: sort_by === 'department', reverse: sort_reverse }" >ΤΜΗΜΑ</th>
					<th class="edu-clickable" v-on:click="sort('course')" v-bind:class="{ sorted: sort_by === 'course', reverse: sort_reverse }" >ΜΑΘΗΜΑ</th>
					<th class="edu-clickable" v-on:click="sort('software')" v-bind:class="{ sorted: sort_by === 'software', reverse: sort_reverse }" >ΛΟΓΙΣΜΙΚΟ</th>
				</tr>

				<tr v-for="item in projects" >

					<td v-html="item.institution"
							v-on:click="filterType('institution', item.institution)" >
					</td>

					<td v-html="item.department"
							v-on:click="filterType('department', item.department)" >
					</td>

					<td v-html="item.course"
						v-on:click="filterType('course', item.course)" >
					</td>
				<template v-if="item.software_url==''" >
					<td>
							<span	v-html="item.software" ></span>
					</td>
				</template>
				<template v-else >
					<td>
						<a v-bind:href="item.software_url"
							 v-html="item.software"
							 target="_blank">
						</a>
					</td>
				</template>

				</tr>

			</table>
			
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
			
		
	</div>
</div>
</div>


<?php

get_footer();