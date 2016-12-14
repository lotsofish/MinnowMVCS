<?php foreach($model->users as $user): ?>
<p>Username = <?= $user->username; ?> -- Email = <?= $user->email;?></p>
<p>Raw Username = <?= $user->raw('username');?> -- Raw Email = <?= $user->raw('email'); ?></p>
<?php endforeach; ?>


<br><br>
<p>Username = <?= $model->user1->username; ?> -- Email = <?= $model->user1->email;?></p>
<p>Raw Username = <?= $model->user1->raw('username');?> -- Raw Email = <?= $model->user1->raw('email'); ?></p>

<pre>
<?php var_dump($model); ?>
</pre>