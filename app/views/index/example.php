<div>Welcome <?= $model->name; ?>, is your email address <?= $model->email;?>?</div>

<?= $model->html; ?>

<p>Echoing raw html</p>
<?= $model->raw('html'); ?>

<p>
See files:
</p>
<ul>
<li>app/config/example.php</li>
<li>app/controllers/index.php</li>
<li>app/models/example.php</li>
<li>app/services/example.php</li>
<li>app/views/index/example.php</li>
</ul>