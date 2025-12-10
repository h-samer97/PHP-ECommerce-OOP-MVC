<?php

namespace Repositories;

use Model\Tag;
use Model\ItemTag;
use PDO;

class TagRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    // جلب كل الوسوم
    public function getAllTags(): array
    {
        $stmt = $this->connection->query("SELECT tag_id, tag_name FROM tags");
        $tags = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tags[] = new Tag((int)$row['tag_id'], $row['tag_name']);
        }
        return $tags;
    }

    // جلب وسوم عنصر معيّن
    public function getTagsByItemId(int $itemId): array
    {
        $stmt = $this->connection->prepare("
            SELECT t.tag_id, t.tag_name
            FROM tags t
            INNER JOIN item_tags it ON t.tag_id = it.tag_id
            WHERE it.item_id = :itemId
        ");
        $stmt->execute(['itemId' => $itemId]);

        $tags = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $tags[] = new Tag((int)$row['tag_id'], $row['tag_name']);
        }
        return $tags;
    }

    // جلب العناصر المرتبطة بوسم معيّن
    public function getItemsByTag(string $tagName): array
    {
        $stmt = $this->connection->prepare("
            SELECT i.Item_id, i.Item_name
            FROM items i
            INNER JOIN item_tags it ON i.Item_id = it.item_id
            INNER JOIN tags t ON it.tag_id = t.tag_id
            WHERE t.tag_name = :tagName
        ");
        $stmt->execute(['tagName' => $tagName]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // إضافة وسم جديد
    public function addTag(string $tagName): int
    {
        $stmt = $this->connection->prepare("INSERT INTO tags (tag_name) VALUES (:tagName)");
        $stmt->execute(['tagName' => $tagName]);
        return (int)$this->connection->lastInsertId();
    }

    // ربط عنصر بوسم
    public function addTagToItem(int $itemId, int $tagId): void
    {
        $stmt = $this->connection->prepare("
            INSERT INTO item_tags (item_id, tag_id) VALUES (:itemId, :tagId)
        ");
        $stmt->execute(['itemId' => $itemId, 'tagId' => $tagId]);
    }

    // حذف وسم من عنصر
    public function removeTagFromItem(int $itemId, int $tagId): void
    {
        $stmt = $this->connection->prepare("
            DELETE FROM item_tags WHERE item_id = :itemId AND tag_id = :tagId
        ");
        $stmt->execute(['itemId' => $itemId, 'tagId' => $tagId]);
    }
}
