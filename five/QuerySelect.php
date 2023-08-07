<?php

class QuerySelect
{
    protected DBHelper $db;
    protected SelectBuilder $builder;
    protected array $binds = [];

    public function __construct(string $table)
    {
        $this->db = DBHelper::getInstance();
        $this->builder = new SelectBuilder($table);
    }

    public function where(string $where, array $binds = []): static
    {
        $this->builder->addWhere($where);
        $this->binds = $binds + $this->binds;
        return $this;
    }

    public function limit(int $shift, ?int $cnt = null): static
    {
        $this->builder->limit($shift . (($cnt !== null) ? ",$cnt" : ''));
        return $this;
    }

    public function __invoke()
    {
        return $this->db->select($this->builder, $this->binds);
    }
}