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
}
