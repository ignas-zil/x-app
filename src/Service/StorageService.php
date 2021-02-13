<?php


namespace App\Service;


use App\Entity\Employee;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class StorageService
 * @package App\Service
 */
class StorageService
{
    private $em;
    private $filename = 'candidates.txt';

    /**
     * StorageService constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * Saves name to DB if it is unique
     * @param string $name
     * @return bool
     */
    public function insert(string $name)
    {
        if ($this->uniqueNameDB($name)) {
            $employee = new Employee();
            $employee->setName($name);
            $this->em->persist($employee);
            $this->em->flush();
            return true;
        }
        return false;
    }

    /**
     * Checks if name already exists in DB
     * @param string $name
     * @return bool
     */
    private function uniqueNameDB(string $name)
    {
        $employees = $this->em->getRepository(Employee::class)->findBy(array('name' => $name));
        if (empty($employees)) {
            return true;
        }
        return false;
    }

    /**
     * Saves name to file if it is unique
     * @param string $name
     * @return bool
     */
    public function saveToFile(string $name)
    {
        if ($this->uniqueNameFile($name)) {
            file_put_contents($this->filename, $name.PHP_EOL , FILE_APPEND | LOCK_EX);
            return true;
        }
        return false;
    }

    /**
     * Checks if name already exists in file
     * @param string $name
     * @return bool
     */
    private function uniqueNameFile(string $name)
    {
        $saved_names = explode("\n", file_get_contents($this->filename));
        if (in_array($name, $saved_names)) {
            return false;
        }
        return true;
    }

}