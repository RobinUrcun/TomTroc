<?php

class MessagingController
{

    private ?User $user;

    public function __construct()
    {
        $this->user = AuthServices::getAuthenticatedUser();

        if (!$this->user) {
            Redirect::to("connexion");
        }
    }

    public function getMessagingPage(): void
    {
        $user = $this->user;

        $discussionRepository =  new DiscussionRepository();

        $discussionsList = $discussionRepository->getDiscussionListPreview($user->getId());

        require_once("./Views/messaging.php");
    }

    public function getMessagingWithUserPage(int $target_user_id): void
    {
        $user = $this->user;

        $userRepository = new UserRepository();

        $discussionRepository =  new DiscussionRepository();

        $discussionsList = $discussionRepository->getDiscussionListPreview($user->getId());

        $target_user = $userRepository->getById($target_user_id);

        if (!$target_user) {

            Redirect::to("404");
            return;
        }

        $discussionRepository =  new DiscussionRepository();

        $discussion = $discussionRepository->getDiscussion($user->getId(), $target_user->getId());

        if ($discussion) {
            $messageRepository = new MessageRepository();

            $message_list = $messageRepository->getMessagesByDiscussionId($discussion->getId());
        }

        require_once("./Views/messaging.php");
    }

    public function sendMessage(): void
    {
        $user = $this->user;

        $content = isset($_POST["message"]) ? $_POST["message"] : null;

        $target_user_id =  isset($_POST["user_id"]) ? $_POST["user_id"] : null;

        if (!$target_user_id) {

            Redirect::to("404");
            return;
        }

        $userRepository = new UserRepository();

        $target_user = $userRepository->getById($target_user_id);


        if (!$target_user) {

            Redirect::to("404");
            return;
        }

        if (!$content) {

            Redirect::to("messagerie", ['utilisateur_id' => $target_user->getId()]);
            return;
        }

        $messageErrorManager = new MessageErrorManager();

        try {
            FormValidation::isMessageContentValid($content);
        } catch (Exception $e) {

            $messageErrorManager->setContentError($e->getMessage());
        }

        if ($messageErrorManager->isContentError) {

            require_once("./Views/messaging.php");
            return;
        }


        $discussionRepository =  new DiscussionRepository();

        $discussion = $discussionRepository->getOrCreateDiscussion($user->getId(), $target_user->getId());

        $messageRepository = new MessageRepository();

        try {
            $messageRepository->create($content, $user->getId(), $discussion->getId());

            $message_list = $messageRepository->getMessagesByDiscussionId($discussion->getId());
        } catch (Exception $e) {
            Redirect::to("404");
            return;
        }

        $message_list = $messageRepository->getMessagesByDiscussionId($discussion->getId());

        $discussionRepository =  new DiscussionRepository();

        $discussionsList = $discussionRepository->getDiscussionListPreview($user->getId());

        require_once("./Views/messaging.php");
    }
}
