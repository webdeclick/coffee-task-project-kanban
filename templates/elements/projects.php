
<?php if(isset($projects) ): foreach($projects as $project): ?>


users : $project['users'][]
admin : $project['user_admin']
modo : $project['user_manager']


<?php endforeach; endif; ?>
