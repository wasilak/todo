<?php
namespace Wasilak\Models;
/**
 * @Entity @Table(name="todos")
 **/
class Todo
{
    /** @Id @Column(type="integer") @GeneratedValue **/
    protected $id;

    /** @Column(type="smallint") **/
    protected $completed;

    /** @Column(type="string", length=1024, nullable=false) **/
    protected $name;

    /** @Column(type="datetime", nullable=false) **/
    protected $created_at;

    /** @Column(type="datetime", nullable=true) **/
    protected $due_date;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getCompleted()
    {
        return $this->completed;
    }

    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    public function getCreatedAt()
    {
        return $this->created_at;
    }

    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    public function getDueDate()
    {
        return $this->due_date;
    }

    public function setDueDate($dueDate)
    {
        $this->due_date = $dueDate;
    }
}
