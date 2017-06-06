<?php

namespace AppBundle\Controller;

use AppBundle\Entity\TodoList;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Todolist controller.
 *
 * @Route("todolist")
 */
class TodoListController extends Controller
{
    /**
     * Lists all todoList entities.
     *
     * @Route("/", name="todolist_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $todoLists = $em->getRepository('AppBundle:TodoList')->findAll();

        return $this->render('todolist/index.html.twig', array(
            'todoLists' => $todoLists,
        ));
    }

    /**
     * Creates a new todoList entity.
     *
     * @Route("/new", name="todolist_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $todoList = new Todolist();
        $form = $this->createForm('AppBundle\Form\TodoListType', $todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($todoList);
            $em->flush($todoList);

            return $this->redirectToRoute('todolist_show', array('id' => $todoList->getId()));
        }

        return $this->render('todolist/new.html.twig', array(
            'todoList' => $todoList,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a todoList entity.
     *
     * @Route("/{id}", name="todolist_show")
     * @Method("GET")
     */
    public function showAction(TodoList $todoList)
    {
        $deleteForm = $this->createDeleteForm($todoList);

        return $this->render('todolist/show.html.twig', array(
            'todoList' => $todoList,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing todoList entity.
     *
     * @Route("/{id}/edit", name="todolist_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TodoList $todoList)
    {
        $deleteForm = $this->createDeleteForm($todoList);
        $editForm = $this->createForm('AppBundle\Form\TodoListType', $todoList);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('todolist_edit', array('id' => $todoList->getId()));
        }

        return $this->render('todolist/edit.html.twig', array(
            'todoList' => $todoList,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a todoList entity.
     *
     * @Route("/{id}", name="todolist_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TodoList $todoList)
    {
        $form = $this->createDeleteForm($todoList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($todoList);
            $em->flush($todoList);
        }

        return $this->redirectToRoute('todolist_index');
    }

    /**
     * Creates a form to delete a todoList entity.
     *
     * @param TodoList $todoList The todoList entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TodoList $todoList)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('todolist_delete', array('id' => $todoList->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
