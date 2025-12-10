<?php

namespace Model;

class Comment {
    public int $c_id;
    public string $comments;
    public int $status_com;
    public string $Added_date;
    public int $item_id;
    public int $user_id;

    public function __construct(
        int $c_id,
        string $comments,
        int $status_com,
        string $Added_date,
        int $item_id,
        int $user_id
    ) {
        $this->c_id        = $c_id;
        $this->comments    = $comments;
        $this->status_com  = $status_com;
        $this->Added_date  = $Added_date;
        $this->item_id     = $item_id;
        $this->user_id     = $user_id;
    }

    public function getContent(): string {
        return $this->comments;
    }

    public function isApproved(): bool {
        return $this->status_com === 1;
    }

    public function getAuthorId(): int {
        return $this->user_id;
    }

    public function getItemId(): int {
        return $this->item_id;
    }
}
