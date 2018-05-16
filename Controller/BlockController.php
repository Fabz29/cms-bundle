<?php

namespace Fabz29\CmsBundle\Controller;

use Fabz29\CmsBundle\Entity\Block;
use Fabz29\CmsBundle\Form\BlockType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BlockController
 * @package Fabz29\CmsBundle\Controller
 *
 * @Route("/block")
 */
class BlockController extends Controller
{

    /**
     * @param Request $request
     * @param Block $block
     * @return Response
     *
     * @Route("/edit/{keyName}", name="cms_block_edit", methods={"POST"})
     */
    public function editAction(Request $request, Block $block): Response
    {

        $form = $this->createForm(BlockType::class, $block);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($block);
            $em->flush();

            return new Response();
        }

        return $this->render('@Fabz29Cms/Block/form.html.twig', array(
            'form' => $form->createView(),
            'block' => $block,
        ));

    }
}