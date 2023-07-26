<?php

namespace SimpleStorage;


include_once "StorageInterface.php";

class Article
{
    protected int $id;

    public string $title = '';
    public string $content = '';
    protected StorageInterface $storage;

    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @throws \Exception
     */
    public function addArticle(): void
    {
        $this->checkValid();
        $this->id = $this->storage->create($this->getFields());
    }

    /**
     * @throws \Exception
     */
    public function changeArticle(int $id, array $fields): void
    {
        $this->title = $fields[0] ?? "";
        $this->content = $fields[1] ?? "";
        $this->checkValid();
        $this->storage->update($id, $this->getFields());
    }

    /**
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function getArticle(int $id): void
    {
        $data = $this->storage->get($id);
        if ($data === null) {
            throw new \Exception("article with id={$id} not found");
        }
        $this->id = $id;
        $this->title = $data['title'];
        $this->content = $data['content'];
    }

    public function deleteArticle(int $id): void
    {
        $this->storage->remove($id);
    }

    /**
     * @return array
     */
    protected function getFields(): array
    {
        return [
            'title' => $this->title,
            'content' => $this->content
        ];
    }

    /**
     * @return void
     * @throws \Exception
     */
    protected function checkValid(): void
    {
        if (empty($this->title)) {
            throw new \Exception("Empty title");
        }
        if (empty($this->content)) {
            throw new \Exception("Empty content");
        }
        if (strlen($this->title) > 100 && strlen($this->content) > 250) {
            throw new \Exception("Reduce the number of words in title or content");
        }
    }
}