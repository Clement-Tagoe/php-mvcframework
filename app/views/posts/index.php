<?php
  require APP_ROOT . '/views/includes/head.php';
?>
<div class='navbar dark'>
    <?php
        require APP_ROOT . '/views/includes/navigation.php';
    ?>
</div>
<div class="container">
    <?php if(isLoggedIn()):?>
        <a class="btn green" href="<?php echo URL_ROOT;?>/posts/create">
            Create
        </a>
    <?php endif; ?>

    <?php foreach($data['posts'] as $post): ?>
        <div class="container-item">
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post->user_id):?>
                <a class="btn orange" href="<?php echo URL_ROOT . '/posts/update/' . $post->id?>">
                    Update
                </a> 
                <form action="<?php echo URL_ROOT . '/posts/delete/' . $post->id?>" method="POST">
                    <input type="submit" name="delete" value="Delete" class="btn red">
                </form>
            <?php endif; ?>
            <h2>
                <?php echo $post->title ?>
            </h2>
            <h3>
                <?php echo 'Created on: ' . date('F j h:m', strtotime($post->created_at)) ?>
                
            </h3>
            <p>
                <?php echo $post->body ?>
            </p>
        </div>
    <?php endforeach; ?>
</div>