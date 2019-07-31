<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\JsonResponse;

class ExceptionSubscriber implements EventSubscriberInterface
{
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
       $exception= $event->getException();
       if ($exception->getStatusCode()==301) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Ressource deplacee de façon permanente.'
        ];
       }
       if ($exception->getStatusCode()==302) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Ressource deplacee de façon temporaire.'
        ];
       }    
       if ($exception->getStatusCode()==401) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Une authentifiaction est necessaire pour acceder à la ressource.'
        ];
       }    
       if ($exception->getStatusCode()==403) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Les droits d accès du client ne permettent pas d acceder à la ressource.'
        ];
       }    
       if ($exception->getStatusCode()==404) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'La ressource n a pas ete trouvee.'
        ];
       }    
       if ($exception->getStatusCode()==500) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Erreur interne du serveur.'
        ];
       }    
       if ($exception->getStatusCode()==503) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Service temporairement indisponible.'
        ];
       }    
       if ($exception->getStatusCode()==504) {
        $data=[
            'statut'=>$exception->getStatusCode(),
            'message'=>'Le serveur a reçu une reponse invalide.'
        ];
       }
    //    else {
    //     $data = [
    //         'status' => $exception->getStatusCode(),
    //         'message' => 'Resource not found'
    //     ];
    //    }           
       $response= new JsonResponse($data);
       $event->setResponse($response);
    }

    public static function getSubscribedEvents()
    {
        return [
            'kernel.exception' => 'onKernelException',
        ];
    }
}
