<?php

namespace ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Project
 *
 * @ORM\Table(name="project")
 * @ORM\Entity(repositoryClass="ProjectBundle\Repository\ProjectRepository")
 */
class Project
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * Participants au projet
     * @var Array<Worker>
     *
     * @ORM\ManyToMany(targetEntity="SocialBundle\Entity\Worker", inversedBy="projectsInvolvedIn", cascade={"persist"})
     * @ORM\JoinTable(name="projects_workers",
     *      joinColumns={@ORM\JoinColumn(name="project_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="worker_id", referencedColumnName="id")}
     *      )
     */
    private $participants;

    /**
     * Créateur du projet
     * @var Worker
     *
     * @ORM\ManyToOne(targetEntity="SocialBundle\Entity\Worker", inversedBy="projectsCreated")
     * @ORM\JoinColumn(name="creator_id", referencedColumnName="id")
     */
    private $creator;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Project
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->participants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add participant
     *
     * @param \SocialBundle\Entity\Worker $participant
     *
     * @return Project
     */
    public function addParticipant(\SocialBundle\Entity\Worker $participant)
    {
        $this->participants[] = $participant;

        return $this;
    }

    /**
     * Remove participant
     *
     * @param \SocialBundle\Entity\Worker $participant
     */
    public function removeParticipant(\SocialBundle\Entity\Worker $participant)
    {
        $this->participants->removeElement($participant);
    }

    /**
     * Get participants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getParticipants()
    {
        return $this->participants;
    }

    /**
     * Set creator
     *
     * @param \SocialBundle\Entity\Worker $creator
     *
     * @return Project
     */
    public function setCreator(\SocialBundle\Entity\Worker $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \SocialBundle\Entity\Worker
     */
    public function getCreator()
    {
        return $this->creator;
    }
}
