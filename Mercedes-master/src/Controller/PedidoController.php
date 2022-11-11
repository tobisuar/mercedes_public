<?php

namespace App\Controller;

use App\Entity\Pedido;
use App\Form\PedidoType;
use App\Repository\PedidoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pedido")
 */
class PedidoController extends AbstractController
{
    /**
     * @Route("/", name="pedido_index", methods={"GET"})
     */
    public function index(PedidoRepository $pedidoRepository): Response
    {
        return $this->render('pedido/index.html.twig', [
            'pedidos' => $pedidoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="pedido_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $pedido = new Pedido();
        $form = $this->createForm(PedidoType::class, $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $pedido->setFecha(new \DateTime('now'));
            
            $PedidoFile = $form['PedidoDeCompra']->getData();
            $ValeFile = $form['Vale']->getData();
            $FacturaFile = $form['Factura']->getData();
            
            if ($PedidoFile){
                $PedidoFile->move(
                    $this->getParameter('PedidosFolder'),
                    $PedidoFile->getClientOriginalName()
                );
                $pedido->setPCompraPath($PedidoFile->getClientOriginalName());
            }
            
            if ($ValeFile){
                $ValeFile->move(
                    $this->getParameter('ValesFolder'),
                    $ValeFile->getClientOriginalName()
                );
                $pedido->setValePath($ValeFile->getClientOriginalName());
            }
            
            if ($FacturaFile){
                $FacturaFile->move(
                    $this->getParameter('FacturasFolder'),
                    $FacturaFile->getClientOriginalName()
                );
                $pedido->setFacturaPath($FacturaFile->getClientOriginalName());
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pedido);
            $entityManager->flush();

            return $this->redirectToRoute('pedido_index');
        }

        return $this->render('pedido/new.html.twig', [
            'pedido' => $pedido,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pedido_show", methods={"GET"})
     */
    public function show(Pedido $pedido): Response
    {
        return $this->render('pedido/show.html.twig', [
            'pedido' => $pedido,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="pedido_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Pedido $pedido): Response
    {
        $form = $this->createForm(PedidoType::class, $pedido);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $PedidoFile = $form['PedidoDeCompra']->getData();
            $ValeFile = $form['Vale']->getData();
            $FacturaFile = $form['Factura']->getData();
            
            if ($PedidoFile){
                $PedidoFile->move(
                    $this->getParameter('PedidosFolder'),
                    $PedidoFile->getClientOriginalName()
                );
                $pedido->setPCompraPath($PedidoFile->getClientOriginalName());
            }
            
            if ($ValeFile){
                $ValeFile->move(
                    $this->getParameter('ValesFolder'),
                    $ValeFile->getClientOriginalName()
                );
                $pedido->setValePath($ValeFile->getClientOriginalName());
            }
            
            if ($FacturaFile){
                $FacturaFile->move(
                    $this->getParameter('FacturasFolder'),
                    $FacturaFile->getClientOriginalName()
                );
                $pedido->setFacturaPath($FacturaFile->getClientOriginalName());
            }
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('pedido_index');
        }

        return $this->render('pedido/edit.html.twig', [
            'pedido' => $pedido,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="pedido_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Pedido $pedido): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pedido->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pedido);
            $entityManager->flush();
        }

        return $this->redirectToRoute('pedido_index');
    }
}
