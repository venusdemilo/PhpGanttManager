<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GanttDataRepository")
 */
class GanttData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $ganttArr = [];

    /**
     * @ORM\Column(type="json", nullable=true)
     */
    private $ganttJson = [];

    /**
     * @ORM\Column(type="object", nullable=true)
     */
    private $ganttObj;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getGanttArr(): ?array
    {
        return $this->ganttArr;
    }

    public function setGanttArr(?array $ganttArr): self
    {
        $this->ganttArr = $ganttArr;

        return $this;
    }

    public function getGanttJson(): ?array
    {
        return $this->ganttJson;
    }

    public function setGanttJson(?array $ganttJson): self
    {
        $this->ganttJson = $ganttJson;

        return $this;
    }

    public function getGanttObj()
    {
        return $this->ganttObj;
    }

    public function setGanttObj($ganttObj): self
    {
        $this->ganttObj = $ganttObj;

        return $this;
    }
}
