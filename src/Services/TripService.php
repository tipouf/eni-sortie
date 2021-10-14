<?php


namespace App\Services;


use App\Entity\City;
use App\Entity\Contributor;
use App\Entity\Location;
use App\Entity\Status;
use App\Entity\Trip;
use App\Model\FilterModel;
use App\Model\LocationModel;
use App\Model\TripModel;
use App\Repository\LocationRepository;
use App\Repository\StatusRepository;
use App\Repository\TripRepository;
use DateInterval;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class TripService
{
    private TripRepository $tripRepository;
    private EntityManagerInterface $em;
    private StatusRepository $statusRepository;
    private Security $security;
    private LocationRepository $locationRepository;

    public function __construct(EntityManagerInterface $em, TripRepository $tripRepository, StatusRepository $statusRepository,
                                LocationRepository $locationRepository, Security $security)
    {
        $this->security = $security;
        $this->statusRepository = $statusRepository;
        $this->tripRepository = $tripRepository;
        $this->locationRepository = $locationRepository;
        $this->em = $em;
    }

    public function createTrip(Trip $trip, City $city = null, LocationModel $location = null)
    {
        if ($location) {
            $newLocation = new Location($location->getName(), $location->getStreet(),
                $location->getLatitude(), $location->getLongitude(), $city);
            $city->addLocation($newLocation);
            $newLocation->addTrip($trip);
            $this->em->persist($newLocation);
            $this->em->persist($city);
            $trip->setLocation($newLocation);
        }
        $trip->setPromoterContributor($this->security->getUser());
        $this->changeStatus($trip, Status::CREATED);
        $this->em->persist($trip);

        $this->em->flush();
    }

    public function addTrip(Trip $trip)
    {
        $this->em->persist($trip);
        $this->em->flush();
    }

    public function getTripsByDate(\DateTime $dateTime): array
    {
        return $this->tripRepository->findBy(["startedAt" => $dateTime]);
    }

    public function getAllTrips(): array
    {
        $results = $this->tripRepository->findTrips();
        $this->checkIfIsExpiredOrFull($results);
        return $results;
    }

    public function getTripsByStatus(Status $status): array
    {
        return $this->tripRepository->findBy(["status" => $status]);
    }

    public function getTripsByStatusName(string $status)
    {
        return $this->tripRepository->findByStatusName($status);
    }

    public function changeStatus(Trip $trip, string $status)
    {
        $status = $this->statusRepository->findOneBy(["label" => $status]);
        if (!$status)
            return;
        $trip->setStatus($status);
        $this->em->persist($trip);
        $this->em->flush();
    }

    public function getByFilters(FilterModel $model) {
        $results = $this->tripRepository->findByFilters($model, $this->security->getUser());
        $this->checkIfIsExpiredOrFull($results);
        return $results;
    }

  public function subscribeTrip(Trip $trip, Contributor $contributor){
    $trip->addContributor($contributor);
    $this->em->persist($trip);
    $this->em->flush();
  }

    public function unsubscribeTrip(Trip $trip, Contributor $contributor){
      $trip->removeContributor($contributor);
      $this->em->persist($trip);
      $this->em->flush();
    }

    private function checkIfIsExpiredOrFull(array &$trips) {
        /** @var Trip $trip */
        foreach ($trips as $trip) {

            if ($trip->getStatus()->getLabel() != Status::CANCELED && $trip->getStatus()->getLabel() != Status::PASSED && $trip->getStartedAt() > $trip->getStartedAt()->add(new DateInterval('P1M'))) {
                $trip->setStatus($this->statusRepository->findOneBy(['label' => Status::PASSED]));
                $this->em->persist($trip);
            } else if ($trip->getStatus()->getLabel() != Status::CANCELED &&$trip->getStatus()->getLabel() != Status::CLOSED && $trip->getRegistrationLimit() < new \DateTime('now')
                || $trip->getStatus()->getLabel() != Status::CANCELED && $trip->getStatus()->getLabel() != Status::CLOSED && $trip->getRegistrationNumber() == $trip->getContributors()->count()) {
                $trip->setStatus($this->statusRepository->findOneBy(['label' => Status::CLOSED]));
                $this->em->persist($trip);
            }
        }
        $this->em->flush();
    }
}