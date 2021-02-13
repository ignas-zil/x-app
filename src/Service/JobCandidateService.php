<?php


namespace App\Service;

/**
 * Class JobCandidateService
 * @package App\Service
 */
class JobCandidateService
{
    private $experience;
    private $name;

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @param int $experience
     */
    public function setExperience(int $experience)
    {
        if ($experience == 1) {
            $this->experience = true;
        } else {
            $this->experience = false;
        }
    }

    /**
     * @return bool
     */
    public function isExperienced()
    {
        return $this->experience;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

}