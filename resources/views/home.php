<?php view('layout.header') ?>
<h1>
    Home page
</h1>
<form action="<?php echo 'users'; ?>" method="post">
    <input type="text" name="username">
    <input type="hidden" name="_method" value="post">
    <input type="submit" value="send">
</form>
<?php view('layout.footer') ?>