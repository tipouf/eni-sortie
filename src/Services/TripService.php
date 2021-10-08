<?php


namespace App\Services;


use App\Entity\Contributor;
use App\Entity\Location;
use App\Entity\Status;
use App\Entity\Trip;
use App\Model\FilterModel;
use App\Model\TripModel;
use App\Repository\LocationRepository;
use App\Repository\StatusRepository;
use App\Repository\TripRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
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

    public function createTrip(TripModel $model, Trip $trip = null)
    {
        $location = null;
        if ($model->getLocationType()) {
            $location = $this->locationRepository->findOneBy(['name' => $model->getLocationType()->getName(),
                'street' => $model->getLocationType()->getStreet()]);
            if ($location == null) {
                $location = new Location($model->getLocationType()->getName(),
                    $model->getLocationType()->getStreet(),
                    $model->getLocationType()->getLatitude(),
                    $model->getLocationType()->getLongitude(),
                    $model->getCity());
                $location->getCity()->addLocation($location);
            }
        }
        if ($location == null)
            return;
        $dateRegistration = \DateTime::createFromFormat("d/m/Y H:i",
            $model->getRegistrationLimit()." ".$model->getRegistrationLimitTime());
        $dateStarted = \DateTime::createFromFormat("d/m/Y H:i",
            $model->getStartedAt()." ".$model->getStartedAtTime());
        $trip = ($trip) ? $trip : new Trip();
        $trip->setName($model->getName());
        $trip->setRegistrationNumber($model->getRegistrationNumber());
        $trip->setPromoterContributor($this->security->getUser());
        $trip->setPromoter($model->getPromoter());
        $trip->setRegistrationLimit($dateRegistration);
        $trip->setStartedAt($dateStarted);
        $trip->setLocation($location);
        $trip->setDescription($model->getDescription());
        $trip->setDuration($model->getDuration());
        $this->changeStatus($trip, Status::CREATED);

        $this->em->persist($location);
        $this->em->persist($location->getCity());
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
        return $this->tripRepository->findAll();
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
        return $this->tripRepository->findByFilters($model, $this->security->getUser());
    }

  public function subscribeTrip(Trip $trip, Contributor $contributor){
    $this->tripRepository->findOneBy(array('id' => 'id'));
    $trip->addContributor($contributor);
    $this->em->persist($contributor);
    $this->em->flush();
  }

  public function unsubscribeTrip(Trip $trip, Contributor $contributor){
    $this->tripRepository->findOneBy(array('id' => 'id'));
    $trip->removeContributor($contributor);
    $this->em->persist($contributor);
    $this->em->flush();
  }
}