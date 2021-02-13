<?php


namespace App\Service;

/**
 * Class EmployerService
 * @package App\Service
 */
class EmployerService
{
    private $storageService;

    /**
     * EmployerService constructor.
     * @param StorageService $storageService
     */
    public function __construct(StorageService $storageService)
    {
        $this->storageService = $storageService;
    }

    /**
     * Checks candidate's experience and saves it to DB or file
     * @param JobCandidateService $candidate
     * @return string
     */
    public function newEmployee(JobCandidateService $candidate)
    {
        $message = '"'.$candidate->getName().'"';
        if ($candidate->isExperienced())
        {
            if ($this->storageService->insert($candidate->getName())) {
                $message .= ' saved in DB.';
            } else {
                $message .= ' was not saved in DB. Maybe such name already exists.';
            }
        } else {
            if ($this->storageService->saveToFile($candidate->getName())) {
                $message .= ' saved in file.';
            } else {
                $message .= ' was not saved in file. Maybe such name already exists.';
            }
        }

        return $message;
    }

}