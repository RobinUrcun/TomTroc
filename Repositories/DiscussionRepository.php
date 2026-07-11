<?php

class DiscussionRepository
{
    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = (new Database())->getPDO();
    }

    public function getDiscussion(int $user_one_id, int $user_two_id): ?Discussion
    {
        $stmt = $this->pdo->prepare("SELECT discussion_id FROM user_discussion WHERE user_id = :user_one_id OR user_id = :user_two_id GROUP BY discussion_id HAVING COUNT(*) = 2");

        $stmt->execute([
            ':user_one_id' => $user_one_id,
            ':user_two_id' => $user_two_id
        ]);

        $result =  $stmt->fetch();
        if (!$result) {
            return null;
        }

        $discussion = new Discussion();
        $discussion->setId($result["discussion_id"]);

        $messageRepository = new MessageRepository();
        $last_message = $messageRepository->getLastMessage($discussion->getId());

        $discussion->setLastMessage($last_message);

        return $discussion;
    }

    public function getOrCreateDiscussion(int $user_one_id, int $user_two_id): Discussion
    {
        $discussion = $this->getDiscussion($user_one_id,  $user_two_id);

        if ($discussion) {
            return $discussion;
        } else {
            $discussion = $this->createDiscussion($user_one_id,  $user_two_id);

            return $discussion;
        }
    }

    public function createDiscussion(int $user_one_id, int $user_two_id): Discussion
    {
        $stmt = $this->pdo->prepare("INSERT INTO discussions () VALUES ()");

        $stmt->execute();

        $discussion_id = $this->pdo->lastInsertId();

        $stmt = $this->pdo->prepare("INSERT INTO user_discussion (user_id, discussion_id) VALUES (:user_id, :discussion_id)");

        $stmt->execute([
            ":user_id" => $user_one_id,
            ":discussion_id" => $discussion_id,

        ]);

        $stmt = $this->pdo->prepare("INSERT INTO user_discussion (user_id, discussion_id) VALUES (:user_id, :discussion_id)");

        $stmt->execute([
            ":user_id" => $user_two_id,
            ":discussion_id" => $discussion_id,

        ]);

        $discussion = new Discussion();
        $discussion->setId($discussion_id);

        return $discussion;
    }

    public function getDiscussionListPreview(int $userId): array
    {

        $stmt = $this->pdo->prepare("SELECT * FROM user_discussion WHERE user_id = :user_id");

        $stmt->execute([
            ":user_id" => $userId
        ]);

        $results = $stmt->fetchAll();

        $discussion_list = [];

        foreach ($results as $result) {
            $discussion = new Discussion();
            $discussion->setId($result["discussion_id"]);
            $discussion_list[] = $discussion;
        }

        $messageRepository = new MessageRepository();
        $userRepository = new UserRepository();

        foreach ($discussion_list as $discussion) {

            $last_message = $messageRepository->getLastMessage($discussion->getId());

            $discussion->setLastMessage($last_message);

            $target_user_id = $this->getDiscussionTargetUserId($userId, $discussion->getId());

            $target_user = $userRepository->getById($target_user_id);

            $discussion->setTargetUser($target_user);
        }

        return $discussion_list;



        // $sql = "SELECT d.id, m.content, m.send_at, m.from_user_id, m.is_read FROM user_discussion ud INNER JOIN discussions d ON ud.discussion_id = d.id INNER JOIN ( SELECT discussion_id, MAX(send_at) AS last_send_at FROM messages GROUP BY discussion_id ) lm ON d.id = lm.discussion_id INNER JOIN messages m ON m.discussion_id = lm.discussion_id AND m.send_at = lm.last_send_at WHERE ud.user_id = :user_id;";

    }

    public function getDiscussionTargetUserId(int $userId, int $discussionId)
    {
        $stmt = $this->pdo->prepare("SELECT user_id FROM user_discussion WHERE discussion_id = :discussion_id AND user_id != :user_id");

        $stmt->execute([
            ":discussion_id" => $discussionId,
            ":user_id" => $userId
        ]);

        $result = $stmt->fetch();

        return (int) $result["user_id"];
    }
}
