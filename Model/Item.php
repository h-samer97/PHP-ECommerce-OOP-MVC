<?php

namespace Model;

class Item
{
    public int $item_id;
    public string $item_name;
    public string $item_description;
    public string $price;
    public string $add_date;
    public string $country_made;
    public ?string $image;
    public string $status_item;
    public ?int $rating;
    public ?int $cat_id;
    public ?int $member_id;
    public int $approve;

    public function __construct(array $data = [])
    {
        $this->item_id         = $data['item_id'] ?? 0;
        $this->item_name       = $data['item_name'] ?? '';
        $this->item_description= $data['item_description'] ?? '';
        $this->price           = $data['price'] ?? '0';
        $this->add_date        = $data['add_date'] ?? date('Y-m-d H:i:s');
        $this->country_made    = $data['country_made'] ?? '';
        $this->image           = $data['image'] ?? null;
        $this->status_item     = $data['status_item'] ?? '';
        $this->rating          = isset($data['rating']) ? (int)$data['rating'] : null;
        $this->cat_id          = isset($data['cat_id']) ? (int)$data['cat_id'] : null;
        $this->member_id       = isset($data['member_id']) ? (int)$data['member_id'] : null;
        $this->approve         = isset($data['approve']) ? (int)$data['approve'] : 0;
    }
}
