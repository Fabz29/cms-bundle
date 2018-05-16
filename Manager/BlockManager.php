<?php

namespace Fabz29\CmsBundle\Manager;

use Fabz29\CmsBundle\Exception\BlockException;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Twig_Environment as TwigEnvironment;

class BlockManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var TwigEnvironment
     */
    private $twig;

    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;

    /**
     * @var array
     */
    private $params;

    /**
     * BlockManager constructor.
     * @param EntityManager $em
     * @param AuthorizationCheckerInterface $authorizationChecker
     * @param TwigEnvironment $twig
     * @param array $params
     */
    public function __construct(EntityManager $em, AuthorizationCheckerInterface $authorizationChecker, Twig_Environment $twig, array $params)
    {
        $this->em = $em;
        $this->twig = $twig;
        $this->authorizationChecker = $authorizationChecker;
        $this->params = $params;
    }

    /**
     * @param $keyName
     * @return mixed
     */
    public function render($keyName)
    {
        $isEditable = false;

        foreach ($this->params['roles_allowed'] as $roleAllowed) {
            if (true === $this->authorizationChecker->isGranted($roleAllowed)) {
                $isEditable = true;
            }
        }

        $block = $this->em->getRepository('Fabz29CmsBundle:Block')->findOneByKeyName($keyName);

        if (!$block) {
            throw new BlockException('The block with keyName "' . $keyName . '" is not found;');
        }

        return $this->twig->render('@Fabz29Cms/Block/view.html.twig', array(
            'block' => $block,
            'isEditable' => $isEditable,
            'params' => $this->params,
        ));
    }
}