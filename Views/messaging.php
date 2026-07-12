<?php

include_once(__DIR__ . "/../Layout/header.php");



?>

<section class="messaging_section">

    <div class="messaging_side_bar">
        <h1>
            Messagerie
        </h1>
        <?php if (isset($discussionsList) && (count($discussionsList) > 0) && isset($user)) : ?>
            <?php foreach ($discussionsList as $discussion) : ?>
                <a href="./index.php?page=messagerie&utilisateur_id=<?= $discussion->getTargetUser()->getId() ?>" class="messaging_contact_wrapper">

                    <?php if (!$discussion->getLastMessage()->getIsRead() && $discussion->getLastMessage()->getFromUserId() !== $user->getId()) : ?>
                        <div class="unread_message">
                            <div class="round"></div>
                        </div>
                    <?php endif; ?>
                    <div class="messaging_contact_avatar">
                        <img src="./Public/Uploads/Avatars/<?= $discussion->getTargetUser()->getAvatarFileName() ?>" alt="">
                    </div>
                    <div class="messaging_contact_content">
                        <div class="messaging_contact_content_header">
                            <div class="messaging_contact_content_username"><?= htmlspecialchars($discussion->getTargetUser()->getPseudo()) ?></div>
                            <div class="messaging_contact_content_last_message"><?= $discussion->getLastMessage()->getSendAt()->format("h:i") ?></div>
                        </div>
                        <div class="messaging_contact_content_preview">
                            <?= htmlspecialchars($discussion->getLastMessage()->getContent()) ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php endif; ?>

    </div>
    <?php if (isset($target_user)) : ?>

        <div class="messaging_content">
            <div class="messaging_content_subtitle">
                <div class="messaging_contact_avatar">
                    <img src="./Public/Uploads/Avatars/<?= $target_user->getAvatarFileName() ?>" alt="">
                </div>
                <h2><?= htmlspecialchars($target_user->getPseudo()) ?></h2>
            </div>
            <div id="messagesWrapper" class="messaging_content_messages">
                <?php if (isset($message_list)) :  ?>
                    <?php foreach ($message_list as $message) : ?>

                        <?php if (isset($user)) : ?>
                            <div class="messaging_content_message_wrapper <?= $message->getFromUserId() === $user->getId() ? 'sent_message' : '' ?>">
                                <div class="messaging_content_message_wrapper_bis">
                                    <div class="message_info">
                                        <?php if ($message->getFromUserId() !== $user->getId()) : ?>
                                            <div class="message_info_avatar">
                                                <img src="./Public/Uploads/Avatars/<?= $target_user->getAvatarFileName() ?>" alt="">
                                            </div>

                                        <?php endif; ?>
                                        <div class="message_info">
                                            <p>
                                                <?= $message->getSendAt()->format("d.m h:i") ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="message_content">
                                        <?= htmlspecialchars($message->getContent()); ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <form class="messaging_content_form_wrapper" method="POST" action="./index.php?page=messagerie">
                <input type="hidden" id="user_id" name="user_id" value="<?= $target_user->getId() ?>">
                <label for="message"></label>
                <textarea maxlength="1000" rows="1" placeholder="Tapez votre message ici" name="message" id="message"></textarea>
                <button class="main_button">Envoyer</button>
            </form>
        </div>
    <?php else : ?>
        <div class="select_contact_wrapper">Sélectionnez un contact</div>
    <?php endif ?>

    <script src="./Js/messagingScrollBottom.js"></script>
</section>

<?php

include_once(__DIR__ . "/../Layout/footer.php");

?>