<?php

namespace Model;

class Tag
{
    private int $item_id;
    private int $tag_id;

    public function __construct(int $item_id, int $tag_id)
    {
        $this->item_id = $item_id;
        $this->tag_id = $tag_id;
    }

    public function getItemId(): int
    {
        return $this->item_id;
    }

    public function getTagId(): int
    {
        return $this->tag_id;
    }
}
