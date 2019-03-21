<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 21/03/19
 * Time: 20:53
 */

namespace Anaxago\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Sessions d'utilsateur connectés via l'API stockées en base
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Anaxago\CoreBundle\Repository\UserSessionRepository")
 */
class UserSession
{



 /**
     * technical ID.
     *
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;




    /**
     * token type (Bearer by default).
     *
     * @var string
     *
     * @ORM\Column(name="token_type", type="string", length=20, options= {"default" = "Bearer"})
     * @Assert\NotBlank()
     */
    private $tokenType;

    /**
     * THE access token.
     *
     * @var string
     *
     * @ORM\Column(name="access_token", type="text")
     * @Assert\NotBlank()
     */
    private $accessToken;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $user;


    /**
     * serialized PartnerUser object.
     *
     * @var string
     *
     * @ORM\Column(name="serialized_user", type="text")
     * @Assert\NotBlank()
     */
    private $serializedUser;



    /**
     * session expiration date.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="expiration_date", type="datetime")
     */
    private $expirationDate;

    /**
     * last date user refresh.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="last_refresh_user_date", type="datetime", nullable=true)
     */
    private $lastRefreshUserDate;

    /**
     * @param string $accessToken
     
     */
    public function setAccessToken($accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }



    /**
     * @param \DateTime $expirationDate
     *
     * @return $this
     */
    public function setExpirationDate($expirationDate): void
    {
        $this->expirationDate = $expirationDate;

    }

    /**
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }


    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @param string $serializedUser
     *
     * @return $this
     */
    public function setSerializedUser($serializedUser): void
    {
        $this->serializedUser = $serializedUser;
    }

    /**
     * @return string
     */
    public function getSerializedUser(): ?string
    {
        return $this->serializedUser;
    }

    /**
     * @param string $tokenType
     *
     * @return $this
     */
    public function setTokenType($tokenType): void
    {
        $this->tokenType = $tokenType;
    }

    /**
     * @return string
     */
    public function getTokenType(): ?string
    {
        return $this->tokenType;
    }

    /**
     * @param \DateTime $refreshDate
     */
    public function setLastRefreshUserDate($lastRefreshUserDate): void
    {
        $this->lastRefreshUserDate = $lastRefreshUserDate;
    }

    /**
     * @return \DateTime
     */
    public function getLastRefreshUserDate(): \DateTime
    {
        return $this->lastRefreshUserDate;
    }
}
