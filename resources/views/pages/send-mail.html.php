<?php wp_head(); ?>

<style>
    .container {
        overflow: scroll;
        height: 720px;
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
    <h1>Mails</h1>
    <?php
    foreach ($mails as $mail) {
        ?>
        <div class="mail">
            <a href="<?php menu_page_url('mail-client'); ?>&action=show&mail_id=<?php echo $mail->id; ?>">
                New mail from: "<?php echo $mail->email ?>". Send at <?php echo $mail->created_at ?>
            </a>
        </div>
    <?php
} ?>
</div>