<?php

namespace App\Entity;

use App\Repository\ContributorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContributorRepository::class)
 */
class Contributor implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

  /**
   * @ORM\Column(type="string", length=180, nullable=true)
   * @var string
   */
  private $pseudo;

    /**
     * @ORM\Column(type="string", length=180)
     * @var string
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=180)
     * @var string
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=30)
     * @var string
     * @Assert\Length(
     * min = 10,
     * max = 10,
     * minMessage = "Votre telephone doit contenir 10 chiffres",
     * maxMessage = "Votre telephone doit contenir 10 chiffres"
     * )
     */
    private $phone;

    /**
     * @ORM\Column(type="boolean")
     * @var boolean
     */
    private $enable;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity=Campus::class, inversedBy="contributors")
     */
    private $campus;

    /**
     * @ORM\OneToMany(targetEntity=Trip::class, mappedBy="promoterContributor")
     */
    private $promotorTrips;

    /**
     * @ORM\ManyToMany(targetEntity=Trip::class, mappedBy="contributors")
     * @ORM\JoinTable(name="ContributorTrip")
     */
    private $trips;

    public function __construct()
    {
        $this->contributorTrips = new ArrayCollection();
        $this->trips = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

  /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

  /**
   * @return string
   */
  public function getPseudo(): ?string
  {
    return $this->pseudo;
  }

  /**
   * @param string $pseudo
   */
  public function setPseudo(string $pseudo): void
  {
    $this->pseudo = $pseudo;
  }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return bool
     */
    public function isEnable(): bool
    {
        return $this->enable;
    }

    /**
     * @param bool $enable
     */
    public function setEnable(bool $enable): void
    {
        $this->enable = $enable;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    public function setCampus(?Campus $campus): self
    {
        $this->campus = $campus;

        return $this;
    }

    /**
     * @return Collection|Trip[]
     */
    public function getTrips(): Collection
    {
        return $this->promotorTrips;
    }

    public function removeTrips(Trip $trip): self
    {
        if ($this->trips->contains($trip)) {
            $this->trips->removeElement($trip);
            // set the owning side to null (unless already changed)
            if ($trip->getPromoter() === $this) {
                $trip->setPromoter(null);
            }
        }

        return $this;
    }

    public function addTrip(Trip $trip): self
    {
        if (!$this->promotorTrips->contains($trip)) {
            $this->promotorTrips[] = $trip;
            $trip->setPromoterContributor($this);
        }

        return $this;
    }


    public function removeTrip(Trip $trip): self
    {
        if ($this->promotorTrips->removeElement($trip)) {
            // set the owning side to null (unless already changed)
            if ($trip->getPromoterContributor() === $this) {
                $trip->setPromoterContributor(null);
            }
        }

        return $this;
    }
}
