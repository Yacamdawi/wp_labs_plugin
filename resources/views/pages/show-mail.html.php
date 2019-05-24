<style>
    h1 {
        text-transform: uppercase;
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
    <h1><?php echo $mail->subject ?></h1><a>Time: <?php echo $mail->created_at ?></a>
    <div class="mail">
        <ul class="border">
            <div class="content">
                <label>Email:</label>
                <li>"<?php echo $mail->email ?>"</li>
            </div>
            <div class="content">
                <label>Name:</label>
                <li>"<?php echo $mail->lastname ?>"</li>
            </div>
            <div class="content">
                <label>Message:</label>
                <li>"<?php echo $mail->content ?>"</li>
            </div>
        </ul>
    </div>
</div>