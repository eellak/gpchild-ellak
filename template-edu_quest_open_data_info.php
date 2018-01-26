<?php

/*
 Template Name: Edu Quest Open Data Info
 */
get_header();
?>

<div class="inside-article">
	<h1>Ανοιχτά Δεδομένα</h1>

	<?php if(is_user_logged_in()): ?>

	<p>Εδώ μπορείτε να κατεβάσετε όλα τα δεδομένα που παρέχονται από τη σελίδα των αποτελεσμάτων του ερωτηματολογίου υπό μορφή αρχείου CSV ως Ανοιχτά Δεδομένα.</p>
	<p>Το αρχείο ενημερώνεται περιοδικά με τις τελευταίες εισαγωγές δεδομένων.</p>
	<p>Κάντε κλικ <a href="<?= get_stylesheet_directory_uri().'/assets/files/edu_quest_opendata.csv'?>" target="_blank">εδώ</a> για να κατεβάσετε το αρχείο.</p>
	<p>Τελευταία ενημέρωση: <?php ?></p>

	<?php else: ?>
	<p>Για να έχετε πρόσβαση στα δεδομένα του ερωτηματολογίου ως Ανοικτά Δεδομένα θα πρέπει πρώτα να κάνετε εγγραφή στο <a href="https://ellak.gr/register">site της ΕΕΛΛΑΚ</a>.</p>
	<?php endif; ?>
</div>
<?php
get_footer();