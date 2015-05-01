<div id="copyText">
    <div class="leftBox">
        <div> Cheminv develeoped by <a href="http://github.com/tmorrell/cheminv">Tom Morrell</a> in the Haw Yang Lab at Princeton University. Derived from <a href="http://nilsf.se">Nils Fredriksson's</a> ecDB </div>
        <div class="stats">
            <?php include_once('include/mysql_connect.php'); ?>

        	<?php $members = mysql_num_rows(mysql_query("SELECT member_id FROM members")); echo $members; ?>
			<span class="boldText">members</span>,

			<?php $components = mysql_num_rows(mysql_query("SELECT id FROM data")); echo $components; ?>
			<span class="boldText">chemicals </span>and

			<?php $projects = mysql_num_rows(mysql_query("SELECT project_id FROM projects")); echo $projects; ?>
			<span class="boldText">projects</span>.

        </div>
    </div>
</div>
