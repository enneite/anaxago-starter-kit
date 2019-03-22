<?php
/**
 * Created by IntelliJ IDEA.
 * User: etienne.lejariel
 * Date: 22/03/19
 * Time: 18:42
 */

namespace Anaxago\CoreBundle\Listener\Doctrine;


use Anaxago\CoreBundle\Entity\Project;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class ProjectListener implements EventSubscriber
{

    protected $mailer;
    /**
     * ProposalListener constructor.
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents(): array
    {
        return ['preUpdate'];
    }

    /**
     * envoi d'email aux investisseurs lorsqu'un projet a été financé
     *
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getEntity();
        // we only listen User entity
        if (!$entity instanceof Project) {
            return;
        }
        if ($args->hasChangedField('reached') && $args->getNewValue('reached') == true) {
            $em = $args->getEntityManager();
            $query = $em->createQuery('SELECT u.email from Anaxago\CoreBundle\Entity\Proposal p JOIN p.project q JOIN p.user u WHERE q.id= :id');
            $query->setParameter('id', $entity->getId());
            $emails = $query->getResult();

            foreach($emails as $item) {
                $email = $item['email'];
                //@todo envoyer un email

                $message = \Swift_Message::newInstance()
                    ->setSubject('Project funded')
                    ->setFrom('noreply@anaxago.com')
                    ->setTo($email)
                    ->setBody(sprintf('the project called "%s is funded', $entity->getTitle()));
                $res = $this->mailer->send($message);
            }
        }
    }


}