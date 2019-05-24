<?php wp_head(); ?>

<style>
    .container {
        overflow: scroll;
        height: 650px;
    }

    .mail {
        border: 2px solid;
        margin: 2rem 0;
        padding: 2rem;
    }

    .content {
        border: 1px solid;
        margin: 1rem 0;
        padding: 2rem;
        widows: 50%;
    }

    .content>label {
        text-decoration: underline;
    }
</style>

<div class="container">
    <h1>Newsletters</h1>
    <?php
    foreach ($newsletters as $newsletter) {
        ?>
        <div class="mail">
            <a>"<?php echo $newsletter->email ?>" - [<?php echo $newsletter->created_at ?>]</a>
            <form action="<?= get_admin_url() . '/?action=delete-newsletter'; ?>" method="post">
                <input type="hidden" name="newsletter_id" value="<?php echo $newsletter->id; ?>">
                <button type="submit" class="btn btn-danger">Delete newsletter</button>
            </form>
        </div>
    <?php
} ?>
</div>